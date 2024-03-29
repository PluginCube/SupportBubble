<?php

/**
 * Classname: PluginCube\SupportBubble\RemoveLimit
 */

namespace PluginCube\SupportBubble;

// Exit if accessed directly.
defined('ABSPATH') || exit;


class RemoveLimit
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

        add_filter('plugincube/options/supportbubble/add/field/menu/items', [$this, 'field']);
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
        $args['limit'] = false;

        return $args;
    }
}
