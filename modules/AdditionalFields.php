<?php

/**
 * Classname: PluginCube\SupportBubble\AdditionalFields
 */

namespace PluginCube\SupportBubble;

// Exit if accessed directly.
defined('ABSPATH') || exit;


class AdditionalFields
{
    /**
     * Parent instance.
     *
     * @since 1.0.0
     * @access private
     * @var string
     */
    private $parent;

    /**
     * Class constructer.
     *
     * @since 1.0.0
     * @access public
     *
     * @param array $parent The parent instance.
     *
     * @return void
     */
    public function __construct($parent)
    {
        $this->parent = $parent;

        add_filter('plugincube/options/supportbubble/add/field/forms/forms', [$this, 'field']);
    }
    
    /**
     * Add the field
     *
     * @since 1.0.0
     * @access public
     * @return array
     */
    public function field($args)
    {
        $fields = & $args['fields'][array_search('fields', array_column($args['fields'], 'id'))]['fields'];
        $types = & $fields[array_search('type', array_column($fields, 'id'))];

        $types['choices'][] = [
            'value' => 'toggle',
            'label' => 'Toggle'
        ];

        $types['choices'][] = [
            'value' => 'dropdown',
            'label' => 'Dropdown'
        ];

        $fields[] = [
            'id' => 'choices',
            'type' => 'select',
            'title' => 'Choices',
            'condition' => 'data.type == "dropdown"',
            'default' => [],
            'attributes' => [
                'isMulti' => true,
                'isCreatable' => true,
            ]
        ];

        return $args;
    }
}
