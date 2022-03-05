<?php
/**
 * Automobile Shop: Customizer
 *
 * @subpackage Automobile Shop
 * @since 1.0
 */

use WPTRT\Customize\Section\Automobile_Shop_Button;

add_action( 'customize_register', function( $manager ) {

	$manager->register_section_type( Automobile_Shop_Button::class );

	$manager->add_section(
		new Automobile_Shop_Button( $manager, 'automobile_shop_pro', [
			'title'      => __( 'Automobile Shop Pro', 'automobile-shop' ),
			'priority'    => 0,
			'button_text' => __( 'Go Pro', 'automobile-shop' ),
			'button_url'  => esc_url( 'https://www.luzuk.com/product/automobile-shop-wordpress-theme/', 'automobile-shop')
		] )
	);

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script(
		'automobile-shop-customize-section-button',
		get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
		[ 'customize-controls' ],
		$version,
		true
	);

	wp_enqueue_style(
		'automobile-shop-customize-section-button',
		get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
		[ 'customize-controls' ],
 		$version
	);

} );

function automobile_shop_customize_register( $wp_customize ) {

	$wp_customize->add_setting('automobile_shop_logo_margin',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('automobile_shop_logo_margin',array(
		'label' => __('Logo Margin','automobile-shop'),
		'section' => 'title_tagline'
	));

	$wp_customize->add_setting('automobile_shop_logo_top_margin',array(
		'default' => '',
		'sanitize_callback'	=> 'automobile_shop_sanitize_float'
	));
	$wp_customize->add_control('automobile_shop_logo_top_margin',array(
		'type' => 'number',
		'description' => __('Top','automobile-shop'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_setting('automobile_shop_logo_bottom_margin',array(
		'default' => '',
		'sanitize_callback'	=> 'automobile_shop_sanitize_float'
	));
	$wp_customize->add_control('automobile_shop_logo_bottom_margin',array(
		'type' => 'number',
		'description' => __('Bottom','automobile-shop'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_setting('automobile_shop_logo_left_margin',array(
		'default' => '',
		'sanitize_callback'	=> 'automobile_shop_sanitize_float'
	));
	$wp_customize->add_control('automobile_shop_logo_left_margin',array(
		'type' => 'number',
		'description' => __('Left','automobile-shop'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_setting('automobile_shop_logo_right_margin',array(
		'default' => '',
		'sanitize_callback'	=> 'automobile_shop_sanitize_float'
 	));
 	$wp_customize->add_control('automobile_shop_logo_right_margin',array(
		'type' => 'number',
		'description' => __('Right','automobile-shop'),
		'section' => 'title_tagline',
    ));

	$wp_customize->add_setting('automobile_shop_show_site_title',array(
		'default' => true,
		'sanitize_callback'	=> 'automobile_shop_sanitize_checkbox'
	));
	$wp_customize->add_control('automobile_shop_show_site_title',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide Site Title','automobile-shop'),
		'section' => 'title_tagline'
	));

	$wp_customize->add_setting('automobile_shop_show_tagline',array(
		'default' => true,
		'sanitize_callback'	=> 'automobile_shop_sanitize_checkbox'
	));
	$wp_customize->add_control('automobile_shop_show_tagline',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide Site Tagline','automobile-shop'),
		'section' => 'title_tagline'
	));

	$wp_customize->add_panel( 'automobile_shop_panel_id', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Settings', 'automobile-shop' ),
		'description' => __( 'Description of what this panel does.', 'automobile-shop' ),
	) );

	$wp_customize->add_section( 'automobile_shop_theme_options_section', array(
    	'title'      => __( 'General Settings', 'automobile-shop' ),
		'priority'   => 30,
		'panel' => 'automobile_shop_panel_id'
	) );

	$wp_customize->add_setting('automobile_shop_theme_options',array(
		'default' => 'Right Sidebar',
		'sanitize_callback' => 'automobile_shop_sanitize_choices'
	));
	$wp_customize->add_control('automobile_shop_theme_options',array(
		'type' => 'select',
		'label' => __('Blog Page Sidebar Layout','automobile-shop'),
		'section' => 'automobile_shop_theme_options_section',
		'choices' => array(
		   'Left Sidebar' => __('Left Sidebar','automobile-shop'),
		   'Right Sidebar' => __('Right Sidebar','automobile-shop'),
		   'One Column' => __('One Column','automobile-shop'),
		   'Grid Layout' => __('Grid Layout','automobile-shop')
		),
	));

	$wp_customize->add_setting('automobile_shop_single_post_sidebar',array(
		'default' => 'Right Sidebar',
		'sanitize_callback' => 'automobile_shop_sanitize_choices'
	));
	$wp_customize->add_control('automobile_shop_single_post_sidebar',array(
        'type' => 'select',
        'label' => __('Single Post Sidebar Layout','automobile-shop'),
        'section' => 'automobile_shop_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','automobile-shop'),
            'Right Sidebar' => __('Right Sidebar','automobile-shop'),
            'One Column' => __('One Column','automobile-shop')
        ),
	));

	$wp_customize->add_setting('automobile_shop_page_sidebar',array(
		'default' => 'One Column',
		'sanitize_callback' => 'automobile_shop_sanitize_choices'
	));
	$wp_customize->add_control('automobile_shop_page_sidebar',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','automobile-shop'),
        'section' => 'automobile_shop_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','automobile-shop'),
            'Right Sidebar' => __('Right Sidebar','automobile-shop'),
            'One Column' => __('One Column','automobile-shop')
        ),
	));

	$wp_customize->add_setting('automobile_shop_archive_page_sidebar',array(
		'default' => 'Right Sidebar',
		'sanitize_callback' => 'automobile_shop_sanitize_choices'
	));
	$wp_customize->add_control('automobile_shop_archive_page_sidebar',array(
        'type' => 'select',
        'label' => __('Archive & Search Page Sidebar Layout','automobile-shop'),
        'section' => 'automobile_shop_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','automobile-shop'),
            'Right Sidebar' => __('Right Sidebar','automobile-shop'),
            'One Column' => __('One Column','automobile-shop'),
            'Grid Layout' => __('Grid Layout','automobile-shop')
        ),
	));

	//Header
	$wp_customize->add_section( 'automobile_shop_header_section' , array(
    	'title'    => __( 'Header', 'automobile-shop' ),
		'priority' => null,
		'panel' => 'automobile_shop_panel_id'
	) );

	$wp_customize->add_setting('automobile_shop_phone_number',array(
    	'default' => '',
    	'sanitize_callback'	=> 'automobile_shop_sanitize_phone_number'
	));
	$wp_customize->add_control('automobile_shop_phone_number',array(
	   	'type' => 'text',
	   	'label' => __('Add Phone Number','automobile-shop'),
	   	'section' => 'automobile_shop_header_section',
	));

	//home page slider
	$wp_customize->add_section( 'automobile_shop_slider_section' , array(
    	'title'    => __( 'Slider Settings', 'automobile-shop' ),
		'priority' => null,
		'panel' => 'automobile_shop_panel_id'
	) );

	$wp_customize->add_setting('automobile_shop_slider_hide_show',array(
    	'default' => false,
    	'sanitize_callback'	=> 'automobile_shop_sanitize_checkbox'
	));
	$wp_customize->add_control('automobile_shop_slider_hide_show',array(
	   	'type' => 'checkbox',
	   	'label' => __('Show / Hide Slider','automobile-shop'),
	   	'section' => 'automobile_shop_slider_section',
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'automobile_shop_slider' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'automobile_shop_sanitize_dropdown_pages'
		));
		$wp_customize->add_control( 'automobile_shop_slider' . $count, array(
			'label' => __('Select Slider Image Page', 'automobile-shop' ),
			'description'=> __('Image size (1400px x 600px)','automobile-shop'),
			'section' => 'automobile_shop_slider_section',
			'type' => 'dropdown-pages'
		));
	}

	//Services Section
	$wp_customize->add_section('automobile_shop_service_section',array(
		'title'	=> __('Service Section','automobile-shop'),
		'description'=> __('This section will appear below the slider.','automobile-shop'),
		'panel' => 'automobile_shop_panel_id',
	));

    $wp_customize->add_setting('automobile_shop_small_title',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('automobile_shop_small_title',array(
		'label'	=> __('Section Small Title','automobile-shop'),
		'section' => 'automobile_shop_service_section',
		'type' => 'text'
	));

    $wp_customize->add_setting('automobile_shop_section_title',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('automobile_shop_section_title',array(
		'label'	=> __('Section Title','automobile-shop'),
		'section' => 'automobile_shop_service_section',
		'type' => 'text'
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_pst[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_pst[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('automobile_shop_category_setting',array(
		'default' => 'select',
		'sanitize_callback' => 'automobile_shop_sanitize_choices',
	));
	$wp_customize->add_control('automobile_shop_category_setting',array(
		'type' => 'select',
		'choices' => $cat_pst,
		'label' => __('Select Category to display Post','automobile-shop'),
		'section' => 'automobile_shop_service_section',
	));

	$wp_customize->add_setting('automobile_shop_service_number',array(
		'default'	=> '4',
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('automobile_shop_service_number',array(
		'label'	=> __('Number of posts to show in a category','automobile-shop'),
		'section' => 'automobile_shop_service_section',
		'type'	  => 'number'
	));

	$automobile_shop_service_number = get_theme_mod('automobile_shop_service_number', 4);
	for ($i=1; $i <= $automobile_shop_service_number; $i++) { 
	   	$wp_customize->add_setting('automobile_shop_service_icon' . $i, array(
	      	'default' => 'fas fa-car',
	      	'sanitize_callback' => 'sanitize_text_field'
	   	));
	   	$wp_customize->add_control(new Automobile_Shop_Fontawesome_Icon_Chooser($wp_customize, 'automobile_shop_service_icon' . $i, array(
	      	'section' => 'automobile_shop_service_section',
	      	'type' => 'icon',
	      	'label' => esc_html__('Service Icon ', 'automobile-shop') . $i
	  	)));
	}

	//Footer
    $wp_customize->add_section( 'automobile_shop_footer', array(
    	'title'  => __( 'Footer Text', 'automobile-shop' ),
		'priority' => null,
		'panel' => 'automobile_shop_panel_id'
	) );

	$wp_customize->add_setting('automobile_shop_show_back_totop',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_shop_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_shop_show_back_totop',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Back to Top','automobile-shop'),
       'section' => 'automobile_shop_footer'
    ));

    $wp_customize->add_setting('automobile_shop_footer_copy',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('automobile_shop_footer_copy',array(
		'label'	=> __('Footer Text','automobile-shop'),
		'section' => 'automobile_shop_footer',
		'setting' => 'automobile_shop_footer_copy',
		'type' => 'text'
	));

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'automobile_shop_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'automobile_shop_customize_partial_blogdescription',
	) );
}
add_action( 'customize_register', 'automobile_shop_customize_register' );

function automobile_shop_customize_partial_blogname() {
	bloginfo( 'name' );
}

function automobile_shop_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function automobile_shop_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

function automobile_shop_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

if (class_exists('WP_Customize_Control')) {

   	class Automobile_Shop_Fontawesome_Icon_Chooser extends WP_Customize_Control {

      	public $type = 'icon';

      	public function render_content() { ?>
	     	<label>
	            <span class="customize-control-title">
	               <?php echo esc_html($this->label); ?>
	            </span>

	            <?php if ($this->description) { ?>
	                <span class="description customize-control-description">
	                   <?php echo wp_kses_post($this->description); ?>
	                </span>
	            <?php } ?>

	            <div class="automobile-shop-selected-icon">
	                <i class="fa <?php echo esc_attr($this->value()); ?>"></i>
	                <span><i class="fa fa-angle-down"></i></span>
	            </div>

	            <ul class="automobile-shop-icon-list clearfix">
	                <?php
	                $automobile_shop_font_awesome_icon_array = automobile_shop_font_awesome_icon_array();
	                foreach ($automobile_shop_font_awesome_icon_array as $automobile_shop_font_awesome_icon) {
	                   $icon_class = $this->value() == $automobile_shop_font_awesome_icon ? 'icon-active' : '';
	                   echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($automobile_shop_font_awesome_icon) . '"></i></li>';
	                }
	                ?>
	            </ul>
	            <input type="hidden" value="<?php $this->value(); ?>" <?php $this->link(); ?> />
	        </label>
	        <?php
      	}
  	}
}
function automobile_shop_customizer_script() {
   wp_enqueue_style( 'font-awesome-1', esc_url(get_template_directory_uri()).'/assets/css/fontawesome-all.css');
}
add_action( 'customize_controls_enqueue_scripts', 'automobile_shop_customizer_script' );