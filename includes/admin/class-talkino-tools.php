<?php
/**
 * The tools to handle various functions.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The tools to handle various functions.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Tools {

    /**
     * The function to generate time selector.
     * 
     * @since    1.0.0
     * @param    string    $schedule_time    The time that is selected and saved.
     */
    public function select_time( $schedule_time ) {

        $start_time_value = "00:00";
        $end_time_value = "23:30";

        $start_time_format_value = strtotime( $start_time_value );
        $end_time_format_value = strtotime( $end_time_value );
        $now_time = $start_time_format_value;
        
        while( $now_time <= $end_time_format_value ) {
            ?>
            
            <option value="<?php echo esc_attr( date( "H:i", $now_time ) )?>" <?php selected( date( "H:i", $now_time ), $schedule_time ); ?> > <?php echo esc_attr( date( "H:i", $now_time ) )?></option>
            
            <?php
            $now_time = strtotime( '+30 minutes', $now_time );
        }
        
    }

}