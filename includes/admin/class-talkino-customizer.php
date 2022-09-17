<?php
/**
 * The admin area to customize admin part of plugin.
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
 * The admin area to customize admin part of plugin.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Customizer {
    
    /**
     * Hide 'save draft', 'preview button', 'visibility field', 'quick edit' and 'view' for agent post type
     * 
     * @since    1.0.0
     */
    public function hide_buttons_on_post_type() {

        global $current_screen;

        if ( 'talkino_agents' == $current_screen->post_type ) {
            echo '<style>
                #save-action, #visibility, #post-preview {
                    display:none;
                }
                </style>';
        }

    }

    /**
     * Remove 'quick edit' and 'view' for agent post type at the list.
     * 
     * @since    1.0.0
     * @param    string[]    $actions    An array of row action links.
     * @param    WP_Post     $$post      Post object.
     */
    public function remove_actions_on_post_type ( $actions, $post ) { 

        if ( $post->post_type == 'talkino_agents' ) {
        
            unset( $actions['inline hide-if-no-js'] );
            unset( $actions['view'] );

        }

        return $actions;

    }

    /**
     * Change the title's placeholder of custom post type.
     * 
     * @since     1.0.0
     * @param     string    $title    The title of placeholder.
     * @return    string    $title    The new title of placeholder.
     */
    public function change_title_text( $title ) {

        $screen = get_current_screen();

        if( $screen->post_type == 'talkino_agents' ) {
            
            $title = esc_html__( 'Enter agent\'s name', 'talkino' );

        }
      
        return $title;
    }

	/**
     * Change the notification message of custom post type.
     * @since     1.0.0
	 * @param     string    $messages    The notification message of custom post type.
	 * @return    string    $messages    The updated notification message.
     */
    public function edit_post_updated_messages( $messages ) {

        $post             = get_post();
        $post_type        = get_post_type( $post );
        $post_type_object = get_post_type_object( $post_type );
        
        $messages['talkino_agents'] = array(
            0  => '', // Unused. Messages start at index 1.
            1  => esc_html__( 'Agent updated.' ),
            2  => esc_html__( 'Agent field updated.' ),
            3  => esc_html__( 'Agent field deleted.'),
            4  => esc_html__( 'Agent updated.' ),
            5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Agent restored to revision from %s' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => esc_html__( 'Agent published.' ),
            7  => esc_html__( 'Agent saved.' ),
            8  => esc_html__( 'Agent submitted.' ),
            9  => sprintf(
                esc_html__( 'Agent scheduled for: <strong>%1$s</strong>.' ),
                date_i18n( esc_html__( 'M j, Y @ G:i' ), strtotime( $post->post_date ) )
            ),
            10 => esc_html__( 'Agent draft updated.' )
        );

        return $messages;

    }

    /**
     * Change the notification message on bulk of custom post type.
     * @since     1.0.0
	 * @param     array[]    $bulk_messages    Arrays of messages.
	 * @param     int[]      $bulk_counts      Array of item counts for each message.
     * @return    array[]    $bulk_messages    Arrays of messages.
     */
    function edit_bulk_post_updated_messages ( $bulk_messages, $bulk_counts ) {

        $bulk_messages['talkino_agents'] = array(
            'updated'   => _n( '%s agent updated.', '%s agents updated.', $bulk_counts['updated'] ),
            'locked'    => _n( '%s agent not updated, somebody is editing it.', '%s agents not updated, somebody is editing them.', $bulk_counts['locked'] ),
            'deleted'   => _n( '%s agent permanently deleted.', '%s agents permanently deleted.', $bulk_counts['deleted'] ),
            'trashed'   => _n( '%s agent moved to the Trash.', '%s agents moved to the Trash.', $bulk_counts['trashed'] ),
            'untrashed' => _n( '%s agent restored from the Trash.', '%s agents restored from the Trash.', $bulk_counts['untrashed'] ),
        );
        
        return $bulk_messages;

    }  

}