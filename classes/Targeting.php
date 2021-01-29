<?php

/**
 * Classname: PluginCube\SupportBubble\Targeting
 */

namespace PluginCube\SupportBubble;

// Exit if accessed directly.
defined('ABSPATH') || exit;


class Targeting
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

        // add_filter('plugincube/supportbubble/frontend/data', [$this, 'filter']);
        // add_filter('plugincube/options/support-bubble/add/field', [$this, 'field']);
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
        if ($args['section'] !== 'menu' || $args['id'] !== 'items') return $args;

        $field = & $args['fields'][array_search('targeting', array_column($args['fields'], 'id'))];
        
        $field['type'] = 'repeater';

        $field['fields'] = [
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
                'choices' => $this->get_post_type_choices(),
                'attributes' => [
                    'isMulti' => true,
                ]
            ],
            [
                'id' => 'user_roles',
                'type' => 'select',
                'title' => 'User Role',
                'condition' => 'data.target == "UserRole"',
                'choices' => $this->get_user_role_choices(),
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
            ]
        ];

        return $args;
    }

    /**
     * Get post type choices
     *
     * @since 1.0.0
     * @access public
     * @return array
     */
    public function get_post_type_choices()
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

    /**
     * Get user role choices
     *
     * @since 1.0.0
     * @access public
     * @return array
     */
    public function get_user_role_choices()
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
     * Filter the frontend data according targeting rules
     *
     * @since 1.0.0
     * @access public
     * @return boolean
     */
    public function filter($data)
    {
        $data['settings']['menu']['items'] = array_filter($data['settings']['menu']['items'], function ($item) {
            $visible = isset($item['targeting']) ? $this->verify_rules($item['targeting']) : true;
            
            return $visible;
        });

        return $data;
    }

    /**
     * Verify rules
     *
     * @since 1.0.0
     * @access public
     * @return boolean
     */
    public function verify_rules($rules)
    {
        foreach ($rules as $rule) {
            $targeting = true;

            switch ($rule['target']) {
                case 'PostID':
                    $targeting = $this->verify_post_id($rule);
                    break;

                case 'PostType':
                    $targeting = $this->verify_post_type($rule);
                    break;

                case 'UserRole':
                    $targeting = $this->verify_user_role($rule);
                    break;
    
                case 'Time':
                    $targeting = $this->verify_time($rule);
                    break;

                case 'LoginStatus':
                    $targeting = $this->verify_login_status($rule);
                    break;
        
                default:
                    break;
            }

            if (! $targeting) {
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
    public function verify_login_status($rule)
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
    public function verify_post_id($rule)
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
    public function verify_post_type($rule)
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
    public function verify_user_role($rule)
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
    public function verify_time($rule)
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
