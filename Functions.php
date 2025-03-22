<?php 
// --Add  File Access ---> 

add_action( 'wp_enqueue_scripts', 'my_enqueue_assets' );
//include('updates/updates.php'); //GitHub Feed
//include('shortcode.php'); //Custom Shortcode
//include('white-XPstatus.php'); //Backend Personalization
//include('alerts/alerts.php'); //DBW - Update website alert bar
//include('dp/filtergrid.php'); //Divi Filtergrid Customizations
//include('acf/tweaks.php'); //ACF Fields Customizations 

// --- END Add File Acess <--- 

// --- Stylesheet Access --->

function my_enqueue_assets() {
    $parent_style = 'parent-style';
      
        wp_enqueue_style( $parent_style, get_stylesheet_directory_uri().'/style.css', array(), time()); // Cache busting 
    
        wp_enqueue_style( 'child-style',
              get_stylesheet_directory_uri() . '/style.css',
              array( $parent_style ),
              wp_get_theme()->get('Version')
          );
      }
      
    add_action( 'admin_enqueue_scripts', 'my_enqueue_assets');
    add_action('wp_enqueue_scripts', 'my_enqueue_assets');
  
  // --- Stylesheet Access <---

 // --- Admin Bar Links ---->
function df_admin_bar_render() {
    global $wp_admin_bar;
    
    $cloudflareTAB = '/wp-admin/options-general.php?page=cloudflare#/home'; //ADD CLOUDFLARE
    $wp_admin_bar->add_menu( array(
    'parent' => false,
    'id' => 'cloudflare',
    'title' => __('☁︎  Cloudflare'),
    'href' => $cloudflareTAB
    ));
    
    $cfsettingsTAB = '/wp-admin/options-general.php?page=cloudflare#/more-settings'; // Submenu Item
    $wp_admin_bar->add_menu(array(
    'parent' => 'cloudflare',
    'id' => 'cf_settings',
    'title' => __('Cloudflare Settings (Dev Mode)'),
    'href' => $cfsettingsTAB
    ));
    
    $eventinfoTAB = '/wp-admin/admin.php?page=fanx-theme'; //ADD CLOUDFLARE
    $wp_admin_bar->add_menu( array(
    'parent' => false,
    'id' => 'eventinfo',
    'title' => __('ⓘ Event Info'),
    'href' => $eventinfoTAB
    ));
    
    }
    
    add_action( 'wp_before_admin_bar_render', 'df_admin_bar_render' );
    // <---- END Admin Bar Links ---
 
 
 
//--- Admin Columns ---> 

//Custom Column Layout 
function df_custom_admin_columns($columns) {
    $columns = array(
        'cb' => $columns['cb'], //Checkbox
        'thumbnail' => __('Thumbnail'),
        'title' => __('Title'),
        'slug' => __('Slug'),
        'categories' => __('Main Cats'),
        'tags' => __('XP Status'),
        'date' => __('Date'),
        );
        return $columns;
    }
    function df_apply_columns_to_all_post_types() {
        $all_post_types = get_post_types(array('public' => true), 'names'); // Get all public post types
    
        foreach ($all_post_types as $post_type) {
            add_filter("manage_edit-{$post_type}_columns", 'df_custom_admin_columns');
        }
    }
    add_action('admin_init', 'df_apply_columns_to_all_post_types');

// Populate custom column data
function df_custom_admin_columns_content($column, $post_id){
    switch ($column) {
        case 'thumbnail':
            echo get_the_post_thumbnail($post_id, array(300, 300));
            break;
        case 'slug':
            $post = get_post($post_id);
            echo $post->post_name;
            break;
    
    }
}
// Apply to all post types dynamically
function df_apply_columns_content_to_all_post_types() {
    $all_post_types = get_post_types(array('public' => true), 'names'); // Get all public post types

    foreach ($all_post_types as $post_type) {
        add_action("manage_{$post_type}_posts_custom_column", 'df_custom_admin_columns_content', 10, 2);
    }
}
add_action('admin_init', 'df_apply_columns_content_to_all_post_types');

//Title Column 
function df_custom_column_title($column, $post_id) {
    if ($column === 'title') { 
        $post = get_post($post_id);

        // Display the title
        echo '<strong>' . get_the_title($post_id) . '</strong>';
        
        // Append the slug below the title
        echo '<br><small style="color: #888;">Slug: ' . esc_html($post->post_name) . '</small>';
    }
}

add_action('manage_posts_custom_column', 'df_custom_column_title', 10, 2);
add_action('manage_pages_custom_column', 'df_custom_column_title', 10, 2);


// --- END Admin Columns <-- 

//**Taxonomies --->

//support for Categories & Tags
function df_add_taxonomies_to_all_post_types() {
    $post_types = get_post_types(['public' => true], 'names'); 

    foreach ($post_types as $post_type) {
        register_taxonomy_for_object_type('category', $post_type);
        register_taxonomy_for_object_type('post_tag', $post_type);
    }
}
add_action('init', 'df_add_taxonomies_to_all_post_types');

//XP Status (Tag) Tweaks
function df_rename_tags_taxonomy() {
    global $wp_taxonomies;

    if (isset($wp_taxonomies['post_tag'])) {
        $wp_taxonomies['post_tag']->labels = (object) array_merge((array) $wp_taxonomies['post_tag']->labels, array(
            'name' => 'XPstatus',
            'singular_name' => 'XPstatus',
            'menu_name' => 'XPstatus',
            'search_items' => 'Search XPstatus',
            'popular_items' => 'Popular XPstatus',
            'all_items' => 'All XPstatus',
            'edit_item' => 'Edit XPstatus',
            'view_item' => 'View XPstatus',
            'update_item' => 'Update XPstatus',
            'add_new_item' => 'Add New XPstatus',
            'new_item_name' => 'New XPstatus Name',
            'separate_items_with_commas' => 'Separate XPstatus with commas',
            'add_or_remove_items' => 'Add or remove XPstatus',
            'choose_from_most_used' => 'Choose from the most used XPstatus',
            'not_found' => 'No XPstatus found.',
        ));
    }
}
add_action('init', 'df_rename_tags_taxonomy', 11);



//END Taxonomies <--- 

//Search Function --->

function tg_include_custom_post_types_in_search_results( $query ) {
    if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
        $query->set( 'post_type', array( 'guest', 'feature' ) );
    }
}
add_action( 'pre_get_posts', 'tg_include_custom_post_types_in_search_results' );

// END Search Function <---


//PROTECT THE THINGS --->
/*** Block User Enumeration*/
function df_block_user_enum_attempt() {
    if ( is_admin() ) return;
    $author_by_id = ( isset( $_REQUEST['author'] ) && is_numeric( $_REQUEST['author'] ) );
    if ( $author_by_id )
    wp_die( 'Author archives have been disabled.' );
  }
  
    add_action( 'template_redirect', 'df_block_user_enum_attempt' );
  
  //end protect the things <---
  
  //TURN OFF THE THINGS -->
  add_filter( 'wp_lazy_loading_enabled', '__return_false' );
  
  //REMOVE THE THINGS --->
  // ---Remove Gutenberg Block Library CSS from loading on the frontend -->
  function smartwp_remove_wp_block_library_css(){
      wp_dequeue_style( 'wp-block-library' );
      wp_dequeue_style( 'wp-block-library-theme' );
      wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
  }
  add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );
  
  
  
  //Hide Divi Project CPT
  function hide_diviproject_cpt_df() {
  
  register_post_type( 'project',
      array(
      'has_archive'  => false,
      'public'       => false,
    'show_in_menu' => false,
  ));
      }
  
  add_action( 'init', 'hide_diviproject_cpt_df' );
  
  
  //END REMOVE THE THINGS <----
  
  
  //Use When Needed:
  remove_action('shutdown', 'wp_ob_end_flush_all', 1);  //Flush error
  flush_rewrite_rules(); //Flush Rules
  