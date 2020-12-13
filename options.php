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
    'title' => 'Support Button',
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
    'default' => 'right',
    'choices' => [
        [
            'id' => 'top',
            'title' => 'Top'
        ],
        [
            'id' => 'right',
            'title' => 'Right'
        ],
        [
            'id' => 'bottom',
            'title' => 'Bottom'
        ],
        [
            'id' => 'left',
            'title' => 'Left'
        ]
    ]
]);

$options->add('field', [
    'id' => 'alignment',
    'type' => 'select',
    'title' => 'Alignment',
    'section' => 'button',
    'default' => 'end',
    'choices' => [
        [
            'id' => 'start',
            'title' => 'Start'
        ],
        [
            'id' => 'center',
            'title' => 'Center'
        ],
        [
            'id' => 'end',
            'title' => 'End'
        ]
    ]
]);

$options->add('field', [
    'id' => 'bg',
    'type' => 'color',
    'title' => 'Background',
    'section' => 'button',
    'default' => '#3568eb',
]);

$options->add('field', [
    'id' => 'text_icon_color',
    'type' => 'color',
    'title' => 'Text & Icon Color',
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


$options->add('field', [
    'id' => 'messages',
    'type' => 'repeater',
    'title' => 'Prompt Messages',
    'section' => 'button',
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
