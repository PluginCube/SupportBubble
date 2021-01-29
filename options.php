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
    'icon' => 'ri-chat-3-fill',
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
            'value' => 'small',
            'label' => 'Small'
        ],
        [
            'value' => 'medium',
            'label' => 'Medium'
        ],
        [
            'value' => 'large',
            'label' => 'Large'
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
            'value' => 'top_right',
            'label' => 'Top right'
        ],
        [
            'value' => 'bottom_right',
            'label' => 'Bottom right'
        ],
        [
            'value' => 'top_left',
            'label' => 'Top left'
        ],
        [
            'value' => 'bottom_left',
            'label' => 'Bottom left'
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

$options->add('field', [
    'id' => 'prompts',
    'type' => 'repeater',
    'title' => 'Prompt Messages',
    'section' => 'bubble',
    'default' => [],
    'fields' => [
        [
            'id' => 'message',
            'type' => 'textarea',
            'title' => 'Message',
            'default' => 'New Message',
            'attributes' => [
                'placeholder' => 'Message...',
            ]
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
    'default' => [],
    'limit'   => 5,
    'limit_link' => [
        'icon' => 'ri-coin-fill',
        'text' => 'Go Pro',
        'msg'  => 'Upgrade to the Pro plan to get unlimited items.',
        'url' => $this->framework->freemius->get_upgrade_url()
    ],
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
                    'value' => 'link',
                    'label' => 'Link'
                ],
                [
                    'value' => 'messenger',
                    'label' => 'Messenger'
                ],
                [
                    'value' => 'whatsapp',
                    'label' => 'WhatsApp'
                ],
                [
                    'value' => 'form',
                    'label' => 'Contact Form'
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
            'id' => 'headline',
            'type' => 'text',
            'title' => 'Headline',
            'condition' => 'data.type == "form"',
            'default' => '',
        ],
        [
            'id' => 'description',
            'type' => 'text',
            'title' => 'Description',
            'condition' => 'data.type == "form"',
            'default' => '',
        ],
        [
            'id' => 'form',
            'type' => 'select',
            'title' => 'Form',
            'condition' => 'data.type == "form"',
            'lookup' => 'data.forms.forms',
        ],
        [
            'id' => 'success_message',
            'type' => 'textarea',
            'title' => 'Success Message',
            'condition' => 'data.type == "form"',
            'default' => '',
        ],
        // Targeting Rules
        [
            'id' => 'targeting',
            'type' => 'link',
            'title' => 'Audience Targeting',
            'default' => [],
            'icon' => 'ri-coin-fill',
            'text' => 'Go Pro',
            'msg'  => 'Our audience targeting feature allows you to show/hide items on specific pages, users, login status, and for a specific time of the day.',
            'url' => $this->framework->freemius->get_upgrade_url()
        ],
    ],
]);



/**
 * Section: Forms
 */

$options->add('section', [
    'id' => 'forms',
    'title' => 'Forms',
]);

$options->add('link', [
    'type' => 'section',
    'title' => 'Forms',
    'section' => 'forms',
    'icon' => 'ri-mail-fill',
]);

$options->add('field', [
    'id' => 'forms',
    'type' => 'repeater',
    'title' => 'Forms',
    'section' => 'forms',
    'limit'   => 3,
    'limit_link' => [
        'icon' => 'ri-coin-fill',
        'text' => 'Go Pro',
        'msg'  => 'Upgrade to the Pro plan to get unlimited forms.',
        'url' => $this->framework->freemius->get_upgrade_url()
    ],
    'remove_alert' => 'This will remove the form and all the submission data associated with it. Are you sure?',
    'fields' => [
        [
            'id' => 'title',
            'type' => 'text',
            'title' => 'Title',
            'default' => 'New Form',
        ],
        [
            'id' => 'fields',
            'type' => 'repeater',
            'title' => 'Fields',
            'default' => [],
            'remove_alert' => 'This will remove the field and all the submission data associated with it. Are you sure?',
            'fields' => [
                [
                    'id' => 'title',
                    'type' => 'text',
                    'title' => 'Title',
                    'default' => 'New Field',
                ],
                [
                    'id' => 'type',
                    'type' => 'select',
                    'title' => 'Type',
                    'default' => 'single_line_text',
                    'choices' => [
                        [
                            'value' => 'single_line_text',
                            'label' => 'Single Line Text'
                        ],
                        [
                            'value' => 'paragraph',
                            'label' => 'Paragraph Text'
                        ],
                        [
                            'value' => 'number',
                            'label' => 'Number'
                        ],
                        [
                            'value' => 'switch',
                            'label' => 'Switch'
                        ],
                        [
                            'value' => 'date',
                            'label' => 'Date'
                        ],
                        [
                            'value' => 'email',
                            'label' => 'Email Address'
                        ],
                        [
                            'value' => 'phone_number',
                            'label' => 'Phone Number'
                        ],
                    ]
                ]
            ]
        ],
        [
            'id' => 'show_in_admin',
            'type' => 'switch',
            'title' => 'Show in admin?',
            'default' => true,
        ],
        [
            'id' => 'forward',
            'type' => 'link',
            'title' => 'Forward to Email?',
            'default' => [],
            'icon' => 'ri-coin-fill',
            'text' => 'Go Pro',
            'url' => $this->framework->freemius->get_upgrade_url()
        ],
    ],
    'default' => [],
]);


/**
 * Section: Advanced
 */


$options->add('section', [
    'id' => 'advanced',
    'title' => 'Advanced',
]);

$options->add('link', [
    'type' => 'section',
    'title' => 'Advanced',
    'section' => 'advanced',
    'icon' => 'ri-inbox-archive-fill',
]);

$options->add('field', [
    'id' => 'export',
    'type' => 'export',
    'title' => 'Export',
    'section' => 'advanced',
]);

$options->add('field', [
    'id' => 'import',
    'type' => 'import',
    'title' => 'Import',
    'section' => 'advanced',
]);
