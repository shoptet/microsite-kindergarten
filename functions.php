<?php

function register_shp_kindergarten_menu() {
  register_nav_menu('kindergarten-menu', 'Vnitřní menu');
}
add_action( 'init', 'register_shp_kindergarten_menu' );


/* Shoptet WP General Settings Customizer  */
function shp_wp_customizer_claim($wp_customize) {
    $wp_customize->add_setting('shp_secondary_claim_setting', array(
        'default'        => '',
    ));

    $wp_customize->add_control('shp_secondary_claim_setting', array(
        'label'   => 'Secondary Claim',
        'section' => 'shp_wp_general_settings',
        'type'    => 'textarea',
    ));
}
add_action('customize_register', 'shp_wp_customizer_claim');


/* Shoptet navigation between pages (not native to wp, only posts) */
function getPrevNext() {
	$pagelist = get_pages('sort_column=menu_order&sort_order=asc');
	$pages = array();
	foreach ($pagelist as $page) {
	   $pages[] += $page->ID;
	}

	$current = array_search( get_the_ID(), $pages );
	$prevID = $pages[ $current - 1 ];
	$nextID = $pages[ $current + 1] ;

	echo '<nav class="post-navigation" role="navigation">';

	if ( !empty($prevID) ) {
	    echo '<div class="nav-previous"><a class="btn btn-primary" href="' . get_permalink($prevID) . '" rel="prev">« <span>' . get_the_title($prevID) . '</span></a></div>';
    }
	if ( !empty($nextID) ) {
	    echo '<div class="nav-next"><a class="btn btn-primary" href="' . get_permalink($nextID) . '" rel="next"><span>' . get_the_title($nextID) . '</span> »</a></div>';
	}
	echo '</nav>';
}

?>
