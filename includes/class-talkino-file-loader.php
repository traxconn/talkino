<?php
/**
 * The function to handle the template files.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 *
 * @package    Talkino
 * @subpackage Talkino/includes
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The function to handle the template files.
 *
 * @package    Talkino
 * @subpackage Talkino/includes
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_File_Loader {

    /**
	 * Load the external meta box template file for the admin area.
	 *
	 * @since    1.0.0
     * @param    string    $template_file    The file name of template.
     * @param    array     $data             The data of meta box.
	 */
    public function load_meta_box_template_file( $template_file , $data ) {

	    include plugin_dir_path( __FILE__ ) . 'admin/meta-boxes/views/' . $template_file;
		
    }

	/**
	 * Load the external chatbox template file for the frontend.
	 *
	 * @since    1.0.0
     * @param    string    $template_file    The file name of template.
     * @param    array     $data             The data of chatbox.
	 */
    public function load_chatbox_template_file( $template_file , $data ) {

	    //include TALKINO_PLUGIN_DIR_PATH . 'templates/' . $template_file;

		$this->load_template( $template_file , $data );
		
    }

	/**
	 * Load the external email template file for the frontend.
	 *
	 * @since     1.0.0
     * @param     string    $template_file    The file name of template.
     * @param     array     $data             The data of email.
	 * @return    string    $email_body       The body of email. 
	 */
    public function get_email_template_file( $template_file , $data ) {

		ob_start();

		$this->load_template( $template_file , $data );
		$email_body = ob_get_contents();

		ob_end_clean();

		return $email_body;
		
    }

	/**
	 * Load the template file.
	 *
	 * @since    1.0.0
     * @param    string    $file_name       The file name of template.
     * @param    array     $data            The data.
	 * @param    string    $tempate_path    The file name of template.
     * @param    string    $plugin_path     The path of plugin.
	 */
	function load_template( $file_name, $data, $tempate_path = '', $plugin_path = '' ) {

		$file = $this->get_locate_template( $file_name, $tempate_path, $plugin_path );

		if ( ! file_exists( $file ) ) :

			_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $file ), '1.0.0' );
			return;

		endif;

		include $file;

	}

	/**
	 * Declare the file path.
	 *
	 * @since    1.0.0
     * @param    string    $file_name             The file name of template.
	 * @param    string    $tempate_path          The file name of template.
     * @param    string    $plugin_path           The path of plugin.
	 * @return   string    get_locate_template    The hook of get_locate_template.     
	 */
	function get_locate_template( $file_name, $template_path = '', $plugin_path = '' ) {
		// Set path of templates folder of theme.
		if ( ! $template_path ) :

			$template_path = 'templates/talkino/';
			
		endif;

		// Set default plugin templates path.
		if ( ! $plugin_path ) :

			$plugin_path = TALKINO_PLUGIN_DIR_PATH . 'templates/'; // Path to the template folder

		endif;

		// Search template file in theme folder.
		$file = locate_template( array( $template_path . $file_name, $file_name ) );

		// Get plugins template file.
		if ( ! $file ) :

			$file = $plugin_path . $file_name;

		endif;

		return apply_filters( 'get_locate_template', $file, $file_name, $template_path, $plugin_path );
	}

}