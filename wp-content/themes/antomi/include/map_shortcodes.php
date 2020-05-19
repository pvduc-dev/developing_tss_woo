<?php
//Shortcodes for Visual Composer
add_action( 'vc_before_init', 'antomi_vc_shortcodes' );
function antomi_vc_shortcodes() { 
	//Site logo
	vc_map( array(
		'name' => esc_html__( 'Logo', 'antomi'),
		'description' => esc_html__( 'Insert logo image', 'antomi' ),
		'base' => 'roadlogo',
		'class' => '',
		'category' => esc_html__( 'Theme', 'antomi'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params' => array(
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload logo image', 'antomi' ),
				'description'=> esc_html__( 'Note: For retina screen, logo image size is at least twice as width and height (width is set below) to display clearly', 'antomi' ),
				'param_name' => 'logo_image',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Insert logo link or not', 'antomi' ),
				'param_name' => 'logo_link',
				'value'      => array(
					esc_html__( 'Yes', 'antomi' )	=> 'yes',
					esc_html__( 'No', 'antomi' )	=> 'no',
				),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Logo width (unit: px)', 'antomi' ),
				'description'=> esc_html__( 'Insert number. Leave blank if you want to use original image size', 'antomi' ),
				'param_name' => 'logo_width',
				'value'      => esc_html__( '150', 'antomi' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'antomi' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'antomi' )                  => 'style1',
					esc_html__( 'Style 2 (footer)', 'antomi' )         => 'style2',
				),
			),
		)
	) );
	//Main Menu
	vc_map( array(
		'name'        => esc_html__( 'Main Menu', 'antomi'),
		'description' => esc_html__( 'Set Primary Menu in Apperance - Menus - Manage Locations', 'antomi' ),
		'base'        => 'roadmainmenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'antomi'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'        => '',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Set Primary Menu in Apperance - Menus - Manage Locations', 'antomi' ),
				'description' => esc_html__( 'More settings in Theme Options - Main Menu', 'antomi' ),
				'param_name'  => 'no_settings',
				'value'       => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'antomi' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1 (Default)', 'antomi' )        => 'style1',
					esc_html__( 'Style 2 (Demo 2+3)', 'antomi' )         => 'style2',
					esc_html__( 'Style 3 (Demo 2+3 sticky)', 'antomi' )  => 'style3',
				),
			),
		),
	) );
	//Sticky Menu
	vc_map( array(
		'name'        => esc_html__( 'Sticky Menu', 'antomi'),
		'description' => esc_html__( 'Set Sticky Menu in Apperance - Menus - Manage Locations', 'antomi' ),
		'base'        => 'roadstickymenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'antomi'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'        => '',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Set Sticky Menu in Apperance - Menus - Manage Locations', 'antomi' ),
				'description' => esc_html__( 'More settings in Theme Options - Main Menu', 'antomi' ),
				'param_name'  => 'no_settings',
				'value'       => '',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'antomi' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'antomi' )  => 'style1',
					esc_html__( 'Style 2', 'antomi' )  => 'style2',
				),
			),
		),
	) );
	//Mobile Menu
	vc_map( array(
		'name'        => esc_html__( 'Mobile Menu', 'antomi'),
		'description' => esc_html__( 'Set Mobile Menu in Apperance - Menus - Manage Locations', 'antomi' ),
		'base'        => 'roadmobilemenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'antomi'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'        => '',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Set Mobile Menu in Apperance - Menus - Manage Locations', 'antomi' ),
				'description' => esc_html__( 'More settings in Theme Options - Main Menu', 'antomi' ),
				'param_name'  => 'no_settings',
				'value'       => '',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'antomi' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'antomi' )  => 'style1',
					esc_html__( 'Style 2', 'antomi' )  => 'style2',
				),
			),
		),
	) );
	//Categories Menu
	vc_map( array(
		'name'        => esc_html__( 'Categories Menu', 'antomi'),
		'description' => esc_html__( 'Set Categories Menu in Apperance - Menus - Manage Locations', 'antomi' ),
		'base'        => 'roadcategoriesmenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'antomi'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'        => '',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Set Categories Menu in Apperance - Menus - Manage Locations', 'antomi' ),
				'description' => esc_html__( 'More settings in Theme Options - Categories Menu', 'antomi' ),
				'param_name'  => 'no_settings',
				'value'       => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Show full Categories in home page ?', 'antomi' ),
				'description' => esc_html__( 'In inner pages, it only shows the toogle', 'antomi' ),
				'param_name' => 'categories_show_home',
				'value'      => array(
					esc_html__( 'No', 'antomi' )  => 'false',
					esc_html__( 'Yes', 'antomi' ) => 'true',
				),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'antomi' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'antomi' )          => 'style1',
					esc_html__( 'Style 2 (Demo 4)', 'antomi' ) => 'style2',
				),
			),
		),
	) );
	//Social Icons
	vc_map( array(
		'name'        => esc_html__( 'Social Icons', 'antomi'),
		'description' => esc_html__( 'Configure icons and links in Theme Options', 'antomi' ),
		'base'        => 'roadsocialicons',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'antomi'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => '',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Configure icons and links in Theme Options > Social Icons', 'antomi' ),
				'param_name' => 'no_settings',
				'value'      => '',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Social title element', 'antomi' ),
				'param_name' => 'social_title',
				'value'      => 'Title',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Social sub-title element', 'antomi' ),
				'param_name' => 'sub_social_title',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'antomi' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1 (header)', 'antomi' ) => 'style1',
					esc_html__( 'Style 2 (footer)', 'antomi' ) => 'style2',
				),
			),
		),
	) );
	//Mini Cart
	vc_map( array(
		'name'        => esc_html__( 'Mini Cart', 'antomi'),
		'description' => esc_html__( 'Mini Cart', 'antomi' ),
		'base'        => 'roadminicart',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'antomi'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => '',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'This widget does not have settings', 'antomi' ),
				'param_name' => 'no_settings',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'antomi' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'antomi' )              => 'style1',
					esc_html__( 'Style 2 (demo 3)', 'antomi' )     => 'style2',
				),
			),
		),
	) );
	//Wishlist
	vc_map( array(
		'name'        => esc_html__( 'Wishlist', 'antomi'),
		'description' => esc_html__( 'Wishlist', 'antomi' ),
		'base'        => 'roadwishlist',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'antomi'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'antomi' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'antomi' )           => 'style1',
					esc_html__( 'Style 2 (demo 3)', 'antomi' )  => 'style2',
				),
			),
		),
	) );
	//Products Search without dropdown
	vc_map( array(
		'name'        => esc_html__( 'Product Search (No dropdown)', 'antomi'),
		'description' => esc_html__( 'Product Search (No dropdown)', 'antomi' ),
		'base'        => 'roadproductssearch',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'antomi'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'antomi' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'antomi' )           => 'style1',
					esc_html__( 'Style 2 (demo 4)', 'antomi' )  => 'style2',
				),
			),
		),
	) );
	//Products Search with dropdown
	vc_map( array(
		'name'        => esc_html__( 'Product Search (Dropdown)', 'antomi'),
		'description' => esc_html__( 'Product Search (Dropdown)', 'antomi' ),
		'base'        => 'roadproductssearchdropdown',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'antomi'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => '',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'This widget does not have settings', 'antomi' ),
				'param_name' => 'no_settings',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'antomi' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'antomi' )               => 'style1',
				),
			),
		),
	) );
	//Image slider
	vc_map( array(
		'name'        => esc_html__( 'Image slider', 'antomi' ),
		'description' => esc_html__( 'Upload images and links in Theme Options', 'antomi' ),
		'base'        => 'image_slider',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'antomi'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of rows', 'antomi' ),
				'param_name' => 'rows',
				'value'      => array(
					'1'	=> '1',
					'2'	=> '2',
					'3'	=> '3',
					'4'	=> '4',
					'5'	=> '5',
					'6'	=> '6',
				),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Number of columns (screen: over 1500px)', 'antomi' ),
				'param_name' => 'items_1500up',
				'value'      => esc_html__( '4', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Number of columns (screen: 1200px - 1499px)', 'antomi' ),
				'param_name' => 'items_1200_1499',
				'value'      => esc_html__( '4', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 992px - 1199px)', 'antomi' ),
				'param_name' => 'items_992_1199',
				'value'      => esc_html__( '4', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 768px - 991px)', 'antomi' ),
				'param_name' => 'items_768_991',
				'value'      => esc_html__( '3', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 640px - 767px)', 'antomi' ),
				'param_name' => 'items_640_767',
				'value'      => esc_html__( '2', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 480px - 639px)', 'antomi' ),
				'param_name' => 'items_480_639',
				'value'      => esc_html__( '2', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: under 479px)', 'antomi' ),
				'param_name' => 'items_0_479',
				'value'      => esc_html__( '1', 'antomi' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Navigation', 'antomi' ),
				'param_name' => 'navigation',
				'value'      => array(
					esc_html__( 'Yes', 'antomi' ) => true,
					esc_html__( 'No', 'antomi' )  => false,
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Pagination', 'antomi' ),
				'param_name' => 'pagination',
				'value'      => array(
					esc_html__( 'No', 'antomi' )  => false,
					esc_html__( 'Yes', 'antomi' ) => true,
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Item Margin (unit: pixel)', 'antomi' ),
				'param_name' => 'item_margin',
				'value'      => 30,
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Slider speed number (unit: second)', 'antomi' ),
				'param_name' => 'speed',
				'value'      => '500',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => esc_html__( 'Slider loop', 'antomi' ),
				'param_name' => 'loop',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => esc_html__( 'Slider Auto', 'antomi' ),
				'param_name' => 'auto',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'antomi' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'antomi' )  => 'style1',
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Navigation style', 'antomi' ),
				'param_name'  => 'navigation_style',
				'value'       => array(
					esc_html__( 'Navigation top-right', 'antomi' )          => 'navigation-style1',
					esc_html__( 'Navigation center horizontal', 'antomi' )  => 'navigation-style2',
				),
			),
		),
	) );
	//Brand logos
	vc_map( array(
		'name'        => esc_html__( 'Brand Logos', 'antomi' ),
		'description' => esc_html__( 'Upload images and links in Theme Options', 'antomi' ),
		'base'        => 'ourbrands',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'antomi'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of rows', 'antomi' ),
				'param_name' => 'rows',
				'value'      => array(
					'1'	=> '1',
					'2'	=> '2',
					'3'	=> '3',
					'4'	=> '4',
				),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Number of columns (screen: over 1500px)', 'antomi' ),
				'param_name' => 'items_1500up',
				'value'      => esc_html__( '5', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: 1200px - 1499px)', 'antomi' ),
				'param_name' => 'items_1200_1499',
				'value'      => esc_html__( '5', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: 992px - 1199px)', 'antomi' ),
				'param_name' => 'items_992_1199',
				'value'      => esc_html__( '5', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: 768px - 991px)', 'antomi' ),
				'param_name' => 'items_768_991',
				'value'      => esc_html__( '4', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: 640px - 767px)', 'antomi' ),
				'param_name' => 'items_640_767',
				'value'      => esc_html__( '3', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: 480px - 639px)', 'antomi' ),
				'param_name' => 'items_480_639',
				'value'      => esc_html__( '2', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: under 479px)', 'antomi' ),
				'param_name' => 'items_0_479',
				'value'      => esc_html__( '1', 'antomi' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Navigation', 'antomi' ),
				'param_name' => 'navigation',
				'value'      => array(
					esc_html__( 'Yes', 'antomi' ) => true,
					esc_html__( 'No', 'antomi' )  => false,
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Pagination', 'antomi' ),
				'param_name' => 'pagination',
				'value'      => array(
					esc_html__( 'No', 'antomi' )  => false,
					esc_html__( 'Yes', 'antomi' ) => true,
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Item Margin (unit: pixel)', 'antomi' ),
				'param_name' => 'item_margin',
				'value'      => 0,
			),
			array(
				'type'       => 'textfield',
				'heading'    =>  esc_html__( 'Slider speed number (unit: second)', 'antomi' ),
				'param_name' => 'speed',
				'value'      => '500',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => esc_html__( 'Slider loop', 'antomi' ),
				'param_name' => 'loop',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => esc_html__( 'Slider Auto', 'antomi' ),
				'param_name' => 'auto',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Style', 'antomi' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'antomi' )       => 'style1',
				),
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'heading'     => esc_html__( 'Navigation style', 'antomi' ),
				'param_name'  => 'navigation_style',
				'value'       => array(
					esc_html__( 'Navigation center horizontal', 'antomi' )  => 'navigation-style1',
					esc_html__( 'Navigation top-right', 'antomi' )          => 'navigation-style2',
				),
			),
		),
	) );
	//Latest posts
	vc_map( array(
		'name'        => esc_html__( 'Latest posts', 'antomi' ),
		'description' => esc_html__( 'List posts', 'antomi' ),
		'base'        => 'latestposts',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'antomi'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of posts', 'antomi' ),
				'param_name' => 'posts_per_page',
				'value'      => esc_html__( '10', 'antomi' ),
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Category', 'antomi' ),
				'param_name'  => 'category',
				'value'       => esc_html__( '0', 'antomi' ),
				'description' => esc_html__( 'Slug of the category (example: slug-1, slug-2). Default is 0 : show all posts', 'antomi' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Image scale', 'antomi' ),
				'param_name' => 'image',
				'value'      => array(
					'Wide'	=> 'wide',
					'Square'=> 'square',
				),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Excerpt length', 'antomi' ),
				'param_name' => 'length',
				'value'      => esc_html__( '20', 'antomi' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns', 'antomi' ),
				'param_name' => 'colsnumber',
				'value'      => array(
					'1'	=> '1',
					'2'	=> '2',
					'3'	=> '3',
					'4'	=> '4',
					'5'	=> '5',
					'6'	=> '6',
				),
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'heading'     => esc_html__( 'Style', 'antomi' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1', 'antomi' )           => 'style1',
					esc_html__( 'Style 2 (demo 4)', 'antomi' )  => 'style2',
				),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Enable slider', 'antomi' ),
				'param_name'  => 'enable_slider',
				'value'       => true,
				'save_always' => true, 
				'group'       => esc_html__( 'Slider Options', 'antomi' ),
			),
			array(
				'type'       => 'dropdown',
				'class'      => '',
				'heading'    => esc_html__( 'Number of rows', 'antomi' ),
				'param_name' => 'rowsnumber',
				'group'      => esc_html__( 'Slider Options', 'antomi' ),
				'value'      => array(
						'1'	=> '1',
						'2'	=> '2',
						'3'	=> '3',
						'4'	=> '4',
					),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: 1200px - 1499px)', 'antomi' ),
				'param_name' => 'items_1200_1499',
				'group'      => esc_html__( 'Slider Options', 'antomi' ),
				'value'      => esc_html__( '3', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 992px - 1199px)', 'antomi' ),
				'param_name' => 'items_992_1199',
				'value'      => esc_html__( '3', 'antomi' ),
				'group'      => esc_html__( 'Slider Options', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 768px - 991px)', 'antomi' ),
				'param_name' => 'items_768_991',
				'value'      => esc_html__( '3', 'antomi' ),
				'group'      => esc_html__( 'Slider Options', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 640px - 767px)', 'antomi' ),
				'param_name' => 'items_640_767',
				'value'      => esc_html__( '2', 'antomi' ),
				'group'      => esc_html__( 'Slider Options', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 480px - 639px)', 'antomi' ),
				'param_name' => 'items_480_639',
				'value'      => esc_html__( '2', 'antomi' ),
				'group'      => esc_html__( 'Slider Options', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: under 479px)', 'antomi' ),
				'param_name' => 'items_0_479',
				'value'      => esc_html__( '1', 'antomi' ),
				'group'      => esc_html__( 'Slider Options', 'antomi' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Navigation', 'antomi' ),
				'param_name'  => 'navigation',
				'save_always' => true,
				'group'       => esc_html__( 'Slider Options', 'antomi' ),
				'value'       => array(
					esc_html__( 'Yes', 'antomi' ) => true,
					esc_html__( 'No', 'antomi' )  => false,
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pagination', 'antomi' ),
				'param_name'  => 'pagination',
				'save_always' => true,
				'group'       => esc_html__( 'Slider Options', 'antomi' ),
				'value'       => array(
					esc_html__( 'No', 'antomi' )  => false,
					esc_html__( 'Yes', 'antomi' ) => true,
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Item Margin (unit: pixel)', 'antomi' ),
				'param_name'  => 'item_margin',
				'value'       => 30,
				'save_always' => true,
				'group'       => esc_html__( 'Slider Options', 'antomi' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Slider speed number (unit: second)', 'antomi' ),
				'param_name'  => 'speed',
				'value'       => '500',
				'save_always' => true,
				'group'       => esc_html__( 'Slider Options', 'antomi' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Slider loop', 'antomi' ),
				'param_name'  => 'loop',
				'value'       => true,
				'group'       => esc_html__( 'Slider Options', 'antomi' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Slider Auto', 'antomi' ),
				'param_name'  => 'auto',
				'value'       => true,
				'group'       => esc_html__( 'Slider Options', 'antomi' ),
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Navigation style', 'antomi' ),
				'param_name'  => 'navigation_style',
				'group'       => esc_html__( 'Slider Options', 'antomi' ),
				'value'       => array(
					esc_html__( 'Navigation center horizontal', 'antomi' )  => 'navigation-style1',
					esc_html__( 'Navigation top-right', 'antomi' )          => 'navigation-style2',
				),
			),
		),
	) );
	//Testimonials
	vc_map( array(
		'name'        => esc_html__( 'Testimonials', 'antomi' ),
		'description' => esc_html__( 'Testimonial slider', 'antomi' ),
		'base'        => 'testimonials',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'antomi'),
		"icon"     	  => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of testimonial', 'antomi' ),
				'param_name' => 'limit',
				'value'      => esc_html__( '10', 'antomi' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Display Author', 'antomi' ),
				'param_name' => 'display_author',
				'value'      => array(
					esc_html__( 'Yes', 'antomi' ) => '1',
					esc_html__( 'No', 'antomi' )	 => '0',
				),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Display Avatar', 'antomi' ),
				'param_name' => 'display_avatar',
				'value'      => array(
					esc_html__( 'Yes', 'antomi' ) => '1',
					esc_html__( 'No', 'antomi' )  => '0',
				),
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Avatar image size', 'antomi' ),
				'param_name'  => 'size',
				'value'       => '150',
				'description' => esc_html__( 'Avatar image size in pixels. Default is 150', 'antomi' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Display URL', 'antomi' ),
				'param_name' => 'display_url',
				'value'      => array(
					esc_html__( 'Yes', 'antomi' ) => '1',
					esc_html__( 'No', 'antomi' )	 => '0',
				),
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Category', 'antomi' ),
				'param_name'  => 'category',
				'value'       => esc_html__( '0', 'antomi' ),
				'description' => esc_html__( 'Slug of the category. Default is 0 : show all testimonials', 'antomi' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Navigation', 'antomi' ),
				'param_name' => 'navigation',
				'value'      => array(
					esc_html__( 'No', 'antomi' )  => false,
					esc_html__( 'Yes', 'antomi' ) => true,
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Pagination', 'antomi' ),
				'param_name' => 'pagination',
				'value'      => array(
					esc_html__( 'Yes', 'antomi' ) => true,
					esc_html__( 'No', 'antomi' )  => false,
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    =>  esc_html__( 'Slider speed number (unit: second)', 'antomi' ),
				'param_name' => 'speed',
				'value'      => '500',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => esc_html__( 'Slider loop', 'antomi' ),
				'param_name' => 'loop',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => esc_html__( 'Slider Auto', 'antomi' ),
				'param_name' => 'auto',
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Style', 'antomi' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1', 'antomi' )                => 'style1',
					esc_html__( 'Style 2 (about page)', 'antomi' )   => 'style-about-page',
				),
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Navigation style', 'antomi' ),
				'param_name'  => 'navigation_style',
				'value'       => array(
					esc_html__( 'Navigation top-right', 'antomi' )          => 'navigation-style1',
					esc_html__( 'Navigation center horizontal', 'antomi' )  => 'navigation-style2',
				),
			),
		),
	) );
	//Counter
	vc_map( array(
		'name'     => esc_html__( 'Counter', 'antomi' ),
		'description' => esc_html__( 'Counter', 'antomi' ),
		'base'     => 'antomi_counter',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'antomi'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'        => 'attach_image',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Image icon', 'antomi' ),
				'param_name'  => 'image',
				'value'       => '',
				'description' => esc_html__( 'Upload icon image', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number', 'antomi' ),
				'param_name' => 'number',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Text', 'antomi' ),
				'param_name' => 'text',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'antomi' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'antomi' )  => 'style1',
				),
			),
		),
	) );
	//Heading title
	vc_map( array(
		'name'     => esc_html__( 'Heading Title', 'antomi' ),
		'description' => esc_html__( 'Heading Title', 'antomi' ),
		'base'     => 'roadthemes_title',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'antomi'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Heading title element', 'antomi' ),
				'param_name' => 'heading_title',
				'value'      => 'Title',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Heading sub-title element', 'antomi' ),
				'param_name' => 'sub_heading_title',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'     => esc_html__( 'Style', 'antomi' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1 (Default)', 'antomi' )             => 'style1',
					esc_html__( 'Style 2 (Footer title)', 'antomi' )        => 'style2',
					esc_html__( 'Style 3 (Demo 3)', 'antomi' )       	   => 'style3',
				),
			),
		),
	) );
	//Countdown
	vc_map( array(
		'name'     => esc_html__( 'Countdown', 'antomi' ),
		'description' => esc_html__( 'Countdown', 'antomi' ),
		'base'     => 'roadthemes_countdown',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'antomi'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'End date (day)', 'antomi' ),
				'param_name' => 'countdown_day',
				'value'      => '1',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'End date (month)', 'antomi' ),
				'param_name' => 'countdown_month',
				'value'      => '1',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'End date (year)', 'antomi' ),
				'param_name' => 'countdown_year',
				'value'      => '2020',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'antomi' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'antomi' )  => 'style1',
				),
			),
		),
	) );
	//Mailchimp newsletter
	vc_map( array(
		'name'     => esc_html__( 'Mailchimp Newsletter', 'antomi' ),
		'description' => esc_html__( 'Mailchimp Newsletter ', 'antomi' ),
		'base'     => 'roadthemes_newsletter',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'antomi'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'        => 'textarea',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Newsletter title', 'antomi' ),
				'param_name'  => 'newsletter_title',
				'value'       => '',
			),
			array(
				'type'        => 'textarea',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Newsletter sub-title', 'antomi' ),
				'param_name'  => 'newsletter_sub_title',
				'value'       => '',
			),
			array(
				'type'        => 'attach_image',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Upload newsletter title image', 'antomi' ),
				'param_name'  => 'newsletter_image',
				'value'       => '',
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Insert id of Mailchimp Form', 'antomi' ),
				'description' => esc_html__( 'See id in admin -> MailChimp for WP -> Form, under the form title', 'antomi' ),
				'param_name'  => 'newsletter_form_id',
				'value'       => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'     => esc_html__( 'Style', 'antomi' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1 (Default)', 'antomi' )    => 'style1',
					esc_html__( 'Style 2', 'antomi' )              => 'style2',
				),
			),
		),
	) );
	//Custom Menu
	$custom_menus = array();
	if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		if ( is_array( $menus ) && ! empty( $menus ) ) {
			foreach ( $menus as $single_menu ) {
				if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->term_id ) ) {
					$custom_menus[ $single_menu->name ] = $single_menu->term_id;
				}
			}
		}
	}
	vc_map( array(
		'name'     => esc_html__( 'Custom Menu', 'antomi' ),
		'description' => esc_html__( 'Custom Menu', 'antomi' ),
		'base'     => 'roadthemes_menu',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'antomi'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Choose Menu', 'antomi' ),
				'param_name'  => 'nav_menu',
				'value'       => $custom_menus,
				'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'antomi' ) : esc_html__( 'Select menu to display.', 'antomi' ),
				'admin_label' => true,
				'save_always' => true,
			),
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload menu icon', 'antomi' ),
				'param_name' => 'menu_image',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Style', 'antomi' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1 (Default)', 'antomi' )    => 'style1',
				),
			),
		),
	) );
	//Policy
	vc_map( array(
		'name'     => esc_html__( 'Policy', 'antomi' ),
		'description' => esc_html__( 'Policy content', 'antomi' ),
		'base'     => 'roadthemes_policy',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'antomi'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload Policy icon', 'antomi' ),
				'param_name' => 'policy_icon',
				'value'      => '',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Policy title', 'antomi' ),
				'param_name' => 'policy_title',
				'value'      => 'Title',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Policy text', 'antomi' ),
				'param_name' => 'policy_text',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'heading'     => esc_html__( 'Style', 'antomi' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1 (Default)', 'antomi' )    => 'style1',
					esc_html__( 'Style 2 (Demo 3+4)', 'antomi' )   => 'style2',
				),
			),
		),
	) );
	//Static block
	vc_map( array(
		'name'     => esc_html__( 'Static block 1', 'antomi' ),
		'description' => esc_html__( 'Static block with link text', 'antomi' ),
		'base'     => 'roadthemes_static_1',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'antomi'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload Static image', 'antomi' ),
				'param_name' => 'static_image',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Static link text', 'antomi' ),
				'param_name' => 'static_link_text',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Static link url', 'antomi' ),
				'param_name' => 'static_link_url',
				'value'      => '',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Static text', 'antomi' ),
				'param_name' => 'static_text',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'heading'     => esc_html__( 'Style', 'antomi' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1 (demo 1 style 1)', 'antomi' )    => 'style1',
				),
			),
		),
	) );
	vc_map( array(
		'name'     => esc_html__( 'Static block 2', 'antomi' ),
		'description' => esc_html__( 'Static block without link text', 'antomi' ),
		'base'     => 'roadthemes_static_2',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'antomi'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload Static image', 'antomi' ),
				'param_name' => 'static_image',
				'value'      => '',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Static title', 'antomi' ),
				'param_name' => 'static_title',
				'value'      => 'Title',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Static text', 'antomi' ),
				'param_name' => 'static_text',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Static link url', 'antomi' ),
				'param_name' => 'static_link_url',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'heading'     => esc_html__( 'Style', 'antomi' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1 (demo 3 style 1)', 'antomi' )    => 'style1',
				),
			),
		),
	) );
}
?>