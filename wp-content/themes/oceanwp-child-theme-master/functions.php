<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );
	// Load the stylesheet
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
	
}
add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );

/*
* Creating a function to create our CPT
*/
function custom_post_type_item() {
	// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Items', 'Post Type General Name', 'oceanwp' ),
		'singular_name'       => _x( 'Item', 'Post Type Singular Name', 'oceanwp' ),
		'menu_name'           => __( 'Items', 'oceanwp' ),
		// 'parent_item_colon'   => __( 'Parent Movie', 'oceanwp' ),
		'all_items'           => __( 'All Items', 'oceanwp' ),
		'view_item'           => __( 'View Item', 'oceanwp' ),
		'add_new_item'        => __( 'Add New Item', 'oceanwp' ),
		'add_new'             => __( 'Add New', 'oceanwp' ),
		'edit_item'           => __( 'Edit Item', 'oceanwp' ),
		'update_item'         => __( 'Update Item', 'oceanwp' ),
		'search_items'        => __( 'Search Item', 'oceanwp' ),
		'not_found'           => __( 'Not Found', 'oceanwp' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'oceanwp' ),
	);
	
	// Set other options for Custom Post Type
		$args = array(
		'label'               => __( 'items', 'oceanwp' ),
		'description'         => __( 'List of household supplies', 'oceanwp' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'author', 'revisions', ), // , 'thumbnail', 'custom-fields',
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		// 'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/ 
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest' => true,

	);
	
	// Registering your Custom Post Type
	register_post_type( 'item', $args );

}

function custom_post_type_container() {
	// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Containers', 'Post Type General Name', 'oceanwp' ),
		'singular_name'       => _x( 'Container', 'Post Type Singular Name', 'oceanwp' ),
		'menu_name'           => __( 'Containers', 'oceanwp' ),
		// 'parent_item_colon'   => __( 'Parent Movie', 'oceanwp' ),
		'all_items'           => __( 'All Containers', 'oceanwp' ),
		'view_item'           => __( 'View Container', 'oceanwp' ),
		'add_new_item'        => __( 'Add New Container', 'oceanwp' ),
		'add_new'             => __( 'Add New', 'oceanwp' ),
		'edit_item'           => __( 'Edit Container', 'oceanwp' ),
		'update_item'         => __( 'Update Container', 'oceanwp' ),
		'search_items'        => __( 'Search Container', 'oceanwp' ),
		'not_found'           => __( 'Not Found', 'oceanwp' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'oceanwp' ),
	);
	
	// Set other options for Custom Post Type
		$args = array(
		'label'               => __( 'containers', 'oceanwp' ),
		'description'         => __( 'List of containers/locations storing different house supplies', 'oceanwp' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'author', 'thumbnail', 'revisions', ),	// 'custom-fields',
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		// 'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/ 
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest' => true,

	);
	
	// Registering your Custom Post Type
	register_post_type( 'container', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
add_action( 'init', 'custom_post_type_container', 0 );
add_action( 'init', 'custom_post_type_item', 1 );

add_shortcode( 'wpshout_frontend_container', 'wpshout_frontend_container' );
function wpshout_frontend_container() {
	wpshout_save_post_if_submitted();
    ?>
	<div id="postbox">
		<div class="container">
			<div class="row apple-324">
				<div class="col-md-4">
					<form id="new_post" name="new_post" method="post" enctype="multipart/form-data">

						<p>
							<label for="cptTitle"><?php _e('Enter the storage/container name:', 'oceanwp') ?></label>
							<input id="cptTitle" name="cptTitle" type="text" />
						</p><!--?php _e(‘Select image of storage’, ‘oceanwp’) ?-->
						<p>
							<label for="cptImage"><?php _e('Select image of storage/container', 'oceanwp') ?></label>
							<input id="cptImage" name="cptImage" type="file" >
						</p>
												

						<?php wp_nonce_field( 'wps-frontend-post' ); ?>

						<p align="right"><button class="btn-apple-324" type="submit"><?php _e('Add', 'oceanwp') ?></button></p>

					</form>	
				</div>
			</div>
		</div>
	</div>
    <?php
}

function wpshout_save_post_if_submitted() {
    // Stop running function if form wasn't submitted
    if ( !isset($_POST['cptTitle']) ) {
        return;
    }

    // Check that the nonce was set and valid
    if( !wp_verify_nonce($_POST['_wpnonce'], 'wps-frontend-post') ) {
        echo 'Did not save because your form seemed to be invalid. Sorry';
        return;
    }

    // Do some minor form validation to make sure there is content
    if (strlen($_POST['cptTitle']) < 3) {
        echo 'Please enter a title. Titles must be at least three characters long.';
        return;
    }

    // Add the content of the form to $post as an array
    $post = array(
        'post_title'    => $_POST['cptTitle'],
        // 'post_content'  => '',
        'post_status'   => 'publish',   // Could be: publish
        'post_type' 	=> 'container' // Could be: `page` or your CPT
    );
    $cpt_id = wp_insert_post($post);
    echo 'Saved your post successfully!  ##  ';

	$uploaddir = wp_upload_dir();
	// if (isset($_FILES["cptImage"])) {
	// 	echo 'image uploaded';
	// 	print_r( $_FILES );
	// }
	if(isset($_POST['cptTitle'])){
        echo '<pre>';
		echo '$_FILES: ';
        print_r($_FILES);
        echo '</pre>';
        }
	
	$file = $_FILES["cptImage"]["name"];
	$uploadfile = $uploaddir['path'] . '/' . basename( $file );
	
	move_uploaded_file( $file , $uploadfile );
	$filename = basename( $uploadfile );

	$wp_filetype = wp_check_filetype(basename($filename), null );

	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
		'post_content' => '',
		'post_status' => 'inherit',
		'menu_order' => $_i + 1000
	);
	$attach_id = wp_insert_attachment( $attachment, $uploadfile );
	echo '$cpt_id: '.$cpt_id.' ##  $attach_id: '.$attach_id;
	set_post_thumbnail( $cpt_id, $attach_id );

}