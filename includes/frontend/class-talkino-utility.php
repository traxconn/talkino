<?php
/**
 * The class to handle the several utility functions for front end.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 *
 * @package    Talkino
 * @subpackage Talkino/includes/frontend
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The class to handle the several utility functions for front end.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/frontend
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Utility {

    /**
     * Check whether is blog page.
     * 
     * @since    1.0.0
     * @return   boolean    true or false    The result of whether is blog page.
     */
    public function is_blog() {

        return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
    
    }

    /**
     * Check whether woocommerce is activated.
     * 
     * @since    1.0.0
     * @return   boolean    true or false    The result of whether woocommerce is activated.
     */
    public function is_woocommerce_activated() {
        if ( class_exists( 'WooCommerce' ) ) {
            
            return true;
        } 
        else {
            
            return false;

        }

    }

    /**
     * Function to replaces the keywords with contact form data in a string.
     * 
     * @since     1.0.0
     * @param     string    $phrase               The string.
     * @param     array     $contact_form_data    The Word that is used to replace.
     * @return    string    $phrase               The replaced string.
     */
    public function replace_contact_form_text( $phrase, $contact_form_data ) {
        
        $keyword = array( '%%sender_name%%', '%%sender_email%%', '%%message%%' );
        $phrase = str_replace( $keyword, $contact_form_data, $phrase );
        
        return $phrase;

    }


}
