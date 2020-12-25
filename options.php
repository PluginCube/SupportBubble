<?php


/**
 * Shorthand variable
 */
$options = $this->framework->options;


/**
 * Section: Button
 */

$options->add('section', [
    'id' => 'button',
    'title' => 'Button',
]);

$options->add('link', [
    'type' => 'section',
    'title' => 'Button',
    'section' => 'button',
    'icon' => 'ri-chat-smile-3-fill',
]);

$options->add('field', [
    'id' => 'text',
    'type' => 'text',
    'title' => 'Text',
    'section' => 'button',
    'default' => 'Contact Us',
]);

$options->add('field', [
    'id' => 'icon',
    'type' => 'icon',
    'title' => 'Icon',
    'section' => 'button',
    'default' => 'ri-chat-smile-3-fill',
]);

$options->add('field', [
    'id' => 'size',
    'type' => 'select',
    'title' => 'Size',
    'section' => 'button',
    'default' => 'medium',
    'choices' => [
        [
            'id' => 'small',
            'title' => 'Small'
        ],
        [
            'id' => 'medium',
            'title' => 'Medium'
        ],
        [
            'id' => 'large',
            'title' => 'Large'
        ],
    ]
]);

$options->add('field', [
    'id' => 'position',
    'type' => 'select',
    'title' => 'Position',
    'section' => 'button',
    'default' => 'bottom_right',
    'choices' => [
        [
            'id' => 'top_right',
            'title' => 'Top right'
        ],
        [
            'id' => 'bottom_right',
            'title' => 'Bottom right'
        ],
        [
            'id' => 'top_left',
            'title' => 'Top left'
        ],
        [
            'id' => 'bottom_left',
            'title' => 'Bottom left'
        ]
    ]
]);

$options->add('field', [
    'id' => 'bg',
    'type' => 'color',
    'title' => 'Background',
    'section' => 'button',
    'default' => '#1778F2',
]);

$options->add('field', [
    'id' => 'text_icon_color',
    'type' => 'color',
    'title' => 'Text Color',
    'section' => 'button',
    'default' => '#ffffff',
]);

$options->add('field', [
    'id' => 'dismissible',
    'type' => 'switch',
    'title' => 'Dismissible',
    'section' => 'button',
    'default' => false,
]);



/**
 * Section: Prompts
 */

$options->add('section', [
    'id' => 'prompts',
    'title' => 'Prompts',
]);

$options->add('link', [
    'type' => 'section',
    'title' => 'Prompts',
    'section' => 'prompts',
    'icon' => 'ri-message-3-fill',
]);

$options->add('field', [
    'id' => 'messages',
    'type' => 'repeater',
    'title' => 'Items',
    'section' => 'prompts',
    'fields' => [
        [
            'id' => 'message',
            'type' => 'text',
            'title' => 'Message',
            'default' => 'New Message',
            'attributes' => [
                'placeholder' => 'Message here',
            ]
        ]
    ],
    'default' => [
        [
            'message' => 'Hello'
        ],
        [
            'message' => 'You can use this button to contact us'
        ]
    ],
]);



/**
 * Section: Menu
 */

$options->add('section', [
    'id' => 'menu',
    'title' => 'Menu',
]);

$options->add('link', [
    'type' => 'section',
    'title' => 'Menu',
    'section' => 'menu',
    'icon' => 'ri-layout-right-fill',
]);

$options->add('field', [
    'id' => 'items',
    'type' => 'repeater',
    'title' => 'Items',
    'section' => 'menu',
    'fields' => [
        [
            'id' => 'title',
            'type' => 'text',
            'title' => 'Title',
            'default' => 'New Item',
        ],
        [
            'id' => 'subtitle',
            'type' => 'text',
            'title' => 'Subtitle',
            'default' => 'The subtitle goes here',
        ],
        [
            'id' => 'type',
            'type' => 'select',
            'title' => 'Type',
            'default' => 'link',
            'choices' => [
                [
                    'id' => 'link',
                    'title' => 'Link'
                ],
                [
                    'id' => 'fb_integration',
                    'title' => 'Integration → Facebook'
                ]
            ]
        ],
        [
            'id' => 'url',
            'type' => 'text',
            'title' => 'URL',
            'condition' => ['type', '===', 'link'],
            'attributes' => [
                'placeholder' => 'facebook.com',
            ]
        ],        
        [
            'id' => 'icon',
            'type' => 'icon',
            'title' => 'Icon',
            'default' => 'ri-messenger-fill',
        ],
        [
            'id' => 'color',
            'type' => 'color',
            'title' => 'Color',
            'default' => '#2c01ff',
        ],
    ],
]);