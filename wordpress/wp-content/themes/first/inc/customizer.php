<?php
/**
 * First Theme Customizer
 *
 * @package First
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function first_customize_register( $wp_customize ) {

	/* Adds textarea control
	   http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/ */
	class First_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}

	// Site Title & Tagline
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->add_setting( 'first_hide_blogdescription', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'first_hide_blogdescription', array(
		'label'    => __( 'Hide Tagline', 'first' ),
		'section'  => 'title_tagline',
		'type'     => 'checkbox',
	) );

	// Fonts
	$wp_customize->add_section( 'first_fonts', array(
		'title'    => __( 'Fonts', 'first' ),
		'priority' => 30,
	) );
	$wp_customize->add_setting( 'first_headings_font', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'first_headings_font', array(
		'label'   => __( 'Headings Font', 'first' ),
		'section' => 'first_fonts',
		'type'    => 'select',
		'choices' => array(
			''                         => __( 'Default', 'first' ),
			'Open Sans:600,700'        => 'Open Sans',
			'Source Sans Pro:600,700'  => 'Source Sans Pro',
			'PT Sans:400,700'          => 'PT Sans',
			'Roboto:500,700'           => 'Roboto',
			'Lato:400,700'             => 'Lato',
			'Raleway:600,700'          => 'Raleway',
			'Montserrat:400,700'       => 'Montserrat',
			'Roboto Condensed:400,700' => 'Roboto Condensed',
			'Oswald:400,700'           => 'Oswald',
			'Lora:400,700'             => 'Lora',
			'Source Serif Pro:600,700' => 'Source Serif Pro',
			'PT Serif:400,700'         => 'PT Serif',
			'Alegreya:400,700'         => 'Alegreya',
			'Playfair Display:400,700' => 'Playfair Display',
			'Roboto Slab:400,700'      => 'Roboto Slab',
			'Ubuntu:500,700'           => 'Ubuntu',
		),
		'priority' => 11,
	) );
	$wp_customize->add_setting( 'first_headings_font_size', array(
		'default'           => ( 'ja' == get_bloginfo( 'language' ) ) ? '90' : '100',
		'sanitize_callback' => 'first_sanitize_headings_font_size',
	) );
	$wp_customize->add_control( 'first_headings_font_size', array(
		'label'    => __( 'Headings Font Size (%)', 'first' ),
		'section'  => 'first_fonts',
		'type'     => 'text',
		'priority' => 12,
	));
	$wp_customize->add_setting( 'first_body_font', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'first_body_font', array(
		'label'    => __( 'Body Font', 'first' ),
		'section'  => 'first_fonts',
		'type'     => 'select',
		'choices'  => array(
			''                                            => __( 'Default', 'first' ),
			'Open Sans:400,400italic,600,600italic'       => 'Open Sans',
			'Source Sans Pro:400,400italic,600,600italic' => 'Source Sans Pro',
			'PT Sans:400,400italic,700,700italic'         => 'PT Sans',
			'Roboto:400,400italic,700,700italic'          => 'Roboto',
			'Lora:400,400italic,700,700italic'            => 'Lora',
			'Source Serif Pro:400,600'                    => 'Source Serif Pro',
			'PT Serif:400,400italic,700,700italic'        => 'PT Serif',
			'Alegreya:400,400italic,700,700italic'        => 'Alegreya',
			'Roboto Slab:400,700'                         => 'Roboto Slab',
			'Ubuntu:400,400italic,700,700italic'          => 'Ubuntu',
		),
		'priority' => 13,
	) );
	$wp_customize->add_setting( 'first_body_font_size', array(
		'default'           => '16',
		'sanitize_callback' => 'first_sanitize_body_font_size',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'first_body_font_size', array(
		'label'    => __( 'Body Font Size (px)', 'first' ),
		'section'  => 'first_fonts',
		'type'     => 'text',
		'priority' => 14,
	) );

	// Colors
	$wp_customize->get_section( 'colors' )->priority  = 35;
	$wp_customize->add_setting( 'first_menu_background_color' , array(
		'default'   => '#333333',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'first_menu_background_color', array(
		'label'    => __( 'Menu Background Color', 'first' ),
		'section'  => 'colors',
		'priority' => 11,
	) ) );
	$wp_customize->add_setting( 'first_footer_background_color' , array(
		'default'   => '#333333',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'first_footer_background_color', array(
		'label'    => __( 'Footer Background Color', 'first' ),
		'section'  => 'colors',
		'priority' => 12,
	) ) );
	$wp_customize->add_setting( 'first_link_color' , array(
		'default'   => '#3872b8',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'first_link_color', array(
		'label'    => __( 'Link Color', 'first' ),
		'section'  => 'colors',
		'priority' => 13,
	) ) );
	$wp_customize->add_setting( 'first_link_hover_color' , array(
		'default' => '#5687c3',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'first_link_hover_color', array(
		'label'    => __( 'Link Hover Color', 'first' ),
		'section'  => 'colors',
		'priority' => 14,
	) ) );
	$wp_customize->add_setting( 'first_color_scheme', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'first_color_scheme', array(
		'label'   => __( 'Color Scheme', 'first' ),
		'section' => 'colors',
		'type'    => 'select',
		'choices' => array(
			''                                => __( 'Default', 'first' ),
			'#29405d,#29405d,#306ab3,#2e7ad9' => 'Blue',
			'#3a513a,#3a513a,#418e41,#2aa62a' => 'Green',
			'#50433b,#50433b,#9e5730,#bf5a23' => 'Brown',
			'#543b51,#543b51,#8c3381,#a32594' => 'Purple',
		),
		'priority' => 15,
	) );

	// Background
	$wp_customize->get_section( 'background_image' )->title    = __( 'Background', 'first' );
	$wp_customize->get_section( 'background_image' )->priority = 40;
	$wp_customize->get_control( 'background_color' )->section  = 'background_image';

	// Layout
	$wp_customize->add_section( 'first_layout', array(
		'title'    => __( 'Layout', 'first' ),
		'priority' => 45,
	) );
	$wp_customize->add_setting( 'first_layout', array(
		'default'   => 'boxed',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( 'first_layout', array(
		'label'    => __( 'Layout', 'first' ),
		'section'  => 'first_layout',
		'type'     => 'select',
		'choices'  => array(
			'boxed' => __( 'Boxed', 'first' ),
			'wide'  => __( 'Wide',   'first' ),
		),
		'priority' => 11,
	) );
	$wp_customize->add_setting( 'first_header_layout', array(
		'default'   => 'side',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( 'first_header_layout', array(
		'label'    => __( 'Header Layout', 'first' ),
		'section'  => 'first_layout',
		'type'     => 'select',
		'choices'  => array(
			'side'   => __( 'Side', 'first' ),
			'center' => __( 'Center',   'first' ),
		),
		'priority' => 12,
	) );
	$wp_customize->add_setting( 'first_footer_layout', array(
		'default'   => 'side',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( 'first_footer_layout', array(
		'label'    => __( 'Footer Layout', 'first' ),
		'section'  => 'first_layout',
		'type'     => 'select',
		'choices'  => array(
			'side'   => __( 'Side', 'first' ),
			'center' => __( 'Center',   'first' ),
		),
		'priority' => 13,
	) );

	// Title
	$wp_customize->add_section( 'first_title', array(
		'title'    => __( 'Title', 'first' ),
		'priority' => 50,
	) );
	$wp_customize->add_setting( 'first_title_font', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'first_title_font', array(
		'label'    => __( 'Font', 'first' ),
		'section'  => 'first_title',
		'type'     => 'select',
		'choices'  => array(
			''                 => __( 'Default', 'first' ),
			'Open Sans'        => 'Open Sans',
			'Source Sans Pro'  => 'Source Sans Pro',
			'PT Sans'          => 'PT Sans (Normal/Bold)',
			'Roboto'           => 'Roboto',
			'Lato'             => 'Lato',
			'Raleway'          => 'Raleway',
			'Montserrat'       => 'Montserrat (Normal/Bold)',
			'Roboto Condensed' => 'Roboto Condensed',
			'Oswald'           => 'Oswald',
			'Lora'             => 'Lora (Normal/Bold)',
			'Source Serif Pro' => 'Source Serif Pro (Normal/Bold)',
			'PT Serif'         => 'PT Serif (Normal/Bold)',
			'Alegreya'         => 'Alegreya (Normal/Bold)',
			'Playfair Display' => 'Playfair Display (Normal/Bold)',
			'Roboto Slab'      => 'Roboto Slab',
			'Ubuntu'           => 'Ubuntu',
			'Inconsolata'      => 'Inconsolata (Normal/Bold)',
			'Lobster'          => 'Lobster (Normal/Bold)',
			'Pacifico'         => 'Pacifico (Normal/Bold)',
			'Dancing Script'   => 'Dancing Script (Normal/Bold)',
			'Courgette'        => 'Courgette (Normal/Bold)',
			'Playball'         => 'Playball (Normal/Bold)',
		),
		'priority' => 11,
	) );
	$wp_customize->add_setting( 'first_title_font_weight', array(
		'default' => '700',
	) );
	$wp_customize->add_control( 'first_title_font_weight', array(
		'label'    => __( 'Font Weight', 'first' ),
		'section'  => 'first_title',
		'type'     => 'select',
		'choices'  => array(
			'700' => __( 'Bold', 'first' ),
			'400' => __( 'Normal', 'first' ),
			'300' => __( 'Light', 'first' ),
		),
		'priority' => 12,
	) );
	$wp_customize->add_setting( 'first_title_font_size', array(
		'default'           => ( 'ja' == get_bloginfo( 'language' ) ) ? '32' : '36',
		'sanitize_callback' => 'first_sanitize_title_font_size',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'first_title_font_size', array(
		'label'    => __( 'Font Size (px)', 'first' ),
		'section'  => 'first_title',
		'type'     => 'text',
		'priority' => 13,
	));
	$wp_customize->add_setting( 'first_title_font_color' , array(
		'default'   => '#111',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'first_title_font_color', array(
		'label'    => __( 'Font Color', 'first' ),
		'section'  => 'first_title',
		'priority' => 14,
	) ) );
	$wp_customize->add_setting( 'first_title_letter_spacing', array(
		'default'           => '0',
		'sanitize_callback' => 'first_sanitize_margin',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'first_title_letter_spacing', array(
		'label'    => __( 'Letter Spacing (px)', 'first' ),
		'section'  => 'first_title',
		'type'     => 'text',
		'priority' => 15,
	));
	$wp_customize->add_setting( 'first_title_margin_top', array(
		'default'           => '0',
		'sanitize_callback' => 'first_sanitize_margin',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'first_title_margin_top', array(
		'label'    => __( 'Margin Top (px)', 'first' ),
		'section'  => 'first_title',
		'type'     => 'text',
		'priority' => 16,
	));
	$wp_customize->add_setting( 'first_title_margin_bottom', array(
		'default'           => '0',
		'sanitize_callback' => 'first_sanitize_margin',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'first_title_margin_bottom', array(
		'label'    => __( 'Margin Bottom (px)', 'first' ),
		'section'  => 'first_title',
		'type'     => 'text',
		'priority' => 17,
	));
	$wp_customize->add_setting( 'first_title_uppercase', array(
		'default'   => '',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( 'first_title_uppercase', array(
		'label'    => __( 'All Uppercase', 'first' ),
		'section'  => 'first_title',
		'type'     => 'checkbox',
		'priority' => 18,
	) );

	// Logo
	$wp_customize->add_section( 'first_logo', array(
		'title'    => __( 'Logo', 'first' ),
		'priority' => 55,
	) );
	$wp_customize->add_setting( 'first_logo', array(
		'default' => '',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control(	$wp_customize, 'first_logo', array(
		'label'    => __( 'Upload Logo', 'first' ),
		'section'  => 'first_logo',
		'priority' => 11,
	) ) );
	$wp_customize->add_setting( 'first_replace_blogname', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'first_replace_blogname', array(
		'label'    => __( 'Replace Title', 'first' ),
		'section'  => 'first_logo',
		'type'     => 'checkbox',
		'priority' => 12,
	) );
	$wp_customize->add_setting( 'first_retina_logo', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'first_retina_logo', array(
		'label'    => __( 'Retina Ready', 'first' ),
		'section'  => 'first_logo',
		'type'     => 'checkbox',
		'priority' => 13,
	) );
	$wp_customize->add_setting( 'first_add_border_radius', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'first_add_border_radius', array(
		'label'    => __( 'Add Border Radius', 'first' ),
		'section'  => 'first_logo',
		'type'     => 'checkbox',
		'priority' => 14,
	) );
	$wp_customize->add_setting( 'first_logo_margin_top', array(
		'default'           => '0',
		'sanitize_callback' => 'first_sanitize_margin',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'first_logo_margin_top', array(
		'label'    => __( 'Margin Top (px)', 'first' ),
		'section'  => 'first_logo',
		'type'     => 'text',
		'priority' => 15,
	));
	$wp_customize->add_setting( 'first_logo_margin_bottom', array(
		'default'           => '0',
		'sanitize_callback' => 'first_sanitize_margin',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'first_logo_margin_bottom', array(
		'label'    => __( 'Margin Bottom (px)', 'first' ),
		'section'  => 'first_logo',
		'type'     => 'text',
		'priority' => 16,
	));

	// Navigation
	$wp_customize->get_section( 'nav' )->priority  = 60;
	$wp_customize->get_control( 'nav_menu_locations[header]' )->priority  = 20;
	$wp_customize->get_control( 'nav_menu_locations[footer]' )->priority  = 30;
	$wp_customize->add_setting( 'first_hide_navigation', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'first_hide_navigation', array(
		'label'    => __( 'Hide Navigation Bar', 'first' ),
		'section'  => 'nav',
		'type'     => 'checkbox',
		'priority' => 11,
	) );
	$wp_customize->add_setting( 'first_hide_search', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'first_hide_search', array(
		'label'    => __( 'Hide Serach', 'first' ),
		'section'  => 'nav',
		'type'     => 'checkbox',
		'priority' => 12,
	) );

	// Header Image
	$wp_customize->get_section( 'header_image' )->priority  = 70;

	// Post
	$wp_customize->add_section( 'first_post', array(
		'title'    => __( 'Post', 'first' ),
		'priority' => 80,
	) );
	$wp_customize->add_setting( 'first_content', array(
		'default' => 'content',
	) );
	$wp_customize->add_control( 'first_content', array(
		'label'    => __( 'Display', 'first' ),
		'section'  => 'first_post',
		'type'     => 'select',
		'choices'  => array(
			'summary' => __( 'Summary', 'first' ),
			'content' => __( 'Full text',   'first' ),
		),
		'priority' => 11,
	) );
	$wp_customize->add_setting( 'first_hide_author', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'first_hide_author', array(
		'label'    => __( 'Hide Author', 'first' ),
		'section'  => 'first_post',
		'type'     => 'checkbox',
		'priority' => 12,
	) );
	$wp_customize->add_setting( 'first_hide_category', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'first_hide_category', array(
		'label'    => __( 'Hide Categories', 'first' ),
		'section'  => 'first_post',
		'type'     => 'checkbox',
		'priority' => 13,
	) );

	// Footer
	$wp_customize->add_section( 'first_footer', array(
		'title'    => __( 'Footer', 'first' ),
		'priority' => 90,
	) );
	$wp_customize->add_setting( 'first_footer_text', array(
		'default'  => '',
		'sanitize_callback' => 'first_sanitize_text',
	) );
	$wp_customize->add_control( new First_Customize_Textarea_Control( $wp_customize, 'first_footer_text', array(
		'label'    => __( 'Footer Text', 'first' ),
		'section'  => 'first_footer',
		'priority' => 11,
	) ) );
	$wp_customize->add_setting( 'first_hide_credit', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'first_hide_credit', array(
		'label'    => __( 'Hide Credit', 'first' ),
		'section'  => 'first_footer',
		'type'     => 'checkbox',
		'priority' => 12,
	) );

	// Custom CSS
	$wp_customize->add_section( 'first_custom_css', array(
		'title'    => __( 'Custom CSS', 'first' ),
		'priority' => 100,
	) );
	$wp_customize->add_setting( 'first_custom_css', array(
		'default'  => '',
		'sanitize_callback' => 'first_sanitize_css',
		'transport'   => 'postMessage',
	) );
	$wp_customize->add_control( new First_Customize_Textarea_Control( $wp_customize, 'first_custom_css', array(
		'label'    => __( 'Custom CSS', 'first' ),
		'section'  => 'first_custom_css',
		'priority' => 11,
	) ) );
	$wp_customize->add_setting( 'first_custom_google_fonts', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'first_custom_google_fonts', array(
		'label'    => __( 'Custom Google Fonts', 'first' ),
		'section'  => 'first_custom_css',
		'type'     => 'text',
		'priority' => 12,
	));

	// Check Customized
	$wp_customize->add_setting( 'first_is_customized', array(
		'default'  => true,
	) );
}
add_action( 'customize_register', 'first_customize_register' );

/**
 * Sanitize user inputs.
 */
function first_sanitize_title_font_size( $value ) {
	if ( preg_match("/^[1-9][0-9]*$/", $value) ) {
		return $value;
	} else {
		return ( 'ja' == get_bloginfo( 'language' ) ) ? '32' : '36';
	}
}
function first_sanitize_headings_font_size( $value ) {
	if ( preg_match("/^[1-9][0-9]*$/", $value) ) {
		return $value;
	} else {
		return ( 'ja' == get_bloginfo( 'language' ) ) ? '90' : '100';
	}
}
function first_sanitize_body_font_size( $value ) {
	if ( preg_match("/^[1-9][0-9]*$/", $value) ) {
		return $value;
	} else {
		return '16';
	}
}
function first_sanitize_margin( $value ) {
	if ( preg_match("/^-?[0-9]+$/", $value) ) {
		return $value;
	} else {
		return '0';
	}
}
function first_sanitize_text( $value ) {
	$value = wp_kses( $value, array(
		'a'  => array(
			'href'   => array(),
			'target' => array(),
			'rel'    => array(),
		),
		'br' => array(),
	) );
	return $value;
}
function first_sanitize_css( $value ) {
	$value = wp_kses( $value, array( '\'', '\"' ) );
	$value = str_replace( '&gt;', '>', $value );
	return $value;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function first_customize_preview_js() {
	wp_enqueue_script( 'first_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20140709', true );
}
add_action( 'customize_preview_init', 'first_customize_preview_js' );
