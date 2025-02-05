<?php
/**
 * CustomThemeAdwise Theme Customizer
 *
 * @package CustomThemeAdwise
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cst_adwise_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'cst_adwise_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'cst_adwise_customize_partial_blogdescription',
			)
		);
	}

	// Sekcja przycisków w menu - link do społeczności i aplikowania.
	$wp_customize->add_section('header_buttons', array(
		'title'    => __('Przyciski w headerze', 'cst-adwise'),
		'priority' => 30,
	));

	// Link do społeczności
	$wp_customize->add_setting('header_community_link', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('header_community_link', array(
		'label'   => __('Link do społeczności', 'cst-adwise'),
		'section' => 'header_buttons',
		'type'    => 'url',
	));

	// Tekst przycisku społeczności
	$wp_customize->add_setting('header_community_text', array(
		'default'           => 'Dołącz do społeczności',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('header_community_text', array(
		'label'   => __('Tekst linku do społeczności', 'cst-adwise'),
		'section' => 'header_buttons',
		'type'    => 'text',
	));

	// Link do aplikowania
	$wp_customize->add_setting('header_apply_link', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('header_apply_link', array(
		'label'   => __('Link do aplikowania', 'cst-adwise'),
		'section' => 'header_buttons',
		'type'    => 'url',
	));

	// Tekst przycisku aplikowania
	$wp_customize->add_setting('header_apply_text', array(
		'default'           => 'Aplikuj',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('header_apply_text', array(
		'label'   => __('Tekst przycisku aplikowania', 'cst-adwise'),
		'section' => 'header_buttons',
		'type'    => 'text',
	));
}
add_action( 'customize_register', 'cst_adwise_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function cst_adwise_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function cst_adwise_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cst_adwise_customize_preview_js() {
	wp_enqueue_script( 'cst-adwise-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'cst_adwise_customize_preview_js' );
