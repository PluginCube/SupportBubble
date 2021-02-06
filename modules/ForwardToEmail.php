<?php

/**
 * Classname: PluginCube\SupportBubble\ForwardToEmail
 */

namespace PluginCube\SupportBubble;

// Exit if accessed directly.
defined('ABSPATH') || exit;


class ForwardToEmail
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

        add_filter('plugincube/options/supportbubble/add/field', [$this, 'fields']);
        add_action('plugincube/supportbubble/events/form/submit', [$this, 'send']);
    }


    /**
     * Add the field
     *
     * @since 1.0.0
     * @access public
     * @return array
     */
    public function fields($args)
    {
        if ($args['section'] !== 'forms' || $args['id'] !== 'forms') return $args;

        $field = & $args['fields'][array_search('forward', array_column($args['fields'], 'id'))];
        
        $field['type'] = 'switch';

        $field['default'] = false;

        // Subject
        $args['fields'][] = [
            'id' => 'subject',
            'type' => 'select',
            'title' => 'Subject',
            'condition' => 'data.forward',
            'lookup' => 'args.activeItemValues.fields',
        ];

        // Message
        $args['fields'][] = [
            'id' => 'message',
            'type' => 'select',
            'title' => 'Message',
            'condition' => 'data.forward',
            'lookup' => 'args.activeItemValues.fields',
        ];

        // From
        $args['fields'][] = [
            'id' => 'from',
            'type' => 'select',
            'title' => 'From',
            'condition' => 'data.forward',
            'lookup' => 'args.activeItemValues.fields',
        ];

        // To
        $args['fields'][] = [
            'id' => 'to',
            'type' => 'select',
            'title' => 'To',
            'condition' => 'data.forward',
            'default' => '',
            'attributes' => [
                'isMulti' => true,
                'isCreatable' => true,
            ]
        ];

        return $args;
    }


    /**
     * Send
     *
     * @since 1.0.0
     * @access public
     * @return array
     */
    public function send($post)
    {
        if ( isset($_POST['forward']) && filter_var($_POST['forward'], FILTER_VALIDATE_BOOLEAN) ) {
            $from = sanitize_email($post['meta_input'][$_POST['from']]);
            $message = $post['meta_input'][$_POST['message']];
            $subject = $post['meta_input'][$_POST['subject']];
            $to = implode(', ', array_column($_POST['to'], 'value'));

            $headers = ["From: $from"];
            
            $email = wp_mail($to, $subject, $message, $headers);
        }
    }
}
