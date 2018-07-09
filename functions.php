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

?>
