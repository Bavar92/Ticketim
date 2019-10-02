<?php

add_action('wp_ajax_get_products_by_artist_and_location', 'getProductsByArtistAndLocation');
add_action('wp_ajax_nopriv_get_products_by_artist_and_location', 'getProductsByArtistAndLocation');
add_action('wp_ajax_add_product_to_cart', 'addProductToCart');
add_action('wp_ajax_nopriv_add_product_to_cart', 'addProductToCart');

function myEnqueue() {

    wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/js/artist.js', array('jquery') );

    wp_localize_script( 'ajax-script', 'myAjax',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'myEnqueue' );

function getProductsByArtistAndLocation() {

    $packages = getArtistPackagesByLocation($_POST['artist'], $_POST['location']);

    echo json_encode($packages);
    
    die();
}

function addProductToCart() {

    global $woocommerce;
    
    $productId   = $_POST['product_id'];
    $quantity    = $_POST['quantity'];
    $variationId = $_POST['variation_id'];

    WC()->cart->add_to_cart($productId, $quantity, $variationId);

    var_dump($woocommerce->cart->get_cart());die();
}