<?php
/**
 * Plugin Name: Claude WP Bridge
 * Description: API bridge for Claude AI to manage WordPress, Elementor, media and more.
 * Version: 1.0
 * Author: Claude AI
 */

if (!defined('ABSPATH')) exit;

// Register REST API routes
add_action('rest_api_init', function() {
    // Upload media from base64 or URL
    register_rest_route('claude/v1', '/upload-media', [
        'methods' => 'POST',
        'callback' => 'claude_upload_media',
        'permission_callback' => 'claude_check_auth',
    ]);

    // Update Elementor data for a page
    register_rest_route('claude/v1', '/elementor/(?P<post_id>\d+)', [
        'methods' => 'POST',
        'callback' => 'claude_update_elementor',
        'permission_callback' => 'claude_check_auth',
    ]);

    // Get Elementor data
    register_rest_route('claude/v1', '/elementor/(?P<post_id>\d+)', [
        'methods' => 'GET',
        'callback' => 'claude_get_elementor',
        'permission_callback' => 'claude_check_auth',
    ]);

    // Clear all caches
    register_rest_route('claude/v1', '/clear-cache', [
        'methods' => 'POST',
        'callback' => 'claude_clear_cache',
        'permission_callback' => 'claude_check_auth',
    ]);

    // List media
    register_rest_route('claude/v1', '/media', [
        'methods' => 'GET',
        'callback' => 'claude_list_media',
        'permission_callback' => 'claude_check_auth',
    ]);

    // Execute PHP (for complex operations)
    register_rest_route('claude/v1', '/exec', [
        'methods' => 'POST',
        'callback' => 'claude_exec_php',
        'permission_callback' => 'claude_check_auth',
    ]);
});

// Auth check - requires admin user via Application Password
function claude_check_auth($request) {
    return current_user_can('manage_options');
}

// Upload media from URL or base64
function claude_upload_media($request) {
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');

    $params = $request->get_json_params();
    $title = sanitize_text_field($params['title'] ?? 'uploaded-image');

    // Upload from URL
    if (!empty($params['url'])) {
        $tmp = download_url($params['url']);
        if (is_wp_error($tmp)) {
            return new WP_Error('download_failed', $tmp->get_error_message(), ['status' => 400]);
        }

        $ext = pathinfo(parse_url($params['url'], PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
        $file_array = [
            'name' => sanitize_file_name($title . '.' . $ext),
            'tmp_name' => $tmp,
        ];

        $attachment_id = media_handle_sideload($file_array, 0, $title);
        if (is_wp_error($attachment_id)) {
            @unlink($tmp);
            return new WP_Error('upload_failed', $attachment_id->get_error_message(), ['status' => 400]);
        }

        return [
            'id' => $attachment_id,
            'url' => wp_get_attachment_url($attachment_id),
            'title' => $title,
        ];
    }

    // Upload from base64
    if (!empty($params['base64'])) {
        $data = base64_decode($params['base64']);
        $ext = $params['ext'] ?? 'jpg';
        $filename = sanitize_file_name($title . '.' . $ext);

        $upload = wp_upload_bits($filename, null, $data);
        if ($upload['error']) {
            return new WP_Error('upload_failed', $upload['error'], ['status' => 400]);
        }

        $filetype = wp_check_filetype($upload['file']);
        $attachment = [
            'post_mime_type' => $filetype['type'],
            'post_title' => $title,
            'post_content' => '',
            'post_status' => 'inherit',
        ];

        $attachment_id = wp_insert_attachment($attachment, $upload['file']);
        $metadata = wp_generate_attachment_metadata($attachment_id, $upload['file']);
        wp_update_attachment_metadata($attachment_id, $metadata);

        return [
            'id' => $attachment_id,
            'url' => wp_get_attachment_url($attachment_id),
            'title' => $title,
        ];
    }

    return new WP_Error('no_data', 'Provide url or base64 data', ['status' => 400]);
}

// Update Elementor data
function claude_update_elementor($request) {
    $post_id = (int)$request['post_id'];
    $params = $request->get_json_params();

    if (!empty($params['data'])) {
        $json = is_string($params['data']) ? $params['data'] : json_encode($params['data']);
        update_post_meta($post_id, '_elementor_data', wp_slash($json));
    }

    if (!empty($params['page_settings'])) {
        update_post_meta($post_id, '_elementor_page_settings', $params['page_settings']);
    }

    if (!empty($params['template'])) {
        update_post_meta($post_id, '_wp_page_template', $params['template']);
    }

    // Ensure Elementor edit mode
    update_post_meta($post_id, '_elementor_edit_mode', 'builder');

    // Clear CSS cache for this post
    delete_post_meta($post_id, '_elementor_css');
    delete_option('_elementor_global_css');

    // Clear Elementor cache
    if (class_exists('\Elementor\Plugin')) {
        \Elementor\Plugin::$instance->files_manager->clear_cache();
    }

    return ['success' => true, 'post_id' => $post_id];
}

// Get Elementor data
function claude_get_elementor($request) {
    $post_id = (int)$request['post_id'];

    $data = get_post_meta($post_id, '_elementor_data', true);
    $settings = get_post_meta($post_id, '_elementor_page_settings', true);
    $template = get_post_meta($post_id, '_wp_page_template', true);

    return [
        'post_id' => $post_id,
        'data' => $data ? json_decode($data, true) : [],
        'page_settings' => $settings ?: [],
        'template' => $template ?: 'default',
    ];
}

// Clear caches
function claude_clear_cache($request) {
    // Elementor cache
    delete_option('_elementor_global_css');
    if (class_exists('\Elementor\Plugin')) {
        \Elementor\Plugin::$instance->files_manager->clear_cache();
    }

    // WP cache
    wp_cache_flush();

    // FlyingPress cache if available
    if (function_exists('flyingpress_purge_everything')) {
        flyingpress_purge_everything();
    }

    // Delete transients
    global $wpdb;
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_%'");

    return ['success' => true, 'message' => 'All caches cleared'];
}

// List media
function claude_list_media($request) {
    $search = $request->get_param('search') ?: '';
    $per_page = (int)($request->get_param('per_page') ?: 50);

    $args = [
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'posts_per_page' => $per_page,
        'orderby' => 'ID',
        'order' => 'DESC',
    ];

    if ($search) $args['s'] = $search;

    $attachments = get_posts($args);
    $results = [];

    foreach ($attachments as $att) {
        $results[] = [
            'id' => $att->ID,
            'title' => $att->post_title,
            'url' => wp_get_attachment_url($att->ID),
            'width' => wp_get_attachment_metadata($att->ID)['width'] ?? 0,
            'height' => wp_get_attachment_metadata($att->ID)['height'] ?? 0,
        ];
    }

    return $results;
}

// Execute PHP code (admin only)
function claude_exec_php($request) {
    $params = $request->get_json_params();
    $code = $params['code'] ?? '';

    if (empty($code)) {
        return new WP_Error('no_code', 'No code provided', ['status' => 400]);
    }

    ob_start();
    try {
        eval($code);
        $output = ob_get_clean();
        return ['success' => true, 'output' => $output];
    } catch (\Throwable $e) {
        ob_end_clean();
        return ['success' => false, 'error' => $e->getMessage()];
    }
}
