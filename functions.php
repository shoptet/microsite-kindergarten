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

/*
Shortcode for bootstrap alerts
[shp_bootstrap_alert type="info" hasIcon="true" heading="Ea possunt paria non esse" content="Atqui iste locus est, Piso, tibi etiam atque etiam confirmandus, inquam" dismissible="true" ]
*/
function shp_bootstrap_alert( $atts ) {
    $content = '';

    if($atts['content']) {
        $types = array(
            'warning' => 'fas fa-exclamation-circle',
            'danger' => 'fas fa-times-circle',
            'success' => 'fas fa-check-circle',
            'info' => 'fas fa-question-circle'
        );
        $dismissible = ($atts['dismissible']) ? 'alert-dismissible fade show' : '';
        $content .= '<div class="alert alert-' . $atts['type'] . ' ' . $dismissible . '" role="alert">';

        if($atts['dismissible'] && $atts['dismissible'] == 'true') {
            $content .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        }

        if($atts['icon'] && $atts['icon'] == 'true') {
            $content .= '<div class="row"><div class="col-sm-2 col-lg-1 text-center"><i class="alert-icon ' . $types[$atts['type']] . '"></i></div><div class="col-sm-10 col-lg-11">';
        }

        if($atts['heading']) {
            $content .= '<h4 class="alert-heading">' . $atts['heading'] . '</h4>';
        }

        if($atts['icon'] && $atts['icon'] == 'true') {
            $content .= $atts['content'] . '</div></div><!-- !.row -->';
        } else {
            $content .= $atts['content'];
        }

        $content .= '</div>';
    }
    return $content;
}
add_shortcode( 'shp_bootstrap_alert', 'shp_bootstrap_alert' );

?>
