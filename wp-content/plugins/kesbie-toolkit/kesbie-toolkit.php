<?php

/**
 * @link              https://kesbie.com
 * @since             1.0.0
 * @package           Kesbie_Base
 *
 * @wordpress-plugin
 * Plugin Name:       Kesbie Toolkit
 * Plugin URI:        https://kesbie.com
 * Description:       Makes it easy to edit website content
 * Version:           1.0.0
 * Author:            Kesbie
 * Author URI:        https://kesbie.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kesbie-toolkit
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'KESBIE_TOOLKIT_VERSION', '1.0.0' );
define( 'KESBIE_TOOLKIT_PLUGIN_SLUG', 'kesbie-toolkit' );
define( 'KESBIE_TOOLKIT_PLUGIN_NAME', esc_html_x('Kesbie Toolkit', 'plugin name', 'kesbie-toolkit'));
define( 'KESBIE_TOOLKIT_DIR', plugin_dir_path(__FILE__));
define( 'KESBIE_TOOLKIT_PATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'KESBIE_TOOLKIT_AUTHOR', 'Kesbie' );
define( 'KESBIE_TOOLKIT_AUTHOR_URI', 'https://kesbie.com');
define( 'KESBIE_TOOLKIT_PLUGIN_URI', plugins_url('kesbie-toolkit'));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_kesbie_toolkit() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kesbie-toolkit-activator.php';
	Kesbie_Toolkit_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_kesbie_toolkit() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kesbie-toolkit-deactivator.php';
	Kesbie_Toolkit_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_kesbie_toolkit' );
register_deactivation_hook( __FILE__, 'deactivate_kesbie_toolkit' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-kesbie-toolkit.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function run_kesbie_toolkit() {
	$plugin = new Kesbie_Toolkit();
}

run_kesbie_toolkit();