<?php
/**
 * Users List Table
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * BMF_Hub_Users_List_Table class.
 */
class BMF_Hub_Users_List_Table extends WP_List_Table {
	/**
	 * Count.
	 */
	protected static $count = 1;
	/**
	 * Initialize the table list.
	 */
	public function __construct() {
		parent::__construct(
			array(
				'singular' => 'user list',
				'plural'   => 'user lists',
				'ajax'     => false,
			)
		);
	}

	/**
	 * No items found text.
	 */
	public function no_items() {
		esc_html_e( 'No data found.', 'blindmatrix-freemium-hub' );
	}
	
	/**
	 * Handle bulk actions.
	 */
	public function handle_bulk_actions() {
		$action = $this->current_action();
		if ( ! $action ) {
			return;
		}

		$bulk_action_ids = isset($_REQUEST['ids']) && !empty($_REQUEST['ids']) ? $_REQUEST['ids']:array();
		if(!empty($bulk_action_ids) && 'delete' == $action ){
			foreach($bulk_action_ids as $bulk_action_id){
				wp_delete_post($bulk_action_id);
			}
		}
	}
	
	/**
	 * Table list views.
	 *
	 * @return array
	 */
	protected function get_views() {
		return array();
	}

	/**
	 * Get list columns.
	 *
	 * @return array
	 */
	public function get_columns() {
		return array(
			'cb'        	  => '<input type="checkbox" />',
			'sno'             => __('S.No','blindmatrix-freemium-hub'),
			'url'             => __( 'Site URL', 'blindmatrix-freemium-hub' ),
			'email'           => __( 'Email Address', 'blindmatrix-freemium-hub' ),
			'activation_date' => __( 'Activation Date', 'blindmatrix-freemium-hub' ),
			'plugin_status'   => __( 'Plugin Status', 'blindmatrix-freemium-hub' ),
		);
	}

	/**
	 * Columns to make sortable.
	 *
	 * @return array
	 */
	public function get_sortable_columns() {
		return array(
			'sno' => array( 'ID', true ),
			'url' => array( 'url_info', true ),
		);
	}

	/**
	 * Get bulk actions.
	 *
	 * @return array
	 */
	protected function get_bulk_actions() {
		return array(
			'delete' => __( 'Delete', 'blindmatrix-freemium-hub' ),
		);
	}

	/**
	 * Column cb.
	 *
	 * @param  $item userslist instance.
	 * @return string
	 */
	public function column_cb( $item ) {
		return sprintf( '<input type="checkbox" name="ids[]" value="%s" />',$item->get_id() );
	}
	/**
	 * Default Columns.
	 *
	 * @return array
	 */
	public function column_default($item, $column_name ){
		switch ( $column_name ) {
			case 'sno':
				break;
			case 'url':
				break;
			case 'email':
				break;
			case 'activation_date':
				break;
			case 'plugin_status':
				break;
		}

		return '';
	}

	/**
	 * Prepare table list items.
	 */
	public function prepare_items() {		
		$this->prepare_column_headers();
		$per_page     = $this->get_items_per_page( 'bmf_hub_per_page' );
		$current_page = $this->get_pagenum();
		if ( 1 < $current_page ) {
			$offset = $per_page * ( $current_page - 1 );
		} else {
			$offset = 0;
		}
		
		self::$count = $offset ? $offset+1:1;
		
		$count = 0;
		$searched_keyword = isset($_REQUEST['s']) ? $_REQUEST['s']:false;
		$post_ids         = array();
		$status_request = !empty( $_REQUEST['status'] ) ?$_REQUEST['status'] : false;
		$order_by       = !empty( $_REQUEST['orderby'] ) ?$_REQUEST['orderby'] : false;
		$order          = !empty( $_REQUEST['order'] ) ?$_REQUEST['order'] : false;
		$user_list_ids    = array();	
		
		if(is_array($user_list_ids) && !empty($user_list_ids)){
			foreach($user_list_ids as $user_list_id){
				// $object = new BM_Users_List_Object($user_list_id);
				// if(!is_object($object)){
				// 	continue;
				// }
								
				// $this->items[] = $object;
			}
		}
		
		//Set the pagination.
		$this->set_pagination_args(
			array(
				'total_items' => $count,
				'per_page'    => $per_page,
				'total_pages' => ceil( $count / $per_page ),
			)
		);
	}
	
	/**
	 * Set _column_headers property for table list
	 */
	protected function prepare_column_headers() {
		$this->_column_headers = array(
			$this->get_columns(),
			array(),
			$this->get_sortable_columns(),
		);
	}

	/**
	 * Prepare table list items.
	 */
	public function display(){
		$title   = esc_html__( 'Users List', 'blindmatrix-freemium-hub' );
		echo "
			<div class='wrap'>
			<div class='bmf-hub-users-list-wrapper'>
				<h1 class='wp-heading-inline'>{$title}</h1>
				<hr class='wp-header-end'>
		";
		echo '<form method="post" class="bmf-hub-users-list-form">';
		$this->handle_bulk_actions();
		$this->prepare_items();
		$this->views();
		$searched_keyword = isset($_REQUEST['s']) ? $_REQUEST['s']:false;
		if($searched_keyword){
			echo '<span class="subtitle">Search results for: <strong>'.$searched_keyword.'</strong></span>';
		}
		
		$this->search_box( esc_html__( 'Search Users List', 'blindmatrix-freemium-hub' ), 'users-list-search-input' );
		parent::display();
		echo '</form>';
		echo '</div>';
		echo '</div>';
	}
}