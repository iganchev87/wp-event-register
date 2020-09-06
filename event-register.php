<?php

/**
 * @package Event_Register
 */

/*
Plugin Name: Event Register
Plugin URI: https://
Description: DevirX task solution
Version: 1.0.0
Author: iganchev87@gmail.com
Author URI: https://
License: GPLv2 or later
Text Domain: event-register
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or  ( at your option ) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU Lesser General Public
License along with this program; if not, see .
Copyright 2005-2019 Automattic, Inc.
*/

defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

class Event_Register
{
	public function __construct() {
		add_action( 'init', array( $this, 'register_events_posttype' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_events_metabox' ) );
		add_action( 'save_post', array( $this, 'save_event_details' ) );
		add_action( 'the_content', array( $this, 'add_content_to_archive_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
	}

	/**
	 * Admin Styles
	 */
	public function admin_styles() {
		global $post_type, $pagenow;
		if ( ( 'events' === $post_type ) && ( 'post-new.php' === $pagenow || 'post.php' === $pagenow ) ) {
			// Admin styles.
			wp_enqueue_style( 
				'event_register_form_admin_styles',
				plugins_url( 'css/event_register_form_admin_styles.css', __FILE__ ),
				array(),
				'1.0'
			 );
			// Jquery datepicker styles.
			wp_enqueue_style( 
				'jquery-datepicker-style',
				plugins_url( 'css/jquery-ui.min.css', __FILE__ ),
				array(),
				'1.0'
			 );
			// Admin js.
			wp_enqueue_script( 
				'init_custom',
				plugins_url( 'js/init_custom.js', __FILE__ ),
				array( 'jquery', 'jquery-ui-datepicker' ),
				'1.0',
				false
			 );
		}
	}

	/**
	 * Register our custom type - 'events'
	 */
	public static function register_events_posttype() {
		$labels = array( 
			'name'               => __( 'Events' ),
			'singular_name'      => __( 'Event' ),
			'add_new'            => __( 'Add new event' ),
			'add_new_item'       => __( 'Add new event' ),
			'not_found'          => __( 'No events found' ),
			'not_found_in_trash' => __( 'No events found' ),
			'all_items'          => __( 'All events' ),
		 );
		register_post_type( 
			'events',
			array( 
				'labels'          => $labels,
				'public'          => true,
				'has_archive'     => true,
				'supports'        => array( 'title' ),
				'capability_type' => 'post',
				'rewrite'         => array( 'slug' => 'events' ),
				'menu_position'   => 4,
			 )
		 );
	}

	/**
	 * Add custom field metabox
	 */
	public function add_events_metabox() {
		add_meta_box( 
			'events_metabox',
			'Event details',
			array( $this, 'custom_fields_metabox_content' ),
			'events'
		 );
	}

	/**
	 * Show custom fields
	 */
	public function custom_fields_metabox_content() {
		global $post;
		$event_date     = get_post_meta( $post->ID, 'event_date', true );
		$event_location = get_post_meta( $post->ID, 'event_location', true );
		$event_url      = get_post_meta( $post->ID, 'event_url', true );

		wp_nonce_field( basename( __FILE__ ), 'event_fields' );
		include_once 'views/event-form.php';
	}

	public function save_event_details( $post_id ) {
		if ( isset( $_POST['event_fields'] ) ) {
			if ( !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['event_fields'] ) ), basename( __FILE__ ) ) ) {
				return $post_id;
			}
		}

		if ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( !empty( $_POST['event_date'] ) && !empty( $_POST['event_location'] ) && !empty( $_POST['event_url'] ) ) {
			$event_date     = sanitize_text_field( wp_unslash( $_POST['event_date'] ) );
			$event_url      = sanitize_text_field( wp_unslash( $_POST['event_url'] ) );
			$event_location = sanitize_text_field( wp_unslash( $_POST['event_location'] ) );
		}

		if ( isset( $event_url ) && isset( $event_location ) && isset( $event_date ) ) {
			update_post_meta( $post_id, 'event_date', $event_date );
			update_post_meta( $post_id, 'event_location', $event_location );
			update_post_meta( $post_id, 'event_url', $event_url );
		}
	}

	/**
	 * Display content to single page 'events'.
	 */
	public function add_content_to_archive_page() {
		if ( is_singular( 'events' ) ) {
			include_once 'views/page.php';
		}
	}
}

if ( class_exists( 'Event_Register' ) ) {
	$Event_Register  = new Event_Register();
	// $Event_Register->register ();
}

// Trying new approach for activation and deactivation

// activation
require_once plugin_dir_path( __FILE__ ) . 'inc/event-register-activate.php';
Event_Register_Activate::activate();

// deactivation
require_once plugin_dir_path( __FILE__ ) . 'inc/event-register-deactivate.php';
Event_Register_Deactivate::deactivate();

new Event_Register();
function sel_rewrite_permalinks()
{
	Event_Register::register_events_posttype();
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'sel_rewrite_permalinks' );
