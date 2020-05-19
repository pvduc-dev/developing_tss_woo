<?php 

if( ! function_exists( 'road_get_slider_setting' ) ) {
	function road_get_slider_setting() {
		return array(
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Style', 'antomi' ),
				'param_name'  => 'style',
				'value'       => array(
					__( 'Grid view (default)', 'antomi' )                    => 'product-grid',
					__( 'Grid view 2 (product bg 2 (Demo 2))', 'antomi' )=> 'product-grid-2',
					__( 'List view 1', 'antomi' )                  => 'product-list',
					__( 'Grid view with countdown', 'antomi' )     => 'product-grid-countdown',
				),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Enable slider', 'antomi' ),
				'description' => __( 'If slider is enabled, the "column" ins General group is the number of rows ', 'antomi' ),
				'param_name'  => 'enable_slider',
				'value'       => true,
				'save_always' => true, 
				'group'       => __( 'Slider Options', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'heading'    => __( 'Number of columns (screen: over 1500px)', 'antomi' ),
				'param_name' => 'items_1500up',
				'group'      => __( 'Slider Options', 'antomi' ),
				'value'      => esc_html__( '4', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 1200px - 1499px)', 'antomi' ),
				'param_name' => 'items_1200_1499',
				'group'      => __( 'Slider Options', 'antomi' ),
				'value'      => esc_html__( '4', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 992px - 1199px)', 'antomi' ),
				'param_name' => 'items_992_1199',
				'group'      => __( 'Slider Options', 'antomi' ),
				'value'      => esc_html__( '4', 'antomi' ),
			), 
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 768px - 991px)', 'antomi' ),
				'param_name' => 'items_768_991',
				'group'      => __( 'Slider Options', 'antomi' ),
				'value'      => esc_html__( '3', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 640px - 767px)', 'antomi' ),
				'param_name' => 'items_640_767',
				'group'      => __( 'Slider Options', 'antomi' ),
				'value'      => esc_html__( '2', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: 480px - 639px)', 'antomi' ),
				'param_name' => 'items_480_639',
				'group'      => __( 'Slider Options', 'antomi' ),
				'value'      => esc_html__( '2', 'antomi' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Number of columns (screen: under 479px)', 'antomi' ),
				'param_name' => 'items_0_479',
				'group'      => __( 'Slider Options', 'antomi' ),
				'value'      => esc_html__( '1', 'antomi' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Navigation', 'antomi' ),
				'param_name'  => 'navigation',
				'save_always' => true,
				'group'       => __( 'Slider Options', 'antomi' ),
				'value'       => array(
					__( 'Yes', 'antomi' ) => true,
					__( 'No', 'antomi' )  => false,
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Pagination', 'antomi' ),
				'param_name'  => 'pagination',
				'save_always' => true,
				'group'       => __( 'Slider Options', 'antomi' ),
				'value'       => array(
					__( 'No', 'antomi' )  => false,
					__( 'Yes', 'antomi' ) => true,
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Item Margin (unit: pixel)', 'antomi' ),
				'param_name'  => 'item_margin',
				'value'       => 30,
				'save_always' => true,
				'group'       => __( 'Slider Options', 'antomi' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Slider speed number (unit: second)', 'antomi' ),
				'param_name'  => 'speed',
				'value'       => '500',
				'save_always' => true,
				'group'       => __( 'Slider Options', 'antomi' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Slider loop', 'antomi' ),
				'param_name'  => 'loop',
				'value'       => true,
				'group'       => __( 'Slider Options', 'antomi' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Slider Auto', 'antomi' ),
				'param_name'  => 'auto',
				'value'       => true,
				'group'       => __( 'Slider Options', 'antomi' ),
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Navigation style', 'antomi' ),
				'param_name'  => 'navigation_style',
				'group'       => __( 'Slider Options', 'antomi' ),
				'value'       => array(
					'Navigation center horizontal'	=> 'navigation-style1',
					'Navigation top right'	        => 'navigation-style2',
					'Navigation left bottom (demo3)'=> 'navigation-style3',
				),
			),
		);
	}
}