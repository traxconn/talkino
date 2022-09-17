<?php
/**
 * The class to handle log of the plugin.
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
 * The class to handle log of the plugin.
 *
 * @package    Talkino
 * @subpackage Talkino/includes
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Logger {

	/**
     * Print out the log.
     * 
     * @since     1.0.0
     * @param     mixed       $entry    The value of log.
	 * @param     string      $mode     The mode of file writing.
	 * @param     resource    $file     The file name of the log file.
     * @return    int         $bytes    The content of log file in bytes.
     */
    function print_log( $entry, $mode = 'a', $file = 'talkino' ) { 

        // Get WordPress uploads directory
        $upload_dir = wp_upload_dir();
        $upload_dir = $upload_dir['basedir'];
        
        // If the entry is array, json_encode.
        if ( is_array( $entry ) ) { 
            $entry = json_encode( $entry ); 
        } 

        // Write the log file
        $file  = $upload_dir . '/' . $file . '.log';
        $file  = fopen( $file, $mode );
        $bytes = fwrite( $file, current_time( 'mysql' ) . "::" . $entry . "\n" ); 
        fclose( $file ); 

        return $bytes;
    }

}