<?php

/**
 * Classname: PluginCube\InstantSupport\Visibility
 */

namespace PluginCube\InstantSupport;

// Exit if accessed directly.
defined('ABSPATH') || exit;


class Visibility
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
    }
    
    /**
     * Verify
     *
     * @since 1.0.0
     * @access public
     * @return boolean
     */
    public function verify($rules)
    {
        foreach ($rules as $rule) {
            $visibility = true;

            switch ($rule['target']) {
                case 'PostID':
                    $visibility = $this->post_id($rule);
                    break;

                case 'PostType':
                    $visibility = $this->post_type($rule);
                    break;

                case 'UserRole':
                    $visibility = $this->user_role($rule);
                    break;
    
                case 'Time':
                    $visibility = $this->time($rule);
                    break;

                case 'LoginStatus':
                    $visibility = $this->login_status($rule);
                    break;
        
                default:
                    break;
            }

            if (! $visibility) {
                return false;
            }
        }

        return true;
    }

    /**
     * Verify login status
     *
     * @since 1.0.0
     * @access public
     * @return boolean
     */
    public function login_status($rule)
    {
        $required = filter_var($rule['only_logged_in'], FILTER_VALIDATE_BOOLEAN);
        
        $current = is_user_logged_in();

        return ($required === $current);
    }

    /**
     * Verify post id
     *
     * @since 1.0.0
     * @access public
     * @return boolean
     */
    public function post_id($rule)
    {
        $current = get_queried_object_id();
        $ids = array_column($rule['ids'], 'value');
        
        if ($current) {
            return in_array($current, $ids);
        }

        return false;
    }

    /**
     * Verify post type
     *
     * @since 1.0.0
     * @access public
     * @return boolean
     */
    public function post_type($rule)
    {
        $current = get_post_type();
        $types = array_column($rule['post_types'], 'value');
        
        if ($current) {
            return in_array($current, $types);
        }

        return false;
    }

    /**
     * Verify user role
     *
     * @since 1.0.0
     * @access public
     * @return boolean
     */
    public function user_role($rule)
    {
        $roles = array_column($rule['user_roles'], 'value');
        
        if (is_user_logged_in()) {
            $current = (array) wp_get_current_user()->roles;
            
            foreach ($current as $role) {
                if (in_array($role, $roles)) {
                    return true;
                }
            }
        }
        
        return false;
    }

    /**
     * Verify time
     *
     * @since 1.0.0
     * @access public
     * @return boolean
     */
    public function time($rule)
    {
        if (isset($rule['days']) && is_array($rule['days'])) {
            $days = array_column($rule['days'], 'value');

            $currentDay = lcfirst(date('l'));

            if (! in_array($currentDay, $days)) {
                return false;
            }
        }

        if (isset($rule['from']) && isset($rule['to'])) {
            $currentTime = current_time('timestamp');

            $from = strtotime($rule['from']);
            $to = strtotime($rule['to']);

            if ($currentTime >= $from && $currentTime <= $to) {
                return true;
            } else {
                return false;
            }
        }
        
        return true;
    }
}
