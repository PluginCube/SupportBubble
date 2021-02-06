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

        add_filter('plugincube/options/supportbubble/add/field', [$this, 'field']);
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
        if ($args['section'] !== 'forms' || $args['id'] !== 'forms') {
            $args['limit'] = false;
        };

        if ($args['section'] !== 'menu' || $args['id'] !== 'item') {
            $args['limit'] = false;
        };

        return $args;
    }
}
