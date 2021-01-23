<?php

/**
 * @package   SupportBubble
 * @author    PluginCube <support@plugincube.com>
 * @copyright SupportBubble
 * @license   GPLv3
 * @link      https://SupportBubble.com/
 *
 * Plugin Name:     SupportBubble
 * Plugin URI:      https://SupportBubble.co
 * Description:     Floating support button & contact form
 * Version:         1.0.0
 * Author:          PluginCube
 * Author URI:      https://plugincube.com/
 * Text Domain:     support-bubble
 * License:         GPLv3
 * License URI:     https://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:     /languages
 * Requires PHP:    5.6
 */

namespace PluginCube;

# Exit if accessed directly.
defined('ABSPATH') || exit;

class SupportBubble
{
    /**
     * Version, used for cache-busting.
     *
     * @since 1.0.0
     * @access private
     * @var string
     */
    private $version;

    /**
     * Directory URL.
     *
     * @since 1.0.0
     * @access private
     * @var string
     */
    private $url;

    /**
     * Directory path.
     *
     * @since 1.0.0
     * @access private
     * @var string
     */
    private $path;

    /**
     * Framework instance.
     *
     * @since 1.0.0
     * @access private
     * @var object
     */
    private $framework;

    /**
     * Settings values.
     *
     * @since 1.0.0
     * @access private
     * @var array
     */
    private $values;

    /**
     * Sub Classes.
     *
     * @since 1.0.0
     * @access public
     * @var array
     */
    public $classes;

    /**
     * Class constructer.
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function __construct()
    {
        # Plugin version
        $this->version  = \get_file_data(__FILE__, ['Version' => 'Version'])['Version'];

        # Path & URL
        $this->path = trailingslashit(str_replace('\\', '/', dirname(__FILE__)));
        $this->url = site_url(str_replace(str_replace('\\', '/', ABSPATH), '', $this->path));

        # define( 'WP_FS__DEV_MODE', true );

        # Load the framework
        require_once $this->path . '/framework/framework.php';

        # Load sub classes
        $this->classes = $this->get_sub_classes();

        # Init the framework
        $this->framework = new Framework([
            'id' => '7401',
            'slug' => 'support-bubble',
            'title' => 'Instant Support',
            'public_key' => 'pk_677cbbdf1055c4c6bf6a410734760',
            'icon' => '',
        ]);

        # Options
        include_once $this->path . '/options.php';

        $this->values = $this->framework->options->get_values();
    
        # Initialize
        $this->init();
    }

    /**
     * Initialize
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function init()
    {
        # Assets
        add_action('wp_enqueue_scripts', [$this, "assets"]);

        # Localize data
        add_action('wp_enqueue_scripts', [$this, "data"]);

        # Render the front-end
        add_action('wp_footer', [$this, 'render']);

        # Forms post type
        foreach ($this->values['forms']['forms'] as $form) {
            add_action('init', function ($columns) use ($form) {
                $this->add_form_post_type($form);
                $this->add_form_post_type_meta($form);
            });
            
            add_filter("manage_$form[_id]_posts_columns", function ($columns) use ($form) {
                return $this->forms_post_type_columns($columns, $form);
            });

            add_filter("manage_$form[_id]_posts_custom_column", [$this, 'forms_post_type_columns_content'], 10, 2);

            add_filter("bulk_actions-edit-$form[_id]", '__return_empty_array');
        }

        # Ajax form submit
        add_action('wp_ajax_it_form_submit', [$this, 'submit']);
    }

    /**
     * Get sub classes
     *
     * @since 1.0.0
     * @access public
     * @return array
     */
    public function get_sub_classes()
    {
        $classes = [];

        $files = glob($this->path . "classes/*.php");

        foreach ($files as $file) {
            require_once $file;

            $data = \get_file_data($file, ['classname' => 'classname']);

            $classes[lcfirst(basename($file, '.php'))] = new $data['classname']($this);
        }

        return $classes;
    }

    /**
     * Render the content
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function render()
    {
        echo "<div id='support-bubble'></div>";
    }

    /**
     * Enqueue assets.
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function assets()
    {
        wp_enqueue_script('support-bubble', $this->url . "app/dist/bundle.js", ['jquery'], $this->version, true);
    }

    /**
     * Add frontend data.
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function data()
    {
        $data = [];

        $values = $this->values;

        $data['ajaxurl'] = admin_url('admin-ajax.php');

        # Settings
        $data['settings']['bubble'] = $values['bubble'];
        $data['settings']['menu'] = [];

        # Menu items
        foreach ($values['menu']['items'] as &$item) {
            $visible = isset($item['visibility']) ? $this->classes['visibility']->verify($item['visibility']) : true;

            if (! $visible) {
                continue;
            }

            # Form setup
            if ('form' === $item['type'] && $item['form']) {
                $form = array_search($item['form'], array_column($values['forms']['forms'], '_id'));
                
                if ($form !== false) {
                    $item['form'] = $values['forms']['forms'][$form];
                    $item['form']['nonce'] = wp_create_nonce($item['form']['_id']);
                } else {
                    $item['form'] = [];
                }
            }

            $data['settings']['menu']['items'][] = $item;
        }

        # Convert icons tag value to svg
        $data['settings'] = $this->get_svg_icon_recursive($data['settings']);

        $data = json_encode($data);

        wp_add_inline_script('support-bubble', "const SupportBubble = $data", 'before');
    }

    /**
     * Get svg icon from class name
     *
     * @since 1.0.0
     * @access public
     * @return string
     */
    public function get_svg_icon($tag)
    {
        $name = str_replace('ri-', null, $tag);
        
        $path = glob($this->path . "/assets/vendor/remix-icon/icons/**/$name.svg");

        $content = file_get_contents($path[0]);

        return $content;
    }

    /**
     * Get svg icon from class name recursively
     *
     * @since 1.0.0
     * @access public
     * @return array|string
     */
    public function get_svg_icon_recursive(&$arr)
    {
        foreach ($arr as $section => &$fields) {
            if (! is_array($fields)) {
                continue;
            }

            foreach ($fields as $key => &$value) {
                if (is_string($value)) {
                    if (strpos($value, 'ri-') !== false) {
                        $value = $this->get_svg_icon($value);
                    }
                } elseif (is_array($value)) {
                    $value = $this->get_svg_icon_recursive($value);
                }
            }
        }

        return $arr;
    }

    /**
     * Register forms post type.
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function add_form_post_type($form)
    {
        extract($form);

        $args = [
            'public'                => false,
            'label'                 => $title,
            'menu_icon'             => 'dashicons-email-alt',
            'show_in_rest'          => false,
            'has_archive'           => false,
            'show_ui'               => true,
            'show_in_menu'          => filter_var($show_in_admin, FILTER_VALIDATE_BOOLEAN),
            'show_in_admin_bar'     => false,
            'supports'              => [],
            'map_meta_cap'          => true,
            'capabilities' => [
                'create_posts'          => false,
                'delete_post'           => true,
                'edit_private_posts'    => false,
                'edit_published_posts'  => false
            ]
        ];

        register_post_type($_id, $args);
    
        remove_post_type_support($_id, 'title');
        remove_post_type_support($_id, 'editor');
    }

    /**
     * Register forms post type meta.
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function add_form_post_type_meta($form)
    {
        if ( ! isset($form['fields']) || ! is_array($form['fields']) ) {
            return;
        };

        foreach ($form['fields'] as $field) {
            $meta = [
                'show_in_rest' => false,
                'single' => true,
                'type' => 'string',
            ];

            register_post_meta($form['_id'], $field['title'], $meta);
        }
    }

    /**
     * Form post type columns.
     *
     * @since 1.0.0
     * @access public
     * @return array
     */
    public function forms_post_type_columns($columns, $form)
    {
        $new = [];

        if ( isset($form['fields']) ) {
            foreach ($form['fields'] as $field) {
                $new[$field['_id']] = $field['title'];
            }
        };

        $new['date'] = $columns['date'];

        return $new;
    }

    /**
     * Form post type table column content.
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function forms_post_type_columns_content($column, $id)
    {
        echo get_post_meta($id, $column, true);
    }

    /**
     * Ajax form submit.
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function submit()
    {
        if (! check_ajax_referer($_POST['_id'], 'nonce')) {
            wp_send_json_error([
                'message' => 'Invalid nonce'
            ]);
        }

        $post = [
            'post_type' => $_POST['_id'],
            'post_status' => 'publish',
            'meta_input' => []
        ];

        foreach ($_POST['fields'] as $field) {
            $value = $field['value'];

            switch ($field['type']) {
                case 'paragraph':
                    $value = wp_filter_post_kses($value);
                    break;
    
                case 'number':
                    $value = intval($value);
                    break;

                case 'switch':
                    $value = $value == 'true' ? 'yes' : 'no';
                    break;

                case 'email':
                    $value = sanitize_email($value);
                    break;

                default:
                    $value = sanitize_text_field($value);
                    break;
            }

            $post['meta_input'][$field['_id']] = $value;
        }
    
        wp_insert_post($post);

        wp_send_json_success($post);
    }
}

// Start
new SupportBubble();