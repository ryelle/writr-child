<?php
/**
 * Enqueue scripts and styles.
 */
function writr_child_scripts() {

	$colorscheme = get_theme_mod( 'writr_color_scheme' );
	$child_choices = writr_child_color_options();
	if ( $colorscheme && in_array( $colorscheme, array_keys( $child_choices ) ) ) {
		wp_deregister_style( 'writr-color-scheme' );
		wp_enqueue_style( 'writr-color-scheme', get_stylesheet_directory_uri() . '/css/' . $colorscheme . '.css' , array(), null );
	}

}
add_action( 'wp_enqueue_scripts', 'writr_child_scripts', 15 );

/**
 * Custom Color Schemes for Writr, from colourlovers.com
 *
 * @return  array  Array of color schemes in the format of filename => label.
 */
function writr_child_color_options(){
	return array(
		'orange'        => 'Vintage Strawberry',
		'rose'          => 'January Rose',
		'rose-2'        => 'Oriental Rose',
		'teal'          => 'Eskimo Kisses',
		'grass'         => 'Pisco Sour',
	);
}

/**
 * Add options to the Theme Customizer.
 *
 * We overwrite the control for color schemes by running this action later than the
 * parent theme, allowing us to add more choices.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function writr_child_customize_register( $wp_customize ) {

	// Default choices from Writr
	$choices = array(
		'default'       => __( 'Turquoise', 'writr' ),
		'blue'          => __( 'Blue', 'writr' ),
		'green'         => __( 'Green', 'writr' ),
		'grey'          => __( 'Grey', 'writr' ),
		'purple'        => __( 'Purple', 'writr' ),
		'red'           => __( 'Red', 'writr' ),
	);

	$choices = array_merge( $choices, writr_child_color_options() );

	$wp_customize->add_control( 'writr_color_scheme', array(
		'label'    => 'Color Scheme',
		'section'  => 'writr_theme_options',
		'type'     => 'select',
		'choices'  => $choices,
		'priority' => 3,
	) );

}
add_action( 'customize_register', 'writr_child_customize_register', 15 );
