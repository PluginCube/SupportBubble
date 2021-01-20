<?php

/**
 * @package   InstantSupport
 * @author    PluginCube <support@plugincube.com>
 * @copyright {{author_copyright}}
 * @license   GPLv3
 * @link      https://plugincube.com/
 *
 * Plugin Name:     InstantSupport
 * Plugin URI:      https://plugincube.com/products/instant-support
 * Description:     Floating support button
 * Version:         1.0.0
 * Author:          PluginCube
 * Author URI:      https://plugincube.com/
 * Text Domain:     plugin-name
 * License:         GPLv3
 * License URI:     https://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:     /languages
 * Requires PHP:    5.6
 */

namespace PluginCube;

# Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class InstantSupport 
{
    /**
     * Version, used for cache-busting.
     *
     * @since 1.0.0
     * @access private
     * @var string|null
     */
    private $version;

    /**
     * Directory URL.
     *
     * @since 1.0.0
     * @access private
     * @var string|null
     */
    private $url;

    /**
     * Directory path.
     *
     * @since 1.0.0
     * @access private
     * @var string|null
     */
    private $path;

    /**
     * Framework instance.
     *
     * @since 1.0.0
     * @access private
     * @var object|null
     */
    private $framework;

    /**
     * Class constructer.
     * 
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function __construct()
    {
        // Version
        $plugin_data  = \get_file_data(__FILE__, [
            'Version' => 'Version'
        ]);

        $this->version = $plugin_data['Version'];

        // Path & URL
        $this->path = trailingslashit(str_replace('\\', '/', dirname( __FILE__ )));
        $this->url = site_url(str_replace(str_replace('\\', '/', ABSPATH ), '', $this->path));

        // define( 'WP_FS__DEV_MODE', true );

        // Load the framework
        require_once $this->path . '/framework/framework.php';

        // Init the framework
        $this->framework = new Framework([
            'id' => '7401',
            'slug' => 'instant-support',
            'title' => 'Instant Support',
            'public_key' => 'pk_677cbbdf1055c4c6bf6a410734760',
            'icon' => '',
        ]);

        // Load options config
        include_once $this->path . '/options.php';

        // Assets
        add_action('wp_enqueue_scripts', [$this, "assets"]);

        // Render the front-end
        add_action('wp_footer', [$this, 'render']);

        // Forms post type
        add_action('init', [$this, 'forms_post_type']);

        // Ajax form submit
        add_action('wp_ajax_it_form_submit', [$this, 'ajax_form_submit']);
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
        echo "<div id='instant-support'></div>";
    }

    /**
     * Get SVG icon from css tag
     * 
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function get_svg_icon($tag)
    {
        $name = str_replace('ri-', null, $tag);
        
        $path = glob($this->path . "/assets/vendor/remix-icon/icons/**/$name.svg");

        $content = file_get_contents($path[0]);

        return $content;
    }

    /**
     * Get SVG icon for all fields
     * 
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function convert_icons(&$arr)
    {
        foreach ($arr as $section => &$fields) {
            if ( ! is_array($fields) ) continue;

            foreach ($fields as $key => &$value) {
                if ( is_string($value) ) {
                    if (strpos($value, 'ri-') !== false) {
                        $value = $this->get_svg_icon($value);
                    }
                } else if ( is_array($value) ) {
                    $value = $this->convert_icons($value);
                }
            }
        }

        return $arr;
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

        wp_enqueue_script('instant-support', $this->url . "app/dist/bundle.js", ['jquery'], $this->version, true);

        $values = $this->framework->options->get_values();

        $values['nonce'] = wp_create_nonce('it-nonce');
        $values['ajaxurl'] = admin_url('admin-ajax.php');

        wp_localize_script('instant-support', 'instant_support', $this->convert_icons($values));
    }

    /**
     * Register forms post type.
     *
     * @since 1.0.0
     * @access public 
     * @return void
     */
    public function forms_post_type()
    {
        $values = $this->framework->options->get_values();

        foreach ($values['forms']['forms'] as $form) {
            // Register post type
            register_post_type($form['_id'], [
                'public' => false,
                'label' => $form['title'],
                'menu_icon' => 'dashicons-email-alt',
                'show_in_rest' => false,
                'has_archive' => false,
                'show_ui' => true,
                'show_in_menu' => filter_var($form['show_in_admin'], FILTER_VALIDATE_BOOLEAN),
                'show_in_admin_bar' => false,
                'supports' => [],
                'map_meta_cap' => true,
                'capabilities' => array(
                    'create_posts' => false,
                    'delete_post' => true,
                    'edit_private_posts' => false,
                    'edit_published_posts' => false
                ),
            ]);
        
            remove_post_type_support($form['_id'], 'title');
            remove_post_type_support($form['_id'], 'editor');
        
            // Register post meta
            foreach ($form['fields'] as $field) {
                register_post_meta($form['_id'], $field['title'], [
                    'show_in_rest' => false,
                    'single' => true,
                    'type' => 'string',
                ]);
            }

            // Filter columns
            add_filter("manage_$form[_id]_posts_columns", function ($columns) use ($form) {
                $columns = [];

                foreach ($form['fields'] as $field) {
                    $columns[$field['_id']] = $field['title'];
                }

                return $columns;
            });

            // Display columns
            add_action("manage_$form[_id]_posts_custom_column", function ($column, $id) use ($form) {
                echo get_post_meta($id, $column, true);
            }, 10, 2);

            add_filter("bulk_actions-edit-$form[_id]", '__return_empty_array');        
        }
    }

    /**
     * Filter forms post type columns.
     *
     * @since 1.0.0
     * @access public 
     * @return void
     */
    public function ajax_form_submit() {
        if ( ! check_ajax_referer('it-nonce', 'security')) {
            wp_send_json_error([
                'message' => 'Invalid nonce'
            ]);    
        }

        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : false;

        $post = [
            'post_type' => $data['_id'],
            'post_status' => 'publish',
            'meta_input' => []
        ];

        foreach ($data['fields'] as $field) {
            $value = $field['value'];

            switch ($field['type']) {
                case 'single_line_text':
                    $value = sanitize_text_field($value);
                    break;
                
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

                case 'date':
                    $value = sanitize_text_field($value);
                    break;
                
                case 'phone_number':
                    $value = sanitize_text_field($value);
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
new InstantSupport();
