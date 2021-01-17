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

        wp_localize_script('instant-support', 'instant_support', $this->convert_icons($values));
    }
}

// Start
new InstantSupport();
