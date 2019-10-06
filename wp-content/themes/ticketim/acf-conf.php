<?php

// add options page
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Inventory',
		'menu_title'	=> 'Inventory',
		'menu_slug' 	=> 'ticketim-inventory',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_page(array(
		'page_title' 	=> 'Options',
		'menu_title'	=> 'Options',
		'menu_slug' 	=> 'ticketim-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

// add teams list to team selection
function acf_load_teams_field_choices($field)
{
    $choices = get_field('teams', 'option');

    if (is_array($choices)) {
        foreach ($choices as $choice) {
            $field['choices'][$choice['code']] = $choice['name'];
        }
    }

    return $field;
}

add_filter('acf/load_field/name=team', 'acf_load_teams_field_choices');


// add teams list to team selection
function acf_load_artists_field_choices($field)
{
    $choices = get_field('artists_list', 'option');

    if (is_array($choices)) {
        foreach ($choices as $choice) {
            $field['choices'][$choice['code']] = $choice['name'];
        }
    }

    return $field;
}

add_filter('acf/load_field/name=artist', 'acf_load_artists_field_choices');

// add teams list to team selection
function acf_load_country_field_choices($field)
{
    $choices = get_field('general_countries', 'option');

    if (is_array($choices)) {
        foreach ($choices as $choice) {
            $field['choices'][$choice['name']] = $choice['name'];
        }
    }

    return $field;
}

add_filter('acf/load_field/name=country', 'acf_load_country_field_choices');

// add teams list to team selection
function acf_load_city_field_choices($field)
{
    $choices = get_field('general_cities', 'option');

    if (is_array($choices)) {
        foreach ($choices as $choice) {
            $field['choices'][$choice['name']] = $choice['name'];
        }
    }

    return $field;
}

add_filter('acf/load_field/name=city', 'acf_load_city_field_choices');


function getAllCountries() {
    return get_field('general_countries', 'options');
}

function getAllCities() {
    return get_field('general_cities', 'options');
}

function getMiddleBanners() {
    return get_field('home_middle_banners');
}

function getMiddleBannersCategory() {
    $term = get_queried_object();
    return get_field('middle_banners', $term);
}

function getHomePageBottomBanner() {
    return get_field('home_footer_banner');
}

function getHomePageBottomBannerLink() {
    return get_field('home_footer_banner_link');
}

function getConcertsBanners() {
    return get_field('concerts_middle_banners');
}

function getArtists() {
    return get_field('artists_list', 'options');
}

function getArtistByCode($code) {

    $artists = getArtists();
    foreach($artists as $artist) {
        return $artist;
    }

    return null;
}

function getArtistByName($name) {

    $artists = getArtists();

    foreach($artists as $artist) {
            if($artist['name'] == $name) {
                return $artist;
            }
    }

    return null;
}

function getConcertsBottomBanner() {
    $image = get_field('concerts_bottom_banner');
    return $image ? $image['url'] : '';
}

function getConcertsBottomBannerLink() {
    return get_field('concerts_bottom_banner_link');
}

function getArtistSingleShow($artist, $first) {
    
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'product_cat'    => 'concerts',
        'meta_query'	=> array(
            array(
                'key'	 	=> 'artist',
                'value'	  	=> $artist,
                'compare' 	=> '=',
            )
        ),
        'meta_key'			=> 'from_date',
        'orderby'			=> 'meta_value',
        'order'				=> $first ? 'ASC' : 'DESC'
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

function getArtistShowsLocations($artist) {
    
    $artist = getArtistByName($artist);
    $artist = $artist['code'];

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'product_cat'    => 'concerts',
        'meta_query'	=> array(
            array(
                'key'	 	=> 'artist',
                'value'	  	=> $artist,
                'compare' 	=> '=',
            )
        )
    );
    
    $packages = get_posts($args);
    wp_reset_query();

    $returnArray = [];
    foreach($packages as $package) {
        $meta = get_post_meta($package->ID);

        $returnArray[] = [
            'id'        => $package->ID,
            'location'  => $meta['city'],
            'date'      => $meta['from_date'],
            'artist'    => $meta['artist'],
        ];
    }
    return $returnArray;
}

function getHotArtistShowsLocations($artist) {
    
    $artist = getArtistByName($artist);
    $artist = $artist['code'];

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'product_cat'    => 'concerts',
        'meta_query'	=> array(
            array(
                'key'	 	=> 'artist',
                'value'	  	=> $artist,
                'compare' 	=> '=',
            ),
            array(
                'key'	 	=> 'hot',
                'value'	  	=> true,
                'compare' 	=> '=',
            )
        )
    );
    
    $packages = get_posts($args);
    wp_reset_query();

    $returnArray = [];
    foreach($packages as $package) {
        $meta = get_post_meta($package->ID);

        $returnArray[] = [
            'id'        => $package->ID,
            'location'  => $meta['city'],
            'date'      => $meta['from_date'],
            'artist'    => $meta['artist'],
        ];
    }
    return $returnArray;
}

function getArtistPackagesByLocation($artist, $location) {

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'product_cat'    => 'concerts',
        'meta_query'	=> array(
            'relation'		=> 'AND',
            array(
                'key'	 	=> 'artist',
                'value'	  	=> $artist,
                'compare' 	=> '=',
            ),
            array(
                'key'	 	=> 'city',
                'value'	  	=> $location,
                'compare' 	=> '=',
            )
        )
    );
    
    $packages = get_posts($args);
    wp_reset_query();

    $returnArray = [];
    foreach($packages as $package) {
        $meta = get_post_meta($package->ID);

        $returnArray[] = [
            'id'    => $package->ID,
            'name'  => $package->post_title,
            'date'  => $meta['from_date'][0],
            'price' => $meta['_price'][0],
        ];
    }
    return $returnArray;
}