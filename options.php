<?php

/**
 * Shorthand variable
 */

$options = $this->framework->options;


/**
 * Helpr functions
 */
function get_post_type_choices()
{
    global $wp_post_types;

    $choices = [];

    foreach (get_post_types() as $name) {
        $choices[] = [
            'value' => $name,
            'label' => $wp_post_types[$name]->label
        ];
    }

    return $choices;
}

function get_user_role_choices()
{
    global $wp_roles;

    $choices = [];

    foreach (wp_roles()->roles as $name => $info) {
        $choices[] = [
            'value' => $name,
            'label' => $info['name']
        ];
    }

    return $choices;
}


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
        // Visibility Rules
        [
            'id' => 'visibility',
            'type' => 'repeater',
            'title' => 'Visibility Rules',
            'default' => [],
            'fields' => [
                [
                    'id' => 'target',
                    'type' => 'select',
                    'title' => 'Target',
                    'default' => ' ',
                    'choices' => [
                        [
                            'value' => 'PostID',
                            'label' => 'Post ID'
                        ],
                        [
                            'value' => 'PostType',
                            'label' => 'Post Type'
                        ],
                        [
                            'value' => 'UserRole',
                            'label' => 'User Role'
                        ],
                        [
                            'value' => 'Time',
                            'label' => 'Time'
                        ],
                        [
                            'value' => 'LoginStatus',
                            'label' => 'Login Status'
                        ],
                    ]
                ],
                [
                    'id' => 'ids',
                    'type' => 'select',
                    'title' => 'IDs List',
                    'condition' => 'data.target == "PostID"',
                    'default' => '',
                    'attributes' => [
                        'isMulti' => true,
                        'isCreatable' => true,
                    ]
                ],
                [
                    'id' => 'post_types',
                    'type' => 'select',
                    'title' => 'Post Type',
                    'condition' => 'data.target == "PostType"',
                    'choices' => get_post_type_choices(),
                    'attributes' => [
                        'isMulti' => true,
                    ]
                ],
                [
                    'id' => 'user_roles',
                    'type' => 'select',
                    'title' => 'User Role',
                    'condition' => 'data.target == "UserRole"',
                    'choices' => get_user_role_choices(),
                    'attributes' => [
                        'isMulti' => true,
                    ]
                ],
                [
                    'id' => 'days',
                    'type' => 'select',
                    'title' => 'Days',
                    'condition' => 'data.target == "Time"',
                    'choices' => [
                        [
                            'value' => 'monday',
                            'label' => 'Monday'
                        ],
                        [
                            'value' => 'tuesday',
                            'label' => 'Tuesday'
                        ],
                        [
                            'value' => 'wednesday',
                            'label' => 'Wednesday'
                        ],
                        [
                            'value' => 'thursday',
                            'label' => 'Thursday'
                        ],
                        [
                            'value' => 'friday',
                            'label' => 'Friday'
                        ],
                        [
                            'value' => 'saturday',
                            'label' => 'Saturday'
                        ],
                        [
                            'value' => 'sunday',
                            'label' => 'Sunday'
                        ],
                    ],
                    'attributes' => [
                        'isMulti' => true,
                    ]
                ],
                [
                    'id' => 'from',
                    'type' => 'text',
                    'title' => 'From',
                    'condition' => 'data.target == "Time"',
                    'attributes' => [
                        'type' => 'time',
                    ]
                ],
                [
                    'id' => 'to',
                    'type' => 'text',
                    'title' => 'To',
                    'condition' => 'data.target == "Time"',
                    'attributes' => [
                        'type' => 'time',
                    ]
                ],
                [
                    'id' => 'only_logged_in',
                    'type' => 'switch',
                    'title' => 'Logged-in Only?',
                    'condition' => 'data.target == "LoginStatus"',
                    'default' => true
                ],
            ]
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
