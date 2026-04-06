<?php
require_once('wp-load.php');

// ============================================
// Amir Shabtay - Home Page Builder
// Based on PDF Design
// Using Elementor Sections (no containers)
// ============================================

$base_url = 'https://wordpress-535938-5839894.cloudwaysapps.com/wp-content/uploads';

// Helper function to generate unique IDs
function eid() {
    return substr(md5(uniqid(mt_rand(), true)), 0, 8);
}

// Helper: Create a widget
function widget($type, $settings = []) {
    return [
        'id' => eid(),
        'elType' => 'widget',
        'widgetType' => $type,
        'settings' => $settings,
        'elements' => [],
        'isInner' => false
    ];
}

// Helper: Create a column
function col($widgets, $settings = []) {
    return [
        'id' => eid(),
        'elType' => 'column',
        'settings' => array_merge(['_column_size' => 100], $settings),
        'elements' => $widgets,
        'isInner' => false
    ];
}

// Helper: Create a section
function section($columns, $settings = []) {
    return [
        'id' => eid(),
        'elType' => 'section',
        'settings' => $settings,
        'elements' => $columns,
        'isInner' => false,
        'isLocked' => false
    ];
}

// ============================================
// SECTION 1: HERO
// ============================================
$hero = section(
    [
        // Left column - Text & Buttons (60%)
        col(
            [
                // Main heading
                widget('heading', [
                    'title' => "WHER ART COMES ALIVE",
                    'header_size' => 'h1',
                    'title_color' => '#FFFFFF',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Playfair Display',
                    'typography_font_size' => ['unit' => 'px', 'size' => 56],
                    'typography_font_weight' => '700',
                    'typography_font_size_mobile' => ['unit' => 'px', 'size' => 32],
                ]),
            ],
            [
                '_column_size' => 60,
                'content_position' => 'center',
                '_padding' => ['unit' => 'px', 'top' => '80', 'right' => '40', 'bottom' => '20', 'left' => '60', 'isLinked' => false],
                '_padding_mobile' => ['unit' => 'px', 'top' => '40', 'right' => '20', 'bottom' => '20', 'left' => '20', 'isLinked' => false],
            ]
        ),
        // Right column - Logo Circle (40%)
        col(
            [
                widget('image', [
                    'image' => ['url' => "$base_url/2024/09/Logo-6.webp", 'id' => 5081],
                    'image_size' => 'full',
                    'align' => 'center',
                    'width' => ['unit' => '%', 'size' => 70],
                ]),
            ],
            [
                '_column_size' => 40,
                'content_position' => 'center',
                'align' => 'center',
                'background_background' => 'classic',
                'background_color' => '#FFFFFF',
                'border_radius' => ['unit' => '%', 'top' => '50', 'right' => '50', 'bottom' => '50', 'left' => '50', 'isLinked' => true],
                '_padding' => ['unit' => 'px', 'top' => '60', 'right' => '60', 'bottom' => '60', 'left' => '60', 'isLinked' => true],
                '_margin' => ['unit' => 'px', 'top' => '0', 'right' => '-80', 'bottom' => '0', 'left' => '0', 'isLinked' => false],
            ]
        ),
    ],
    [
        'layout' => 'full_width',
        'content_width' => ['unit' => 'px', 'size' => '1400'],
        'gap' => 'no',
        'height' => 'min-height',
        'custom_height' => ['unit' => 'vh', 'size' => 85],
        'background_background' => 'classic',
        'background_color' => '#1C1C1E',
        'background_image' => ['url' => "$base_url/2025/09/MG_7232-Enhanced-NR-scaled.jpg", 'id' => 7005],
        'background_position' => 'center center',
        'background_size' => 'cover',
        'background_overlay_background' => 'classic',
        'background_overlay_color' => 'rgba(0,0,0,0.4)',
        'padding' => ['unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true],
    ]
);

// ============================================
// SECTION 1B: HERO BOTTOM (Buttons + Description)
// ============================================
$hero_bottom = section(
    [
        col(
            [
                // Explore Collection button
                widget('button', [
                    'text' => 'Explore Collection',
                    'link' => ['url' => '/gallery/'],
                    'button_type' => '',
                    'size' => 'md',
                    'button_text_color' => '#1C1C1E',
                    'background_color' => '#FFFFFF',
                    'border_border' => 'solid',
                    'border_width' => ['unit' => 'px', 'top' => '2', 'right' => '2', 'bottom' => '2', 'left' => '2', 'isLinked' => true],
                    'border_color' => '#FFFFFF',
                    'border_radius' => ['unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true],
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Poppins',
                    'typography_font_size' => ['unit' => 'px', 'size' => 14],
                    'typography_font_weight' => '500',
                ]),
                // Custom Made button
                widget('button', [
                    'text' => 'Custom Made',
                    'link' => ['url' => '/contact-us/'],
                    'size' => 'md',
                    'button_text_color' => '#FFFFFF',
                    'background_color' => '#C4944A',
                    'border_radius' => ['unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true],
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Poppins',
                    'typography_font_size' => ['unit' => 'px', 'size' => 14],
                    'typography_font_weight' => '500',
                ]),
            ],
            [
                '_column_size' => 40,
                'content_position' => 'center',
                '_padding' => ['unit' => 'px', 'top' => '20', 'right' => '0', 'bottom' => '40', 'left' => '60', 'isLinked' => false],
            ]
        ),
        col(
            [
                widget('text-editor', [
                    'editor' => '<p style="color: #FFFFFF; font-style: italic;">Contemporary 3D Artworks<br>Handcrafted In Israel – Where Metal,<br>Color And Light Transform Into<br><span style="color: #C4944A;">Living Movement on Your Wall.</span></p>',
                    'text_color' => '#FFFFFF',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Poppins',
                    'typography_font_size' => ['unit' => 'px', 'size' => 16],
                ]),
            ],
            [
                '_column_size' => 60,
                'content_position' => 'center',
                '_padding' => ['unit' => 'px', 'top' => '20', 'right' => '60', 'bottom' => '40', 'left' => '40', 'isLinked' => false],
            ]
        ),
    ],
    [
        'layout' => 'full_width',
        'content_width' => ['unit' => 'px', 'size' => '1400'],
        'gap' => 'no',
        'background_background' => 'classic',
        'background_color' => '#1C1C1E',
        'margin' => ['unit' => 'px', 'top' => '-1', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => false],
    ]
);

// ============================================
// SECTION 2: SIGNATURE COLLECTIONS
// ============================================
$signature = section(
    [
        col(
            [
                widget('heading', [
                    'title' => "SIGNATURE\nCOLLECTIONS",
                    'align' => 'center',
                    'header_size' => 'h2',
                    'title_color' => '#1C1C1E',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Playfair Display',
                    'typography_font_size' => ['unit' => 'px', 'size' => 52],
                    'typography_font_weight' => '700',
                ]),
                widget('button', [
                    'text' => 'Sculptural 3D Art / One-Of-A-Kind / Born From Light And Metal',
                    'align' => 'center',
                    'size' => 'sm',
                    'button_text_color' => '#1C1C1E',
                    'background_color' => 'transparent',
                    'border_border' => 'solid',
                    'border_width' => ['unit' => 'px', 'top' => '1', 'right' => '1', 'bottom' => '1', 'left' => '1', 'isLinked' => true],
                    'border_color' => '#1C1C1E',
                    'border_radius' => ['unit' => 'px', 'top' => '30', 'right' => '30', 'bottom' => '30', 'left' => '30', 'isLinked' => true],
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Poppins',
                    'typography_font_size' => ['unit' => 'px', 'size' => 13],
                    'typography_font_weight' => '400',
                ]),
            ],
            ['_column_size' => 100]
        ),
    ],
    [
        'layout' => 'full_width',
        'background_background' => 'classic',
        'background_color' => '#F5F0EB',
        'padding' => ['unit' => 'px', 'top' => '80', 'right' => '0', 'bottom' => '60', 'left' => '0', 'isLinked' => false],
    ]
);

// ============================================
// SECTION 3: THE PULSE OF NATURE
// ============================================
$pulse = section(
    [
        col(
            [
                widget('image', [
                    'image' => ['url' => "$base_url/2026/02/פרפרים_צבעוניים.jpg", 'id' => 7732],
                    'image_size' => 'full',
                    'width' => ['unit' => '%', 'size' => 100],
                ]),
            ],
            [
                '_column_size' => 45,
                '_padding' => ['unit' => 'px', 'top' => '20', 'right' => '20', 'bottom' => '20', 'left' => '0', 'isLinked' => false],
            ]
        ),
        col(
            [
                widget('heading', [
                    'title' => "THE PULS\nOF NATURE",
                    'header_size' => 'h2',
                    'title_color' => '#1C1C1E',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Playfair Display',
                    'typography_font_size' => ['unit' => 'px', 'size' => 40],
                    'typography_font_weight' => '700',
                ]),
                widget('divider', [
                    'color' => '#C4944A',
                    'weight' => ['unit' => 'px', 'size' => 2],
                    'width' => ['unit' => '%', 'size' => 100],
                ]),
                widget('heading', [
                    'title' => 'Life Movment Energy',
                    'header_size' => 'h4',
                    'title_color' => '#1C1C1E',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Poppins',
                    'typography_font_size' => ['unit' => 'px', 'size' => 18],
                    'typography_font_weight' => '600',
                ]),
                widget('text-editor', [
                    'editor' => '<p>Inspired by the living rhythm of the natural world, this collection captures motion suspended in time. From sky to land to sea, each piece expresses the heartbeat of nature in layered three-dimensional form.</p>',
                    'text_color' => '#555555',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Poppins',
                    'typography_font_size' => ['unit' => 'px', 'size' => 14],
                ]),
                widget('button', [
                    'text' => 'Explore Collection',
                    'link' => ['url' => '/the-pulse-of-nature/'],
                    'size' => 'sm',
                    'button_text_color' => '#1C1C1E',
                    'background_color' => 'transparent',
                    'border_border' => 'solid',
                    'border_width' => ['unit' => 'px', 'top' => '1', 'right' => '1', 'bottom' => '1', 'left' => '1', 'isLinked' => true],
                    'border_color' => '#1C1C1E',
                    'border_radius' => ['unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true],
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Poppins',
                    'typography_font_size' => ['unit' => 'px', 'size' => 13],
                ]),
            ],
            [
                '_column_size' => 55,
                'content_position' => 'center',
                '_padding' => ['unit' => 'px', 'top' => '40', 'right' => '60', 'bottom' => '40', 'left' => '40', 'isLinked' => false],
            ]
        ),
    ],
    [
        'layout' => 'boxed',
        'content_width' => ['unit' => 'px', 'size' => '1200'],
        'background_background' => 'classic',
        'background_color' => '#FFFFFF',
        'padding' => ['unit' => 'px', 'top' => '60', 'right' => '0', 'bottom' => '40', 'left' => '0', 'isLinked' => false],
    ]
);

// ============================================
// SECTION 4: EMOTIONS IN MOTION
// ============================================
$emotions = section(
    [
        col(
            [
                widget('heading', [
                    'title' => "EMOTIONS\nIN MOTION",
                    'header_size' => 'h2',
                    'title_color' => '#C4944A',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Playfair Display',
                    'typography_font_size' => ['unit' => 'px', 'size' => 40],
                    'typography_font_weight' => '700',
                ]),
                widget('divider', [
                    'color' => '#C4944A',
                    'weight' => ['unit' => 'px', 'size' => 2],
                    'width' => ['unit' => '%', 'size' => 100],
                ]),
                widget('heading', [
                    'title' => 'Where feelings take shape.',
                    'header_size' => 'h4',
                    'title_color' => '#1C1C1E',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Poppins',
                    'typography_font_size' => ['unit' => 'px', 'size' => 16],
                    'typography_font_weight' => '600',
                ]),
                widget('text-editor', [
                    'editor' => '<p>A collection dedicated to the human heart – it\'s connections, storms and moments of clarity. Each artwork reflects emotional expression through sculpted form, flow and color.</p>',
                    'text_color' => '#555555',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Poppins',
                    'typography_font_size' => ['unit' => 'px', 'size' => 14],
                ]),
                widget('button', [
                    'text' => 'Explore Collection',
                    'link' => ['url' => '/emotions-in-motion/'],
                    'size' => 'sm',
                    'button_text_color' => '#1C1C1E',
                    'background_color' => 'transparent',
                    'border_border' => 'solid',
                    'border_width' => ['unit' => 'px', 'top' => '1', 'right' => '1', 'bottom' => '1', 'left' => '1', 'isLinked' => true],
                    'border_color' => '#1C1C1E',
                ]),
            ],
            [
                '_column_size' => 55,
                'content_position' => 'center',
                '_padding' => ['unit' => 'px', 'top' => '40', 'right' => '40', 'bottom' => '40', 'left' => '60', 'isLinked' => false],
            ]
        ),
        col(
            [
                widget('image', [
                    'image' => ['url' => "$base_url/2026/02/לב_מפרפרים_כחולים.jpg", 'id' => 7766],
                    'image_size' => 'full',
                    'width' => ['unit' => '%', 'size' => 100],
                ]),
            ],
            [
                '_column_size' => 45,
                '_padding' => ['unit' => 'px', 'top' => '20', 'right' => '0', 'bottom' => '20', 'left' => '20', 'isLinked' => false],
            ]
        ),
    ],
    [
        'layout' => 'boxed',
        'content_width' => ['unit' => 'px', 'size' => '1200'],
        'background_background' => 'classic',
        'background_color' => '#FFFFFF',
        'padding' => ['unit' => 'px', 'top' => '40', 'right' => '0', 'bottom' => '40', 'left' => '0', 'isLinked' => false],
    ]
);

// ============================================
// SECTION 5: SPIRIT OF ISRAEL
// ============================================
$spirit = section(
    [
        col(
            [
                widget('image', [
                    'image' => ['url' => "$base_url/2026/02/מפת_ישראל_מציפורים.jpg", 'id' => 7781],
                    'image_size' => 'full',
                    'width' => ['unit' => '%', 'size' => 100],
                ]),
            ],
            [
                '_column_size' => 45,
                '_padding' => ['unit' => 'px', 'top' => '20', 'right' => '20', 'bottom' => '20', 'left' => '0', 'isLinked' => false],
            ]
        ),
        col(
            [
                widget('heading', [
                    'title' => "SPIRIT\nOF ISRAEL",
                    'header_size' => 'h2',
                    'title_color' => '#2196F3',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Playfair Display',
                    'typography_font_size' => ['unit' => 'px', 'size' => 40],
                    'typography_font_weight' => '700',
                ]),
                widget('divider', [
                    'color' => '#C4944A',
                    'weight' => ['unit' => 'px', 'size' => 2],
                ]),
                widget('heading', [
                    'title' => 'Life Movment Energy',
                    'header_size' => 'h4',
                    'title_color' => '#1C1C1E',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Poppins',
                    'typography_font_size' => ['unit' => 'px', 'size' => 16],
                    'typography_font_weight' => '600',
                ]),
                widget('text-editor', [
                    'editor' => '<p>Inspired by the living rhythm of the natural world, this collection captures motion suspended in time. From sky to land to sea, each piece expresses the heartbeat of nature in layered three-dimensional form.</p>',
                    'text_color' => '#555555',
                ]),
                widget('button', [
                    'text' => 'Explore Collection',
                    'link' => ['url' => '/spirit-of-israel/'],
                    'size' => 'sm',
                    'button_text_color' => '#1C1C1E',
                    'background_color' => 'transparent',
                    'border_border' => 'solid',
                    'border_width' => ['unit' => 'px', 'top' => '1', 'right' => '1', 'bottom' => '1', 'left' => '1', 'isLinked' => true],
                    'border_color' => '#1C1C1E',
                ]),
            ],
            [
                '_column_size' => 55,
                'content_position' => 'center',
                '_padding' => ['unit' => 'px', 'top' => '40', 'right' => '60', 'bottom' => '40', 'left' => '40', 'isLinked' => false],
            ]
        ),
    ],
    [
        'layout' => 'boxed',
        'content_width' => ['unit' => 'px', 'size' => '1200'],
        'background_background' => 'classic',
        'background_color' => '#FFFFFF',
        'padding' => ['unit' => 'px', 'top' => '40', 'right' => '0', 'bottom' => '60', 'left' => '0', 'isLinked' => false],
    ]
);

// ============================================
// SECTION 6: EXPLORE BY ELEMENT (Dark)
// ============================================
$explore_element = section(
    [
        col(
            [
                widget('heading', [
                    'title' => 'EXPLORE BY <span style="font-style:italic;font-weight:400;">ELEMENT</span>',
                    'align' => 'center',
                    'header_size' => 'h2',
                    'title_color' => '#FFFFFF',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Playfair Display',
                    'typography_font_size' => ['unit' => 'px', 'size' => 36],
                    'typography_font_weight' => '700',
                ]),
            ],
            ['_column_size' => 100]
        ),
    ],
    [
        'layout' => 'full_width',
        'background_background' => 'classic',
        'background_color' => '#1C1C1E',
        'padding' => ['unit' => 'px', 'top' => '60', 'right' => '0', 'bottom' => '10', 'left' => '0', 'isLinked' => false],
    ]
);

$explore_element_cards = section(
    [
        col(
            [
                widget('image', [
                    'image' => ['url' => "$base_url/2026/02/לב_ורוד_דולפינים.jpg", 'id' => 7760],
                    'image_size' => 'full',
                ]),
                widget('button', [
                    'text' => 'DOLPHINS',
                    'align' => 'center',
                    'link' => ['url' => '/dolphins/'],
                    'size' => 'sm',
                    'button_text_color' => '#FFFFFF',
                    'background_color' => 'transparent',
                    'border_border' => 'solid',
                    'border_width' => ['unit' => 'px', 'top' => '1', 'right' => '1', 'bottom' => '1', 'left' => '1', 'isLinked' => true],
                    'border_color' => '#FFFFFF',
                    'border_radius' => ['unit' => 'px', 'top' => '20', 'right' => '20', 'bottom' => '20', 'left' => '20', 'isLinked' => true],
                ]),
            ],
            ['_column_size' => 33]
        ),
        col(
            [
                widget('image', [
                    'image' => ['url' => "$base_url/2026/02/שמש_מציפורים.jpg", 'id' => 7735],
                    'image_size' => 'full',
                ]),
                widget('button', [
                    'text' => 'BIRDS',
                    'align' => 'center',
                    'link' => ['url' => '/birds/'],
                    'size' => 'sm',
                    'button_text_color' => '#FFFFFF',
                    'background_color' => 'transparent',
                    'border_border' => 'solid',
                    'border_width' => ['unit' => 'px', 'top' => '1', 'right' => '1', 'bottom' => '1', 'left' => '1', 'isLinked' => true],
                    'border_color' => '#FFFFFF',
                    'border_radius' => ['unit' => 'px', 'top' => '20', 'right' => '20', 'bottom' => '20', 'left' => '20', 'isLinked' => true],
                ]),
            ],
            ['_column_size' => 33]
        ),
        col(
            [
                widget('image', [
                    'image' => ['url' => "$base_url/2026/02/פרפרים_סגולים.jpg", 'id' => 7731],
                    'image_size' => 'full',
                ]),
                widget('button', [
                    'text' => 'BUTTERFLIES',
                    'align' => 'center',
                    'link' => ['url' => '/butterflies/'],
                    'size' => 'sm',
                    'button_text_color' => '#FFFFFF',
                    'background_color' => 'transparent',
                    'border_border' => 'solid',
                    'border_width' => ['unit' => 'px', 'top' => '1', 'right' => '1', 'bottom' => '1', 'left' => '1', 'isLinked' => true],
                    'border_color' => '#FFFFFF',
                    'border_radius' => ['unit' => 'px', 'top' => '20', 'right' => '20', 'bottom' => '20', 'left' => '20', 'isLinked' => true],
                ]),
            ],
            ['_column_size' => 34]
        ),
    ],
    [
        'layout' => 'boxed',
        'content_width' => ['unit' => 'px', 'size' => '1200'],
        'background_background' => 'classic',
        'background_color' => '#1C1C1E',
        'padding' => ['unit' => 'px', 'top' => '20', 'right' => '0', 'bottom' => '60', 'left' => '0', 'isLinked' => false],
        'gap' => 'default',
    ]
);

// ============================================
// SECTION 7: EXPLORE BY FORM (Light)
// ============================================
$explore_form = section(
    [
        col(
            [
                widget('heading', [
                    'title' => 'EXPLORE BY <span style="font-style:italic;font-weight:400;">FORM</span>',
                    'align' => 'center',
                    'header_size' => 'h2',
                    'title_color' => '#1C1C1E',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Playfair Display',
                    'typography_font_size' => ['unit' => 'px', 'size' => 36],
                    'typography_font_weight' => '700',
                ]),
            ],
            ['_column_size' => 100]
        ),
    ],
    [
        'layout' => 'full_width',
        'background_background' => 'classic',
        'background_color' => '#F5F0EB',
        'padding' => ['unit' => 'px', 'top' => '60', 'right' => '0', 'bottom' => '10', 'left' => '0', 'isLinked' => false],
    ]
);

$explore_form_cards = section(
    [
        col(
            [
                widget('image', [
                    'image' => ['url' => "$base_url/2026/02/לב_ורוד_מפרפרים.jpg", 'id' => 7761],
                    'image_size' => 'full',
                ]),
                widget('button', [
                    'text' => 'HEARTS',
                    'align' => 'center',
                    'link' => ['url' => '/hearts/'],
                    'size' => 'sm',
                    'button_text_color' => '#1C1C1E',
                    'background_color' => 'transparent',
                    'border_border' => 'solid',
                    'border_width' => ['unit' => 'px', 'top' => '1', 'right' => '1', 'bottom' => '1', 'left' => '1', 'isLinked' => true],
                    'border_color' => '#C4944A',
                    'border_radius' => ['unit' => 'px', 'top' => '20', 'right' => '20', 'bottom' => '20', 'left' => '20', 'isLinked' => true],
                ]),
            ],
            ['_column_size' => 33]
        ),
        col(
            [
                widget('image', [
                    'image' => ['url' => "$base_url/2026/02/פרפרים_לבנים1.jpg", 'id' => 7730],
                    'image_size' => 'full',
                ]),
                widget('button', [
                    'text' => 'BUTTERFLIES',
                    'align' => 'center',
                    'link' => ['url' => '/butterflies/'],
                    'size' => 'sm',
                    'button_text_color' => '#1C1C1E',
                    'background_color' => 'transparent',
                    'border_border' => 'solid',
                    'border_width' => ['unit' => 'px', 'top' => '1', 'right' => '1', 'bottom' => '1', 'left' => '1', 'isLinked' => true],
                    'border_color' => '#C4944A',
                    'border_radius' => ['unit' => 'px', 'top' => '20', 'right' => '20', 'bottom' => '20', 'left' => '20', 'isLinked' => true],
                ]),
            ],
            ['_column_size' => 33]
        ),
        col(
            [
                widget('image', [
                    'image' => ['url' => "$base_url/2026/02/שמש_מציפורים.jpg", 'id' => 7735],
                    'image_size' => 'full',
                ]),
                widget('button', [
                    'text' => 'CIRCLES',
                    'align' => 'center',
                    'link' => ['url' => '/circles/'],
                    'size' => 'sm',
                    'button_text_color' => '#1C1C1E',
                    'background_color' => 'transparent',
                    'border_border' => 'solid',
                    'border_width' => ['unit' => 'px', 'top' => '1', 'right' => '1', 'bottom' => '1', 'left' => '1', 'isLinked' => true],
                    'border_color' => '#C4944A',
                    'border_radius' => ['unit' => 'px', 'top' => '20', 'right' => '20', 'bottom' => '20', 'left' => '20', 'isLinked' => true],
                ]),
            ],
            ['_column_size' => 34]
        ),
    ],
    [
        'layout' => 'boxed',
        'content_width' => ['unit' => 'px', 'size' => '1200'],
        'background_background' => 'classic',
        'background_color' => '#F5F0EB',
        'padding' => ['unit' => 'px', 'top' => '20', 'right' => '0', 'bottom' => '60', 'left' => '0', 'isLinked' => false],
    ]
);

// ============================================
// SECTION 8: VISIT THE GALLERY
// ============================================
$gallery_banner = section(
    [
        col(
            [
                widget('heading', [
                    'title' => 'VISIT THE GALERY',
                    'align' => 'center',
                    'header_size' => 'h2',
                    'title_color' => '#FFFFFF',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Playfair Display',
                    'typography_font_size' => ['unit' => 'px', 'size' => 42],
                    'typography_font_weight' => '700',
                    'link' => ['url' => '/the-gallery/'],
                ]),
            ],
            ['_column_size' => 100]
        ),
    ],
    [
        'layout' => 'full_width',
        'background_background' => 'classic',
        'background_color' => '#C4944A',
        'padding' => ['unit' => 'px', 'top' => '50', 'right' => '0', 'bottom' => '50', 'left' => '0', 'isLinked' => false],
    ]
);

// ============================================
// SECTION 9: CONTACT FORM
// ============================================
$contact = section(
    [
        col(
            [
                widget('heading', [
                    'title' => "BRING A UNIQUE\n3D ARTWORK\nINTO YOUR\nSPACE",
                    'header_size' => 'h2',
                    'title_color' => '#1C1C1E',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Playfair Display',
                    'typography_font_size' => ['unit' => 'px', 'size' => 36],
                    'typography_font_weight' => '700',
                ]),
            ],
            [
                '_column_size' => 50,
                'content_position' => 'center',
                '_padding' => ['unit' => 'px', 'top' => '60', 'right' => '40', 'bottom' => '60', 'left' => '60', 'isLinked' => false],
            ]
        ),
        col(
            [
                widget('shortcode', [
                    'shortcode' => '[elementor-template id="contact-form"]',
                ]),
                // Fallback with basic form fields display
                widget('text-editor', [
                    'editor' => '<div style="display:flex;flex-direction:column;gap:15px;max-width:350px;">
<input type="text" placeholder="Name" style="padding:12px;border:1px solid #C4944A;background:transparent;font-family:Poppins;">
<input type="text" placeholder="Phone" style="padding:12px;border:1px solid #C4944A;background:transparent;font-family:Poppins;">
<input type="email" placeholder="Email" style="padding:12px;border:1px solid #C4944A;background:transparent;font-family:Poppins;">
<button style="padding:12px;background:#C4944A;color:#FFF;border:none;cursor:pointer;font-family:Poppins;">Send ></button></div>',
                ]),
            ],
            [
                '_column_size' => 50,
                'content_position' => 'center',
                '_padding' => ['unit' => 'px', 'top' => '60', 'right' => '60', 'bottom' => '60', 'left' => '40', 'isLinked' => false],
            ]
        ),
    ],
    [
        'layout' => 'boxed',
        'content_width' => ['unit' => 'px', 'size' => '1200'],
        'background_background' => 'classic',
        'background_color' => '#F5F0EB',
        'padding' => ['unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true],
    ]
);

// ============================================
// SECTION 10: SOCIAL MEDIA
// ============================================
$social = section(
    [
        col(
            [
                widget('heading', [
                    'title' => "ART IN MOTION ON SOCIAL",
                    'align' => 'center',
                    'header_size' => 'h2',
                    'title_color' => '#FFFFFF',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Playfair Display',
                    'typography_font_size' => ['unit' => 'px', 'size' => 32],
                    'typography_font_weight' => '700',
                ]),
                widget('heading', [
                    'title' => 'FOLLOW MY JOURNEY',
                    'align' => 'center',
                    'header_size' => 'h3',
                    'title_color' => '#C4944A',
                    'typography_typography' => 'custom',
                    'typography_font_family' => 'Playfair Display',
                    'typography_font_size' => ['unit' => 'px', 'size' => 28],
                    'typography_font_weight' => '700',
                    'typography_font_style' => 'italic',
                ]),
                widget('social-icons', [
                    'social_icon_list' => [
                        [
                            'social_icon' => ['value' => 'fab fa-instagram', 'library' => 'fa-brands'],
                            'link' => ['url' => 'https://www.instagram.com/amir_shabtay_art/', 'is_external' => 'true'],
                            '_id' => 'instagram',
                        ],
                        [
                            'social_icon' => ['value' => 'fab fa-facebook-f', 'library' => 'fa-brands'],
                            'link' => ['url' => 'https://www.facebook.com/amirshabtayart', 'is_external' => 'true'],
                            '_id' => 'facebook',
                        ],
                    ],
                    'align' => 'center',
                    'icon_color' => 'custom',
                    'icon_primary_color' => '#FFFFFF',
                    'icon_secondary_color' => 'transparent',
                    'icon_size' => ['unit' => 'px', 'size' => 18],
                    'icon_spacing' => ['unit' => 'px', 'size' => 15],
                ]),
            ],
            ['_column_size' => 100]
        ),
    ],
    [
        'layout' => 'full_width',
        'background_background' => 'classic',
        'background_color' => '#1C1C1E',
        'padding' => ['unit' => 'px', 'top' => '60', 'right' => '0', 'bottom' => '60', 'left' => '0', 'isLinked' => false],
    ]
);

// ============================================
// BUILD THE COMPLETE PAGE
// ============================================
$page_data = [
    $hero,
    $hero_bottom,
    $signature,
    $pulse,
    $emotions,
    $spirit,
    $explore_element,
    $explore_element_cards,
    $explore_form,
    $explore_form_cards,
    $gallery_banner,
    $contact,
    $social,
];

$json = json_encode($page_data);

// Update the page
update_post_meta(8043, '_elementor_data', wp_slash($json));
update_post_meta(8043, '_elementor_edit_mode', 'builder');
update_post_meta(8043, '_elementor_template_type', 'wp-page');
update_post_meta(8043, '_wp_page_template', 'elementor_header_footer');

// Clear Elementor cache
if (class_exists('\Elementor\Plugin')) {
    \Elementor\Plugin::$instance->files_manager->clear_cache();
}

echo "SUCCESS: Page built with " . count($page_data) . " sections!";
