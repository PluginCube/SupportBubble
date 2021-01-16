<?php


/**
 * Shorthand variable
 */
$options = $this->framework->options;


/**
 * Section: Bubble
 */

$options->add('section', [
    'id' => 'bubble',
    'title' => 'Bubble',
]);

$options->add('link', [
    'type' => 'section',
    'title' => 'Bubble',
    'section' => 'bubble',
    'icon' => 'ri-chat-smile-3-fill',
]);

$options->add('field', [
    'id' => 'icon',
    'type' => 'icon',
    'title' => 'Icon',
    'section' => 'bubble',
    'default' => 'ri-chat-smile-3-fill',
]);

$options->add('field', [
    'id' => 'size',
    'type' => 'select',
    'title' => 'Size',
    'section' => 'bubble',
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
    'section' => 'bubble',
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
    'section' => 'bubble',
    'default' => '#0043ff',
]);

$options->add('field', [
    'id' => 'color',
    'type' => 'color',
    'title' => 'Text Color',
    'section' => 'bubble',
    'default' => '#ffffff',
]);

$options->add('field', [
    'id' => 'dismissible',
    'type' => 'switch',
    'title' => 'Dismissible',
    'section' => 'bubble',
    'default' => false,
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
    'title' => 'Support Menu',
    'section' => 'menu',
    'icon' => 'ri-layout-right-fill',
]);

$options->add('field', [
    'id' => 'items',
    'type' => 'repeater',
    'title' => 'Items',
    'section' => 'menu',
    'default' => [],
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
                    'id' => 'messenger',
                    'title' => 'Messenger'
                ],
                [
                    'id' => 'whatsapp',
                    'title' => 'WhatsApp'
                ],
                [
                    'id' => 'form',
                    'title' => 'Contact Form'
                ]
            ]
        ],
        // Link
        [
            'id' => 'url',
            'type' => 'text',
            'title' => 'URL',
            'condition' => 'data.type == "link"',
            'default' => '',
        ],
        // Whatsapp & Messenger
        [
            'id' => 'welcome_message',
            'type' => 'textarea',
            'title' => 'Welcome Message',
            'condition' => 'data.type !== "link" && data.type !== "form"',
            'default' => '',
        ],
        [
            'id' => 'avatar',
            'type' => 'image',
            'title' => 'User Avatar',
            'condition' => 'data.type !== "link" && data.type !== "form"',
            'default' => 'https://images.pexels.com/photos/53453/marilyn-monroe-woman-actress-pretty-53453.jpeg',
        ],
        [
            'id' => 'user_name',
            'type' => 'text',
            'title' => 'User Name',
            'condition' => 'data.type !== "link" && data.type !== "form"',
            'default' => 'Nancy',
        ],
        [
            'id' => 'caption',
            'type' => 'text',
            'title' => 'Caption',
            'condition' => 'data.type !== "link" && data.type !== "form"',
            'default' => 'Typically replies within a day',
        ],
        [
            'id' => 'phone',
            'type' => 'text',
            'title' => 'Phone Number',
            'condition' => 'data.type == "whatsapp"',
            'default' => '',
        ],
        // Messenger
        [
            'id' => 'messenger_url',
            'type' => 'text',
            'title' => 'Messenger URL',
            'condition' => 'data.type == "messenger"',
            'default' => '',
        ],
        // Form
        [
            'id' => 'fields',
            'type' => 'repeater',
            'title' => 'Fields',
            'condition' => 'data.type == "form"',
            'default' => [],
            'fields' => [
                [
                    'id' => 'title',
                    'type' => 'text',
                    'title' => 'Title',
                    'default' => 'Your Name*',
                ],
                [
                    'id' => 'type',
                    'type' => 'select',
                    'title' => 'Type',
                    'default' => 'short_text',
                    'choices' => [
                        [
                            'id' => 'short_text',
                            'title' => 'Single Line Text'
                        ],
                        [
                            'id' => 'paragraph',
                            'title' => 'Paragraph Text'
                        ],
                        [
                            'id' => 'number',
                            'title' => 'Number'
                        ],
                        [
                            'id' => 'checkbox',
                            'title' => 'Checkbox'
                        ],
                        [
                            'id' => 'date',
                            'title' => 'Date'
                        ],
                        [
                            'id' => 'email',
                            'title' => 'Email Address'
                        ],
                        [
                            'id' => 'checkbox',
                            'title' => 'Phone Number'
                        ],
                    ]
                ]
                
            ]
        ],
    ],
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
            'type' => 'textarea',
            'title' => 'Message',
            'default' => 'New Message',
            'attributes' => [
                'placeholder' => 'Message here',
            ]
        ]
    ],
    'default' => [
        [
            'message' => 'Hi there 👋 </br>
            How can I help you?'
        ],
    ],
]);
