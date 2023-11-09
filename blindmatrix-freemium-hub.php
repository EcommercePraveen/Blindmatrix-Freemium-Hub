<?php

/**

 * Plugin Name: BlindMatrix Freemium Hub

 * Plugin URI: https://blindmatrix.com/

 * Description: BlindMatrix Freemium Hub

 * Version: 1.0

 * Author: BlindMatrix

 * Author URI: https://blindmatrix.com/

 * Text Domain: blindmatrix-freemium-hub

 * Tested up to: 6.0.3

 *

 */

defined( 'ABSPATH' ) || exit;  

if ( ! defined( 'BMF_HUB_PLUGIN_FILE' ) ) {
	define( 'BMF_HUB_PLUGIN_FILE', __FILE__ );
}



/**

 * Main Class.

 *

 * @class BMF_HUB_BlindMatrix

 */

final class BMF_HUB_BlindMatrix {

   /**

	 * Plugin version.

	 */

	public $version = '1.0';



   /**

	 * The single instance of the class.

	 */

	protected static $_instance = null;



   /**

	 * Main Instance.

	 *

	 * Ensures only one instance of object is loaded or can be loaded.

	 *

	 * @return object - Main instance.

	 */

	public static function instance() {

		if ( is_null( self::$_instance ) ) {

			self::$_instance = new self();

		}

		return self::$_instance;

	}



   /**

	 * Cloning is forbidden.

	 */

	public function __clone() {

		wc_doing_it_wrong( __FUNCTION__, __( 'Cloning is forbidden.', 'blindmatrix-freemium-hub' ), '1.0' );

	}



	/**

	 * Unserializing instances of this class is forbidden.

	 */

	public function __wakeup() {

		wc_doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of this class is forbidden.', 'blindmatrix-freemium-hub' ), '1.0' );

	}



   /**

	 * Constructor.

	 */

	public function __construct() {

		$this->define_constants();

		$this->includes();

		$this->init_hooks();

	}



   /**

	 * Define Plugin Constants.

	 */

   public function define_constants(){
	  define( 'BMF_HUB_ABSPATH' , dirname(__FILE__));
      define( 'BMF_HUB_VERSION', $this->version );
   }

   

   /**

	 * Include required core files used in admin and on the frontend.

	 */

   public function includes(){
        // Core Functions.
		include_once(BMF_HUB_ABSPATH.'/includes/bmf-hub-core-functions.php');
		// Admin Menu and Settings.
		include_once(BMF_HUB_ABSPATH.'/includes/class-bmf-hub-admin.php');
   }



   /**

	 * Hook into actions and filters.

	 */

   public function init_hooks(){

		

   }



   /**

	 * Init hook callback.

	 */

   public function init_callback(){

		

   }



}



BMF_HUB_BlindMatrix::instance();