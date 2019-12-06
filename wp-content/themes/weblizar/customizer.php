<?php
function freddo_customize_preview_js() {
	wp_enqueue_script( 'freddo-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'freddo_customize_preview_js' );
function weblizar_customizer( $wp_customize ) {
	
	wp_enqueue_style('customizr', WL_TEMPLATE_DIR_URI .'/css/customizr.css');
	
	wp_enqueue_style('FA', WL_TEMPLATE_DIR_URI .'/css/font-awesome-5.11.2/css/all.min.css');
	$ImageUrl1 = get_template_directory_uri() ."/images/slide-1.jpg";
	$ImageUrl2 = get_template_directory_uri() ."/images/slide-2.jpg";
	$ImageUrl3 = get_template_directory_uri() ."/images/slide-3.jpg";
	/* Genral section */
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
	'selector' => '.site-title',
	'render_callback' => 'blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
	'selector' => '.site-description',
	'render_callback' => 'blogdescription',
	) );
	$wp_customize->selective_refresh->add_partial( 'custom_logo', array(
	'selector' => '.site-custom_logo',
	'render_callback' => 'custom_logo',
	) );
	/* Slider Section */
	$wp_customize->add_panel( 'weblizar_theme_option', array(
    'title' => __( 'Weblizar Options','weblizar' ),
    'priority' => 1, // Mixed with top-level-section hierarchy.
	) );
	$wp_customize->add_section(
        'general_sec',
        array(
            'title' => __('Theme General Options','weblizar'),
            'description' => __('Here you can customize Your theme\'s general Settings','weblizar'),
			'panel'=>'weblizar_theme_option',
			'capability'=>'edit_theme_options',
            'priority' => 35,
        )
    );
	$wl_theme_options = weblizar_get_options();
	$wp_customize->add_setting(
		'weblizar_options[_frontpage]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['_frontpage'],
			'sanitize_callback'=>'weblizar_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'weblizar_front_page', array(
		'label'        => __( 'Show Front Page', 'weblizar' ),
		'type'=>'checkbox',
		'section'    => 'general_sec',
		'settings'   => 'weblizar_options[_frontpage]',
	) );
	
	$wp_customize->add_setting(
		'weblizar_options[snoweffect]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['snoweffect'],
			'sanitize_callback'=>'weblizar_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'snoweffect', array(
		'label'        => __( 'Snow effect on/off', 'weblizar' ),
		'type'=>'checkbox',
		'section'    => 'general_sec',
		'settings'   => 'weblizar_options[snoweffect]',
	) );
	
	$wp_customize->add_setting(
		'weblizar_options[sticky_header]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['sticky_header'],
			'sanitize_callback'=>'weblizar_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'sticky_header', array(
		'label'        => __( 'Sticky header on/off', 'weblizar' ),
		'type'=>'checkbox',
		'section'    => 'general_sec',
		'settings'   => 'weblizar_options[sticky_header]',
	) );
	
	$wp_customize->add_setting(
		'weblizar_options[height]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['height'],
			'sanitize_callback'=>'weblizar_sanitize_integer',
			'capability'        => 'edit_theme_options'
		)
	);
	$wp_customize->add_setting(
		'weblizar_options[width]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['width'],
			'sanitize_callback'=>'weblizar_sanitize_integer',
			'capability'        => 'edit_theme_options',
		)
	);
	
	$wp_customize->add_control( 'weblizar_logo_height', array(
		'label'        => __( 'Logo Height', 'weblizar' ),
		'type'=>'number',
		'section'    => 'general_sec',
		'settings'   => 'weblizar_options[height]',
	) );
	$wp_customize->add_control( 'weblizar_logo_width', array(
		'label'        => __( 'Logo Width', 'weblizar' ),
		'type'=>'number',
		'section'    => 'general_sec',
		'settings'   => 'weblizar_options[width]',
	) );
	
	$wp_customize->add_setting(
	'weblizar_options[custom_css]',
		array(
		'default'=>esc_attr($wl_theme_options['custom_css']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'weblizar_sanitize_text',
		)
	);
	
	$wp_customize->add_control( 'custom_css', array(
		'label'        => __( 'Custom CSS', 'weblizar' ),
		'type'=>'textarea',
		'section'    => 'general_sec',
		'settings'   => 'weblizar_options[custom_css]'
	) );
	
	/* Slider Section */
	$wp_customize->add_section(
        'slider_sec',
        array(
            'title' => __('Theme Slider Options','weblizar'),
			'panel'=>'weblizar_theme_option',
            'description' => __('Here you can add slider images','weblizar'),
			'capability'=>'edit_theme_options',
            'priority' => 35,
			'active_callback' => 'is_front_page',
        )
    );
	$wp_customize->add_setting(
		'weblizar_options[slider_image_speed]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slider_image_speed'],
			'sanitize_callback'=>'weblizar_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);

		$wp_customize->add_setting( 'weblizar_slider', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'themeslug_sanitize_select',
		'default' => '1',
		) );

		$wp_customize->add_control( 'weblizar_slider', array(
		  'type' => 'select',
		  'section' => 'slider_sec', // Add a default or your own section
		  'label' => __( 'Select Slider ','weblizar' ),
		  'description' => __( 'select Slider for homepage','weblizar'),
		  'choices' => array(
		    '1' => __( 'Slider 1','weblizar' ),
		    '2' => __( 'Slider 2','weblizar' ),
		  ),
		) );

	$wp_customize->add_control( 'slider_image_speed', array(
		'label'        => __( 'Slider Speed Option', 'weblizar' ),
		'description' => 'Value will be in milliseconds',
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slider_image_speed]',
	) );
	$wp_customize->add_setting(
		'weblizar_options[slide_image]',
		array(
			'type'    => 'option',
			'default'=>$ImageUrl1,
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw',
		)
	);
	$wp_customize->add_setting(
		'weblizar_options[slide_image_1]',
		array(
			'type'    => 'option',
			'default'=>$ImageUrl2,
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_setting(
		'weblizar_options[slide_image_2]',
		array(
			'type'    => 'option',
			'default'=>$ImageUrl3,
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw',
		)
	);
	$wp_customize->add_setting(
		'weblizar_options[slide_title]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_title'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[slide_title]', array(
	'selector' => '.weblizar_slide_title',
	'render_callback' => 'weblizar_options[slide_title]',
	) );
	$wp_customize->add_setting(
		'weblizar_options[slide_title_1]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_title_1'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[slide_title_1]', array(
	'selector' => '.weblizar_slide_title_1',
	'render_callback' => 'weblizar_options[slide_title_1]',
	) );
	$wp_customize->add_setting(
		'weblizar_options[slide_title_2]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_title_2'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[slide_title_2]', array(
	'selector' => '.weblizar_slide_title_2',
	'render_callback' => 'weblizar_options[slide_title_2]',
	) );
	$wp_customize->add_setting(
		'weblizar_options[slide_desc]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_desc'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[slide_desc]', array(
	'selector' => '.weblizar_slide_desc',
	'render_callback' => 'weblizar_options[slide_desc]',
	) );
	$wp_customize->add_setting(
		'weblizar_options[slide_desc_1]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_desc_1'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[slide_desc_1]', array(
	'selector' => '.weblizar_slide_desc_1',
	'render_callback' => 'weblizar_options[slide_desc_1]',
	) );
	$wp_customize->add_setting(
		'weblizar_options[slide_desc_2]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_desc_2'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[slide_desc_2]', array(
	'selector' => '.weblizar_slide_desc_2',
	'render_callback' => 'weblizar_options[slide_desc_2]',
	) );
	$wp_customize->add_setting(
		'weblizar_options[slide_btn_text]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_text'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[slide_btn_text]', array(
	'selector' => '.weblizar_slide_btn_text',
	'render_callback' => 'weblizar_options[slide_btn_text]',
	) );
	$wp_customize->add_setting(
		'weblizar_options[slide_btn_text_1]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_text_1'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[slide_btn_text_1]', array(
	'selector' => '.weblizar_slide_btn_text_1',
	'render_callback' => 'weblizar_options[slide_btn_text_1]',
	) );
	$wp_customize->add_setting(
		'weblizar_options[slide_btn_text_2]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_text_2'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[slide_btn_text_2]', array(
	'selector' => '.weblizar_slide_btn_text_2',
	'render_callback' => 'weblizar_options[slide_btn_text_2]',
	) );
	$wp_customize->add_setting(
		'weblizar_options[slide_btn_link]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_link'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_setting(
		'weblizar_options[slide_btn_link_1]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_link_1'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_setting(
		'weblizar_options[slide_btn_link_2]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_link_2'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'weblizar_slider_image_1', array(
		'label'        => __( 'Slider Image One', 'weblizar' ),
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_image]'
	) ) );
	$wp_customize->add_control( 'weblizar_slide_title_1', array(
		'label'        => __( 'Slider title one', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_title]'
	) );
	$wp_customize->add_control( 'weblizar_slide_desc_1', array(
		'label'        => __( 'Slider description one', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_desc]'
	) );
	$wp_customize->add_control( 'Slider button one', array(
		'label'        => __( 'Slider Button Text One', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_btn_text]'
	) );
	
	$wp_customize->add_control( 'weblizar_slide_btnlink_1', array(
		'label'        => __( 'Slider Button Link', 'weblizar' ),
		'type'=>'url',
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_btn_link]'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'weblizar_slider_image_2', array(
		'label'        => __( 'Slider Image Two ', 'weblizar' ),
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_image_1]'
	) ) );
	
	$wp_customize->add_control( 'weblizar_slide_title_2', array(
		'label'        => __( 'Slider Title Two', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_title_1]'
	) );
	$wp_customize->add_control( 'weblizar_slide_desc_2', array(
		'label'        => __( 'Slider Description Two', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_desc_1]'
	) );
	$wp_customize->add_control( 'weblizar_slide_btn_2', array(
		'label'        => __( 'Slider Button Text Two', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_btn_text_1]'
	) );
	$wp_customize->add_control( 'weblizar_slide_btnlink_2', array(
		'label'        => __( 'Slider Link Two', 'weblizar' ),
		'type'=>'url',
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_btn_link_1]'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'weblizar_slider_image_3', array(
		'label'        => __( 'Slider Image Three', 'weblizar' ),
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_image_2]'
	) ) );
	$wp_customize->add_control( 'weblizar_slide_title_3', array(
		'label'        => __( 'Slider Title Three', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_title_2]'
	) );
	
	$wp_customize->add_control( 'weblizar_slide_desc_3', array(
		'label'        => __( 'Slider Description Three', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_desc_2]'
	) );
	$wp_customize->add_control( 'weblizar_slide_btn_3', array(
		'label'        => __( 'Slider Button Text Three', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_btn_text_2]'
	) );
	$wp_customize->add_control( 'weblizar_slide_btnlink_3', array(
		'label'        => __( 'Slider Button Link Three', 'weblizar' ),
		'type'=>'url',
		'section'    => 'slider_sec',
		'settings'   => 'weblizar_options[slide_btn_link_2]'
	) );

	/* Blog Option */
	$wp_customize->add_section('blog_section',array(
	'title'=>__('Home Blog Option','weblizar'),
	'panel'=>'weblizar_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 37
	));

	$wp_customize->add_setting(
		'weblizar_options[blog_home]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['blog_home'],
			'sanitize_callback'=>'weblizar_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	
	$wp_customize->add_control( 'weblizar_blog_enabled', array(
		'label'        => __( 'Enable Home Blog', 'weblizar' ),
		'type'=>'checkbox',
		'section'    => 'blog_section',
		'settings'   => 'weblizar_options[blog_home]',
	) );
	
	$wp_customize->add_setting(
	'weblizar_options[blog_title]',
		array(
		'default'=>esc_attr($wl_theme_options['blog_title']),
		'type'=>'option',
		'sanitize_callback'=>'weblizar_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[blog_title]', array(
	'selector' => '.weblizar_blog_title',
	'render_callback' => 'weblizar_options[blog_title]',
	) );
	$wp_customize->add_control( 'weblizar_blog_title', array(
		'label'        => __( 'Home Blog Title', 'weblizar' ),
		'type'=>'text',
		'section'    => 'blog_section',
		'settings'   => 'weblizar_options[blog_title]'
	) );
	$wp_customize->add_setting(
	'blog_text',
		array(
		'default'=>esc_attr($wl_theme_options['blog_text']),
		'sanitize_callback'=>'weblizar_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'blog_text', array(
	'selector' => '.weblizar_blog_text',
	'render_callback' => 'blog_text',
	) );
	$wp_customize->add_control(new One_Page_Editor($wp_customize, 'blog_text', array(
		'label'        => __( 'Home Blog Description', 'weblizar' ),
		'section'    => 'blog_section',
		'active_callback' => 'show_on_front',
		'include_admin_print_footer' => true,
		'settings'   => 'blog_text',
	)
	) );

	$wp_customize->add_setting(
	'weblizar_options[blog_count]',
		array(
		'default'=>$wl_theme_options['blog_count'],
		'type'=>'option',
		'sanitize_callback'=>'weblizar_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$count_posts = wp_count_posts();
	$published_posts = $count_posts->publish;
	$wp_customize->add_control( 'weblizar_blog_count', array(
		'label'        => __( 'Show Home Blog Post', 'weblizar' ),
		'type'=>'select',
		'section'    => 'blog_section',
		'settings'   => 'weblizar_options[blog_count]',
		'choices' => array(
            '3' => '3',
            '6' => '6',
            '9' => '9',
			'12' => '12',
			'15' => '15',
			$published_posts => 'Show All Post',
        ),
	) );
	
	
	
	
	/* Service Section */
	$wp_customize->add_section('service_section',array(
	'title'=>__('Home Service Option','weblizar'),
	'panel'=>'weblizar_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 37
	));

	$wp_customize->add_setting(
		'weblizar_options[service_home]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['service_home'],
			'sanitize_callback'=>'weblizar_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	
	$wp_customize->add_control( 'weblizar_service_enabled', array(
		'label'        => __( 'Enable Home Service', 'weblizar' ),
		'type'=>'checkbox',
		'section'    => 'service_section',
		'settings'   => 'weblizar_options[service_home]',
	) );
	$wp_customize->add_setting(
	'weblizar_options[site_intro_title]',
		array(
		'default'=>esc_attr($wl_theme_options['site_intro_title']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'weblizar_sanitize_text',
		)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[site_intro_title]', array(
	'selector' => '.weblizar_site_intro_title',
	'render_callback' => 'weblizar_options[site_intro_title]',
	) );
	$wp_customize->add_control( 'weblizar_service_title', array(
		'label'        => __( 'Service Section Heading', 'weblizar' ),
		'type'	=>'text',
		'section'    => 'service_section',
		'settings'   => 'weblizar_options[site_intro_title]'
	) );
	$wp_customize->add_setting(
	'site_intro_text',
		array(
		'default'=>esc_attr($wl_theme_options['site_intro_text']),
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'weblizar_sanitize_text',
		)
	);
	$wp_customize->selective_refresh->add_partial( 'site_intro_text', array(
	'selector' => '.weblizar_site_intro_text',
	'render_callback' => 'site_intro_text',
	) );
	$wp_customize->add_control(new One_Page_Editor($wp_customize, 'site_intro_text', array(
		'label'        => __( 'Service Section Description', 'weblizar' ),
		'section'    => 'service_section',
		'active_callback' => 'show_on_front',
		'include_admin_print_footer' => true,
		'settings'   => 'site_intro_text',
	)
	) );
	
	for($i=1;$i<=4;$i++){
	$wp_customize->add_setting(
	'weblizar_options[service_'.$i.'_icons]',
		array(
		'default'=>esc_attr($wl_theme_options['service_'.$i.'_icons']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'weblizar_sanitize_text',
			)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[service_'.$i.'_icons]', array(
	'selector' => '.weblizar_service_'.$i.'_icons',
	'render_callback' => 'weblizar_options[service_'.$i.'_icons]',
	) );
	$wp_customize->add_setting(
	'weblizar_options[service_'.$i.'_title]',
		array(
		'default'=>esc_attr($wl_theme_options['service_'.$i.'_title']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'weblizar_sanitize_text',
			)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[service_'.$i.'_title]', array(
	'selector' => '.weblizar_service_'.$i.'_title',
	'render_callback' => 'weblizar_options[service_'.$i.'_title]',
	) );
	$wp_customize->add_setting(
	'weblizar_options[service_'.$i.'_link]',
		array(
		'type'    => 'option',
		'default'=>$wl_theme_options['service_'.$i.'_link'],
		'capability' => 'edit_theme_options',
		'sanitize_callback'=>'esc_url_raw'
		)
	);
	}
	for($i=1;$i<=4;$i++){
	$j = array('', ' One', ' Two', ' Three');
	$wp_customize->add_control( new weblizar_Customize_Misc_Control($wp_customize, 'weblizar_options1-line', array(
            'section'  => 'service_section',
            'type'     => 'line'
        )
    ));
	$wp_customize->add_control(new weblizar_Customizer_Icon_Picker_Control($wp_customize, 'weblizar_service_icon'.$i, array(
		'label'        => 'service-icon-'.$i,
		'description'=>'<a href="http://fontawesome.bootstrapcheatsheets.com">FontAwesome Icons</a>',
		'section'  => 'service_section',
		'settings'   => 'weblizar_options[service_'.$i.'_icons]'
	)
    ) );
	$wp_customize->add_control( 'weblizar_service_title'.$i, array(
		'label'        => 'service-title-'.$i,
		'type'=>'text',
		'section'    => 'service_section',
		'settings'   => 'weblizar_options[service_'.$i.'_title]'
	) );

	$wp_customize->add_setting(
	'service_'.$i.'_text',
		array(
		'default'=>esc_attr($wl_theme_options['service_'.$i.'_text']),
		'sanitize_callback'=>'weblizar_sanitize_text',
		'capability'=>'edit_theme_options',
			)
	);
	$wp_customize->selective_refresh->add_partial( 'service_'.$i.'_text', array(
	'selector' => '.weblizar_service_'.$i.'_text',
	'render_callback' => 'service_'.$i.'_text',
	) );
	$wp_customize->add_control( new One_Page_Editor($wp_customize, 'service_'.$i.'_text', array(
		'label'        => 'service-text-'.$i,
		'section'    => 'service_section',
		'active_callback' => 'show_on_front',
		'include_admin_print_footer' => true,
		'settings'   => 'service_'.$i.'_text'
	)
	) );

	$wp_customize->add_control( 'weblizar_service_link_'.$i, array(
		'label'        => 'service-link-'.$i,
		'type'=>	'url',
		'section'    => 'service_section',
		'settings'   => 'weblizar_options[service_'.$i.'_link]',
	) );
	}
	
	if (get_template_directory() !== get_stylesheet_directory()) {
	/* Product options */
	$wp_customize->add_section('product_section',array(
	'title'=>__("Product Options",'weblizar'),
	'panel'=>'weblizar_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 35,
	));	
	
	$wp_customize->add_setting(
	'weblizar_options[product_title]',
		array(
		'default'=>esc_attr($wl_theme_options['product_title']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'weblizar_sanitize_text',
		
			)
	);
	$wp_customize->add_control( 'product_title', array(
		'label'        => __( 'Product Title', 'weblizar' ),
		'type'=>'text',
		'section'    => 'product_section',
		'settings'   => 'weblizar_options[product_title]'
	) ); }
	
	/* Social options */
	$wp_customize->add_section('social_section',array(
	'title'=>__("Social Options",'weblizar'),
	'panel'=>'weblizar_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 41
	));
	$wp_customize->add_setting(
	'weblizar_options[footer_section_social_media_enbled]',
		array(
		'default'=>esc_attr($wl_theme_options['footer_section_social_media_enbled']),
		'type'=>'option',
		'sanitize_callback'=>'weblizar_sanitize_checkbox',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[footer_section_social_media_enbled]', array(
	'selector' => '.weblizar_social_media_enbled',
	'render_callback' => 'weblizar_options[footer_section_social_media_enbled]',
	) );
	$wp_customize->add_control( 'footer_section_social_media_enbled', array(
		'label'        => __( 'Enable Social Media Icons in Footer', 'weblizar' ),
		'type'=>'checkbox',
		'section'    => 'social_section',
		'settings'   => 'weblizar_options[footer_section_social_media_enbled]'
	) );
	$wp_customize->add_setting(
	'weblizar_options[social_media_facebook_link]',
		array(
		'default'=>esc_attr($wl_theme_options['social_media_facebook_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'social_media_facebook_link', array(
		'label'        => __( 'Facebook URL', 'weblizar' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'weblizar_options[social_media_facebook_link]'
	) );
	$wp_customize->add_setting(
	'weblizar_options[social_media_twitter_link]',
		array(
		'default'=>esc_attr($wl_theme_options['social_media_twitter_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'social_media_twitter_link', array(
		'label'        =>  __('Twitter URL', 'weblizar' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'weblizar_options[social_media_twitter_link]'
	) );
	$wp_customize->add_setting(
	'weblizar_options[social_media_linkedin_link]',
		array(
		'default'=>esc_attr($wl_theme_options['social_media_linkedin_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[social_media_linkedin_link]', array(
	'selector' => '.weblizar_social_media_linkedin_link',
	'render_callback' => 'weblizar_options[social_media_linkedin_link]',
	) );
		$wp_customize->add_control( 'social_media_linkedin_link', array(
		'label'        => __( 'LinkedIn URL', 'weblizar' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'weblizar_options[social_media_linkedin_link]'
	) );
	$wp_customize->add_setting(
	'weblizar_options[social_media_google_plus]',
		array(
		'default'=>esc_attr($wl_theme_options['social_media_google_plus']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url',
		'capability'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'social_media_google_plus', array(
		'label'        => __( 'Goole+ URL', 'weblizar' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'weblizar_options[social_media_google_plus]'
	) );
	/* Footer Options */
	$wp_customize->add_section('footer_section',array(
	'title'=>__("Footer Options","weblizar"),
	'panel'=>'weblizar_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 40
	));
	$wp_customize->add_setting(
	'weblizar_options[footer_customizations]',
		array(
		'default'=>esc_attr($wl_theme_options['footer_customizations']),
		'type'=>'option',
		'sanitize_callback'=>'weblizar_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->selective_refresh->add_partial( 'weblizar_options[footer_customizations]', array(
	'selector' => '.weblizar_footer_customizations',
	'render_callback' => 'weblizar_options[footer_customizations]',
	) );
	$wp_customize->add_control( 'weblizar_footer_customizations', array(
		'label'        => __( 'Footer Customization Text', 'weblizar' ),
		'type'=>'text',
		'section'    => 'footer_section',
		'settings'   => 'weblizar_options[footer_customizations]'
	) );
	
	$wp_customize->add_setting(
	'weblizar_options[developed_by_text]',
		array(
		'default'=>esc_attr($wl_theme_options['developed_by_text']),
		'type'=>'option',
		'sanitize_callback'=>'weblizar_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'weblizar_developed_by_text', array(
		'label'        => __( 'Footer Developed By Text', 'weblizar' ),
		'type'=>'text',
		'section'    => 'footer_section',
		'settings'   => 'weblizar_options[developed_by_text]'
	) );
	$wp_customize->add_setting(
	'weblizar_options[developed_by_weblizar_text]',
		array(
		'default'=>esc_attr($wl_theme_options['developed_by_weblizar_text']),
		'type'=>'option',
		'sanitize_callback'=>'weblizar_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'weblizar_developed_by_weblizar_text', array(
		'label'        => __( 'Footer Company Text', 'weblizar' ),
		'type'=>'text',
		'section'    => 'footer_section',
		'settings'   => 'weblizar_options[developed_by_weblizar_text]'
	) );
	$wp_customize->add_setting(
	'weblizar_options[developed_by_link]',
		array(
		'default'=>esc_attr($wl_theme_options['developed_by_link']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_control( 'weblizar_developed_by_link', array(
		'label'        => __( 'Footer Customization Link', 'weblizar' ),
		'type'=>'url',
		'section'    => 'footer_section',
		'settings'   => 'weblizar_options[developed_by_link]'
	) );	
	
	//header option
	$wp_customize->add_section('search_section',array(
	'title'=>__('Header Option','weblizar'),
	'panel'=>'weblizar_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 38
	));
	
	$wp_customize->add_setting(
		'weblizar_options[search_form]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['search_form'],
			'sanitize_callback'=>'weblizar_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	
	$wp_customize->add_control( 'weblizar_search_enabled', array(
		'label'        => __( 'Enable Search For Header', 'weblizar' ),
		'type'=>'checkbox',
		'section'    => 'search_section',
		'settings'   => 'weblizar_options[search_form]',
	) );
	
	$wp_customize->add_setting(	'weblizar_options[web_mail]', array(
		'default'=>esc_attr($wl_theme_options['web_mail']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'weblizar_sanitize_text',
		)
	);
	$wp_customize->add_control( 'weblizar_mail', array(
		'label'        => __( 'Email', 'weblizar' ),
		'type'	=>'text',
		'section'    => 'search_section',
		'settings'   => 'weblizar_options[web_mail]'
	) );
	
	$wp_customize->add_setting(	'weblizar_options[web_phone]', array(
		'default'=>esc_attr($wl_theme_options['web_phone']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'weblizar_sanitize_text',
		)
	);
	$wp_customize->add_control( 'weblizar_phone', array(
		'label'        => __( 'Phone', 'weblizar' ),
		'type'	=>'text',
		'section'    => 'search_section',
		'settings'   => 'weblizar_options[web_phone]'
	) );
	
	// excerpt option 
    $wp_customize->add_section('excerpt_option',array(
    'title'=>__("Excerpt Option",'weblizar'),
    'panel'=>'weblizar_theme_option',
    'capability'=>'edit_theme_options',
    'priority' => 37,
    ));
    
    $wp_customize->add_setting( 'weblizar_options[excerpt_blog]', array(
        'default'=>$wl_theme_options['excerpt_blog'],
        'type'=>'option',
        'sanitize_callback'=>'weblizar_sanitize_integer',
        'capability'=>'edit_theme_options'
    ) );
        $wp_customize->add_control( 'excerpt_blog', array(
        'label'        => __( 'Excerpt length blog section', 'weblizar' ),
        'type'=>'number',
        'section'    => 'excerpt_option',
		'description' => esc_html__('Excerpt length only for home blog section.', 'weblizar'),
		'settings'   => 'weblizar_options[excerpt_blog]'
    ) );
	
    // home layout //
	$wp_customize->add_section('Home_Page_Layout',array(
    'title'=>__("Home Page Layout Option",'weblizar'),
    'panel'=>'weblizar_theme_option',
    'capability'=>'edit_theme_options',
    'priority' => 50,
    ));
	$wp_customize->add_setting('home_reorder',
            array(
				'type'=>'theme_mod',
                'sanitize_callback' => 'sanitize_json_string',
				'capability'        => 'edit_theme_options',
            )
        );
        $wp_customize->add_control(new weblizar_Custom_sortable_Control($wp_customize,'home_reorder', array(
			'label'=>__( 'Front Page Layout Option', 'weblizar' ),
            'section' => 'Home_Page_Layout',
            'type'    => 'home-sortable',
            'choices' => array(
                'service'      => __('Home Services', 'weblizar'),
                'blog'        => __('Home Blog', 'weblizar'),
            ),
			'settings'=>'home_reorder',
        )));
}
add_action( 'customize_register', 'weblizar_customizer' );
function weblizar_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function weblizar_sanitize_checkbox( $input ) {
    if ( $input == 'on' ) {
        return 'on';
    } else {
        return '';
    }
}
function weblizar_sanitize_integer( $input ) {
    return (int)($input);
}
function sanitize_json_string($json){
    $sanitized_value = array();
    foreach (json_decode($json,true) as $value) {
        $sanitized_value[] = esc_attr($value);
    }
    return json_encode($sanitized_value);
}

function themeslug_sanitize_select( $input, $setting ) {

  // Ensure input is a slug.
  $input = sanitize_key( $input );

  // Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control( $setting->id )->choices;

  // If the input is a valid key, return it; otherwise, return the default.
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/* Custom Control Class */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'weblizar_Customize_Misc_Control' ) ) :
class weblizar_Customize_Misc_Control extends WP_Customize_Control {
    public $settings = 'blogname';
    public $description = '';
    public function render_content() {
        switch ( $this->type ) {
            default:
           
            case 'heading':
                echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
                break;
 
            case 'line' :
                echo '<hr />';
                break;
			
        }
    }
}
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'weblizar_Customizer_Icon_Picker_Control' ) ) :
	class weblizar_Customizer_Icon_Picker_Control extends WP_Customize_Control {
	

		public function enqueue() {
			wp_enqueue_script( 'fontawesome-iconpicker', get_template_directory_uri() . '/iconpicker-control/assets/js/fontawesome-iconpicker.min.js', array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'iconpicker-control', get_template_directory_uri() . '/iconpicker-control/assets/js/iconpicker-control.js', array( 'jquery' ), '1.0.0', true );
			wp_enqueue_style( 'iconpicker-css', get_template_directory_uri() . '/iconpicker-control/assets/css/fontawesome-iconpicker.css', array(), rand() );	
			//wp_enqueue_style('font-awesome-latest', get_template_directory_uri(). '/css/font-awesome-latest/css/fontawesome-all.css');

		}
		
		
		public function render_content() {
			?>
			<label>
				<style>
			input.icp.icp-auto.iconpicker-element.iconpicker-input {
			width: 90% !important;
			}
			</style>

				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
				<div class="input-group icp-container">
					<input data-placement="bottomRight" class="icp icp-auto" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" type="text">
					<span class="input-group-addon"></span>
				</div>
			</label>
			<?php
		}
	}
endif;


if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'weblizar_Custom_sortable_Control' ) ) :
class weblizar_Custom_sortable_Control extends WP_Customize_Control
{
    public $type = 'home-sortable';
    /*Enqueue resources for the control*/
    public function enqueue()
    {

        wp_enqueue_style('customizer-repeater-admin-stylesheet', get_template_directory_uri() . '/assets/customizer_js_css/css/weblizar-admin-style.css', time());

        wp_enqueue_script('customizer-repeater-script', get_template_directory_uri() . '/assets/customizer_js_css/js/weblizar-customizer_repeater.js', array('jquery', 'jquery-ui-draggable'), time(), true);

    }
    public function render_content()
    {
        if (empty($this->choices)) {
            return;
        }
        $values = json_decode($this->value());
        $name         = $this->id;
        ?>

		<span class="customize-control-title">
			<?php echo esc_attr($this->label); ?>
		</span>

		<?php if (!empty($this->description)): ?>
			<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
		<?php endif;?>

		<div class="customizer-repeater-general-control-repeater customizer-repeater-general-control-droppable">
			<?php 
			if(!empty($values)){ 
				foreach ($values as $value) {?>
					<div class="customizer-repeater-general-control-repeater-container customizer-repeater-draggable ui-sortable-handle">
					<div class="customizer-repeater-customize-control-title">
						<?php echo esc_attr($this->choices[$value]); ?>
					</div>
					<input type="hidden" class="section-id" value="<?php echo esc_attr($value); ?>">
					</div>	
				<?php }?>
				
			<?php }else{
			foreach ($this->choices as $value => $label): ?>
					<div class="customizer-repeater-general-control-repeater-container customizer-repeater-draggable ui-sortable-handle">
					<div class="customizer-repeater-customize-control-title">
						<?php echo esc_attr($label); ?>
					</div>
					<input type="hidden" class="section-id" value="<?php echo esc_attr($value); ?>">
					</div>

				<?php endforeach;
			}
        		if (!empty($value)) {?>
					<input type="hidden"
					       id="customizer-repeater-<?php echo esc_attr($this->id); ?>-colector" <?php esc_url($this->link());?>
					       class="customizer-repeater-colector"
					       value="<?php echo esc_textarea(json_encode($value)); ?>"/>
					<?php
				} else {?>
					<input type="hidden"
					       id="customizer-repeater-<?php echo esc_attr($this->id); ?>-colector" <?php esc_url($this->link());?>
					       class="customizer-repeater-colector"/>
					<?php
				}?>
		</div>
		<?php
}
}
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'One_Page_Editor' ) ) :
/* Class to create a custom tags control */
class One_Page_Editor extends WP_Customize_Control {	
	private $include_admin_print_footer = false;
	private $teeny = false;
	public $type = 'text-editor';
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if ( ! empty( $args['include_admin_print_footer'] ) ) {
			$this->include_admin_print_footer = $args['include_admin_print_footer'];
		}
		if ( ! empty( $args['teeny'] ) ) {
			$this->teeny = $args['teeny'];
		}
	}
	/* Enqueue scripts */
	public function enqueue() {
		wp_enqueue_script( 'one_lite_text_editor', get_template_directory_uri() . '/inc/customizer-page-editor/js/one-lite-text-editor.js', array( 'jquery' ), false, true );
	}
	/* Render the content on the theme customizer page */
	public function render_content() {
		?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>">
		<?php
		$settings = array(
			'textarea_name' => $this->id,
			'teeny' => $this->teeny,
		);
		$control_content = $this->value();
		wp_editor( $control_content, $this->id, $settings );

		if ( $this->include_admin_print_footer === true ) {
			do_action( 'admin_print_footer_scripts' );
		}
	}
}
endif;

function show_on_front() {
	if(is_front_page())
	{
		return is_front_page() && 'posts' !== get_option( 'show_on_front' );
	}
	elseif(is_home()) 
	{
		return is_home();
	}
}
?>