<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

/* Call Parent Theme Stylesheet */

function theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
* Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
* if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
*	require_once dirname( __FILE__ ) . '/cmb2/init.php';
* } elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
*	require_once dirname( __FILE__ ) . '/CMB2/init.php';
* }
**/




/*************************************************************************************************/
/** CMB2 Example / Project Group Meta Boxes **/
/*************************************************************************************************/

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function ppm_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}


/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function ppm_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function ppm_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}



add_action( 'cmb2_admin_init', 'ppm_register_repeatable_group_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function ppm_register_repeatable_group_field_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_ppm_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Print/Project Details', 'cmb2' ),
		'object_types' => array( 'project', ),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'project_group',
		'type'        => 'group',
		'description' => __( '', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Entry {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Entry', 'cmb2' ),
			'remove_button' => __( 'Remove Entry', 'cmb2' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Image Image', 'cmb2' ),
		'id'   => $prefix . 'image',
		'type' => 'file',
	) );


	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Image Title', 'cmb2' ),
		'id'   => $prefix . 'image_title',
		'type' => 'text',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'        => __( 'Image Description', 'cmb2' ),
		'id'          => $prefix . 'image_description',
		'type'        => 'textarea_small',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'        => __( 'Exhibition Name', 'cmb2' ),
		'id'          => $prefix . 'image_exhibition',
		'type'        => 'text',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Image Sizes and Prices', 'cmb2' ),
		'id'   => $prefix . 'image_size',
		'type' => 'text',
		'description' => 'eg: 36 x 64cm (Ed50) R6,500',
		'repeatable' => 'true',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Is this image for sale?', 'cmb2' ),
		'desc' => __( 'If checkbox is selected, a "buy now" link will appear below the image', 'cmb2' ),
		'id'   => $prefix . 'image_buy',
		'type' => 'checkbox',
		// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
		// 'repeatable' => true,
	) );
}

add_action( 'cmb2_admin_init', 'ppm_register_user_profile_metabox' );
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function ppm_register_user_profile_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_ppm_user_';

	/**
	 * Metabox for the user profile screen
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => __( 'User Profile Metabox', 'cmb2' ),
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );

	$cmb_user->add_field( array(
		'name'     => __( 'Extra Info', 'cmb2' ),
		'desc'     => __( 'field description (optional)', 'cmb2' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$cmb_user->add_field( array(
		'name'    => __( 'Avatar', 'cmb2' ),
		'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'avatar',
		'type'    => 'file',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Facebook URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'facebookurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Twitter URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'twitterurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Google+ URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'googleplusurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Linkedin URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'linkedinurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'User Field', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'user_text_field',
		'type' => 'text',
	) );

}

add_action( 'cmb2_admin_init', 'ppm_register_theme_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page
 */
function ppm_register_theme_options_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$option_key = '_ppm_theme_options';

	/**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `cmb2_metabox_form` helper function. See wiki for more info.
	 */
	$cmb_options = new_cmb2_box( array(
		'id'      => $option_key . 'project',
		'title'   => __( 'Theme Options Metabox', 'cmb2' ),
		'hookup'  => false, // Do not need the normal user/post hookup
		'show_on' => array(
			// These are important, don't remove
			'key'   => 'options-page',
			'value' => array( $option_key )
		),
	) );

	/**
	 * Options fields ids only need
	 * to be unique within this option group.
	 * Prefix is not needed.
	 */
	$cmb_options->add_field( array(
		'name'    => __( 'Site Background Color', 'cmb2' ),
		'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => 'bg_color',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );

}
/*************************************************************************************************/
/** END - CMB2 Example Meta Boxes **/
/*************************************************************************************************/

// Project Hooks / Filters

add_filter( 'projects_loop_columns', 'jk_projects_columns', 99 );
function jk_projects_columns( $cols ) {
	$cols = 2;
	return $cols;
}

// Remove Single Project gallery
remove_action( 'projects_before_single_project_summary', 'projects_template_single_gallery', 40 );

// Remove Cover
remove_action( 'projects_before_single_project_summary', 'projects_template_single_feature', 30 );

// Remove Meta
remove_action( 'projects_single_project_summary', 'projects_template_single_meta', 20 );


// Add Custom Project Meta
add_action( 'projects_after_single_project_summary', 'projects_meta', 12 );

function projects_meta () {
	global $post;

    $entries = get_post_meta( $post->ID, '_ppm_project_group', true );
    
	foreach ( (array) $entries as $key => $entry ) {

	    $img = $image_title = $image_description = $image_size = $image_buy = '';

		if ( isset( $entry['_ppm_image_id'] ) ) {
		    $img = wp_get_attachment_image( $entry['_ppm_image_id'], 'full', null, array(
		        'class' => 'project-details__img',
		    ) );
		 }

	    if ( isset( $entry['_ppm_image_title'] ) )
	        $image_title = $entry['_ppm_image_title'];

	   	if ( isset( $entry['_ppm_image_description'] ) )
	        $image_description = $entry['_ppm_image_description'];

	   	if ( isset( $entry['_ppm_image_exhibition'] ) )
	        $image_exhibition = $entry['_ppm_image_exhibition'];

    	if ( isset( $entry['_ppm_image_size'] ) )
			$image_size = $entry['_ppm_image_size'];

    	if ( isset( $entry['_ppm_image_buy'] ) )
        	$image_buy = $entry['_ppm_image_buy'];

	    $image_sizes = get_post_meta( $post->ID, '_ppm_image_size', true );
		
		if ( isset( $entry['_ppm_image_title'] ) ) { ?>
			<div class="project-details">
				<?php echo $img; ?>
	            <h3 class="project-details__title">Title: <?php echo $image_title; ?></h3>
	            <?php if ( isset( $entry['_ppm_image_exhibition'] ) ) { ?>
	            	<p>Exhibition: <?php echo $image_exhibition; ?></p>
	            <?php } ?>
	            <p class="project-details__description"><?php echo $image_description; ?></p>
	            <?php if ( isset( $entry['_ppm_image_size'] ) ) { ?>
	            	<p>Size: <?php echo implode(" &mdash; ",$entry['_ppm_image_size']); ?></p>
	            <?php } ?>
	            <?php if ($image_buy == "on") { ?>
	            	<a role="button" class="project-details__buy" data-toggle="modal" data-target="#myModal">Buy Now</a>
				<?php } ?>
				<!-- Button trigger modal -->

	        </div>
	        <?php 
        }
    }
} // End woo_hook_content_loop_after()

// Gravity forms dynamic population
// Image Title

add_filter( 'gform_field_value_image_title', 'my_custom_population_function' );
function my_custom_population_function( $value ) {
	    global $post;
	    $entries = get_post_meta( $post->ID, '_ppm_project_group', true );
		
		foreach ( (array) $entries as $key => $entry ) {
		    $image_title = $image_description = $image_size = $image_buy = '';}

		    if ( isset( $entry['_ppm_image_title'] ) )
		        $image_title = $entry['_ppm_image_title'];
    
    	return $image_title;
}


// Sizes and Prices
add_filter( 'gform_pre_render_51', 'populate_prices' );
add_filter( 'gform_pre_validation_51', 'populate_prices' );
add_filter( 'gform_pre_submission_filter_51', 'populate_prices' );
add_filter( 'gform_admin_pre_render_51', 'populate_prices' );
function populate_prices( $form ) {

    foreach ( $form['fields'] as &$field ) {

        if ( $field->type != 'select' || strpos( $field->cssClass, 'populate-prices' ) === false ) {
            continue;
        }

        // you can add additional parameters here to alter the posts that are retrieved
        // more info: [http://codex.wordpress.org/Template_Tags/get_posts](http://codex.wordpress.org/Template_Tags/get_posts)
        // $prices = get_posts( 'numberposts=-1&post_status=publish' );
        $prices = get_post_meta( $post->ID, '_ppm_image_size', true );

        $choices = array();

        foreach ( $prices as $price ) {
            $choices[] = array( 'text' => $post->post_title, 'value' => $price->post_title );
        }

        // update 'Select a Post' to whatever you'd like the instructive option to be
        $field->placeholder = 'Select a size and price';
        $field->choices = $choices;

    }

    return $form;
}
?>