<?php
/**
 * Admin Page
 *
 * @class BMF_Hub_Admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * BMF_Hub_Admin class.
 */
class BMF_Hub_Admin {
	/**
	 * Userslist Post Type.
	 */
	public static $post_type = 'bmf_hub_users_list';

	/**
	 * Init.
	 */
	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ), 9 );
		add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );
	}
	
	/**
	 * Admin menu.
	 */
	public static function admin_menu(){
		add_menu_page(__('BlindMatrix Freemium Hub','blindmatrix-freemium-hub'), __('BlindMatrix Freemium Hub','blindmatrix-freemium-hub'), 'manage_options', 'bmf_hub_dashboard',array( __CLASS__, 'dashboard_page'), 'dashicons-screenoptions',2);
		add_submenu_page('bmf_hub_dashboard',__('Dashboard','blindmatrix'), __('Dashboard','blindmatrix-freemium-hub'), 'manage_options', 'bmf_hub_dashboard', array( __CLASS__, 'dashboard_page' ) );	
		add_submenu_page('bmf_hub_dashboard',__('Users List','blindmatrix'), __('Users List','blindmatrix-freemium-hub'), 'manage_options', 'bmf_hub_users_list_table',   array( __CLASS__, 'render_users_list_table' ) ,'dashicons-clipboard' );	
	} 	
	
	/**
	 * Render dashboard page.
	 */
	public static function dashboard_page(){
	   
	}
	
	/**
	 * Render users list table page.
	 */
	public static function render_users_list_table(){
	    include(BMF_HUB_ABSPATH.'/includes/admin/wp-list-table/class-bmf-hub-users-list-table.php');
	    $table_object = new BMF_Hub_Users_List_Table();
	    $table_object->display();
	}

	/**
	 * Register Post Types.
	 */
	public static function register_post_types(){
		register_post_type(
			self::$post_type,
			apply_filters(
				'bmf_hub_users_list_post_type_args',
				array(
					'label'           => __( 'Users List', 'blindmatrix-freemium-hub' ),
					'public'          => false,
					'hierarchical'    => false,
					'supports'        => false,
					'capability_type' => 'post',
					'rewrite'         => false,
				)
			)
		);
	}
}

BMF_Hub_Admin::init();