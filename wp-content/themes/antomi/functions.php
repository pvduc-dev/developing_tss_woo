<?php
/**
 * Antomi functions and definitions
 */
/**
* Require files
*/
	//TGM-Plugin-Activation
require_once( get_template_directory().'/class-tgm-plugin-activation.php' );
	//Init the Redux Framework
if ( class_exists( 'ReduxFramework' ) && !isset( $redux_demo ) && file_exists( get_template_directory().'/theme-config.php' ) ) {
	require_once( get_template_directory().'/theme-config.php' );
}
	// Theme files
if ( file_exists( get_template_directory().'/include/wooajax.php' ) ) {
	require_once( get_template_directory().'/include/wooajax.php' );
}
if ( file_exists( get_template_directory().'/include/map_shortcodes.php' ) ) {
	require_once( get_template_directory().'/include/map_shortcodes.php' );
}
if ( file_exists( get_template_directory().'/include/shortcodes.php' ) ) {
	require_once( get_template_directory().'/include/shortcodes.php' );
}
define('PLUGIN_REQUIRED_PATH','http://roadthemes.com/plugins');
Class Antomi_Class {
	/**
	* Global values
	*/
	static function antomi_post_odd_event(){
		global $wp_session;
		if(!isset($wp_session["antomi_postcount"])){
			$wp_session["antomi_postcount"] = 0;
		}
		$wp_session["antomi_postcount"] = 1 - $wp_session["antomi_postcount"];
		return $wp_session["antomi_postcount"];
	}
	static function antomi_post_thumbnail_size($size){
		global $wp_session;
		if($size!=''){
			$wp_session["antomi_postthumb"] = $size;
		}
		return $wp_session["antomi_postthumb"];
	}
	static function antomi_shop_class($class){
		global $wp_session;
		if($class!=''){
			$wp_session["antomi_shopclass"] = $class;
		}
		return $wp_session["antomi_shopclass"];
	}
	static function antomi_show_view_mode(){
		$antomi_opt = get_option( 'antomi_opt' );
		$antomi_viewmode = 'grid-view';
		if(isset($antomi_opt['default_view'])) {
			$antomi_viewmode = $antomi_opt['default_view'];
		}
		if(isset($_GET['view']) && $_GET['view']!=''){
			$antomi_viewmode = $_GET['view'];
		}
		return $antomi_viewmode;
	}
	static function antomi_shortcode_products_count(){
		global $wp_session;
		$antomi_productsfound = 0;
		if(isset($wp_session["antomi_productsfound"])){
			$antomi_productsfound = $wp_session["antomi_productsfound"];
		}
		return $antomi_productsfound;
	}
	/**
	* Constructor
	*/
	function __construct() {
		// Register action/filter callbacks
			//WooCommerce - action/filter
		add_theme_support( 'woocommerce' );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
		add_filter( 'get_product_search_form', array($this, 'antomi_woo_search_form'));
		add_filter( 'woocommerce_shortcode_products_query', array($this, 'antomi_woocommerce_shortcode_count'));
		add_action( 'woocommerce_share', array($this, 'antomi_woocommerce_social_share'), 35 );
		add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
		    return array(
		        'width'  => 150,
		        'height' => 150,
		        'crop'   => 1,
		    );
		} );
			//move message to top
		remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
		add_action( 'woocommerce_show_message', 'wc_print_notices', 10 );
			//remove add to cart button after item
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			//Single product organize
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			//remove cart total under cross sell
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
		add_action( 'cart_totals', 'woocommerce_cart_totals', 5 );
			//Theme actions
		add_action( 'after_setup_theme', array($this, 'antomi_setup'));
		add_action( 'tgmpa_register', array($this, 'antomi_register_required_plugins'));
		add_action( 'wp_enqueue_scripts', array($this, 'antomi_scripts_styles') );
		add_action( 'wp_head', array($this, 'antomi_custom_code_header'));
		add_action( 'widgets_init', array($this, 'antomi_widgets_init'));
		add_action( 'save_post', array($this, 'antomi_save_meta_box_data'));
		add_action('comment_form_before_fields', array($this, 'antomi_before_comment_fields'));
		add_action('comment_form_after_fields', array($this, 'antomi_after_comment_fields'));
		add_action( 'customize_register', array($this, 'antomi_customize_register'));
		add_action( 'customize_preview_init', array($this, 'antomi_customize_preview_js'));
		add_action('admin_enqueue_scripts', array($this, 'antomi_admin_style'));
			//Theme filters
		add_filter( 'loop_shop_per_page', array($this, 'antomi_woo_change_per_page'), 20 );
		add_filter( 'woocommerce_output_related_products_args', array($this, 'antomi_woo_related_products_limit'));
		add_filter( 'get_search_form', array($this, 'antomi_search_form'));
		add_filter('excerpt_more', array($this, 'antomi_new_excerpt_more'));
		add_filter( 'excerpt_length', array($this, 'antomi_change_excerpt_length'), 999 );
		add_filter('wp_nav_menu_objects', array($this, 'antomi_first_and_last_menu_class'));
		add_filter( 'wp_page_menu_args', array($this, 'antomi_page_menu_args'));
		add_filter('dynamic_sidebar_params', array($this, 'antomi_widget_first_last_class'));
		add_filter('dynamic_sidebar_params', array($this, 'antomi_mega_menu_widget_change'));
		add_filter( 'dynamic_sidebar_params', array($this, 'antomi_put_widget_content'));
		add_filter( 'the_content_more_link', array($this, 'antomi_modify_read_more_link'));
		//Adding theme support
		if ( ! isset( $content_width ) ) {
			$content_width = 625;
		}
	}
	/**
	* Filter callbacks
	* ----------------
	*/
	// read more link 
	function antomi_modify_read_more_link() {
		$antomi_opt = get_option( 'antomi_opt' );
		if(isset($antomi_opt['readmore_text']) && $antomi_opt['readmore_text'] != ''){
			$readmore_text = esc_html($antomi_opt['readmore_text']);
		} else { 
			$readmore_text = esc_html('Read more','antomi');
		};
	    return '<div class="readmore-wrapper"><a class="readmore" href="'. get_permalink().' ">'.$readmore_text.'</a></div>';
	}
	// Change products per page
	function antomi_woo_change_per_page() {
		$antomi_opt = get_option( 'antomi_opt' );
		return $antomi_opt['product_per_page'];
	}
	//Change number of related products on product page. Set your own value for 'posts_per_page'
	function antomi_woo_related_products_limit( $args ) {
		global $product;
		$antomi_opt = get_option( 'antomi_opt' );
		$args['posts_per_page'] = $antomi_opt['related_amount'];
		return $args;
	}
	// Count number of products from shortcode
	function antomi_woocommerce_shortcode_count( $args ) {
		$antomi_productsfound = new WP_Query($args);
		$antomi_productsfound = $antomi_productsfound->post_count;
		global $wp_session;
		$wp_session["antomi_productsfound"] = $antomi_productsfound;
		return $args;
	}
	//Change search form
	function antomi_search_form( $form ) {
		if(get_search_query()!=''){
			$search_str = get_search_query();
		} else {
			$search_str = esc_html__( 'Search... ', 'antomi' );
		}
		$form = '<form role="search" method="get" class="searchform blogsearchform" action="' . esc_url(home_url( '/' ) ). '" >
		<div class="form-input">
			<input type="text" placeholder="'.esc_attr($search_str).'" name="s" class="input_text ws">
			<button class="button-search searchsubmit blogsearchsubmit" type="submit">' . esc_html__('Search', 'antomi') . '</button>
			<input type="hidden" name="post_type" value="post" />
			</div>
		</form>';
		return $form;
	}
	//Change woocommerce search form
	function antomi_woo_search_form( $form ) {
		global $wpdb;
		if(get_search_query()!=''){
			$search_str = get_search_query();
		} else {
			$search_str = 'Tìm kiếm sản phẩm ...';
		}
		$form = '<form role="search" method="get" class="searchform productsearchform" action="'.esc_url( home_url( '/'  ) ).'">';
			$form .= '<div class="form-input">';
				$form .= '<input type="text" placeholder="'.esc_attr($search_str).'" name="s" class="ws"/>';
				$form .= '<button class="button-search searchsubmit productsearchsubmit" type="submit"> Tìm kiếm </button>';
				$form .= '<input type="hidden" name="post_type" value="product" />';
			$form .= '</div>';
		$form .= '</form>';
		return $form;
	}
	// Replaces the excerpt "more" text by a link
	function antomi_new_excerpt_more($more) {
		return '';
	}
	//Change excerpt length
	function antomi_change_excerpt_length( $length ) {
		$antomi_opt = get_option( 'antomi_opt' );
		if(isset($antomi_opt['excerpt_length'])){
			return $antomi_opt['excerpt_length'];
		}
		return 50;
	}
	//Add 'first, last' class to menu
	function antomi_first_and_last_menu_class($items) {
		$items[1]->classes[] = 'first';
		$items[count($items)]->classes[] = 'last';
		return $items;
	}
	/**
	 * Filter the page menu arguments.
	 *
	 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
	 *
	 * @since Antomi 1.0
	 */
	function antomi_page_menu_args( $args ) {
		if ( ! isset( $args['show_home'] ) )
			$args['show_home'] = true;
		return $args;
	}
	//Add first, last class to widgets
	function antomi_widget_first_last_class($params) {
		global $my_widget_num;
		$class = '';
		$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
		$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	
		if(!$my_widget_num) {// If the counter array doesn't exist, create it
			$my_widget_num = array();
		}
		if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
			return $params; // No widgets in this sidebar... bail early.
		}
		if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
			$my_widget_num[$this_id] ++;
		} else { // If not, create it starting with 1
			$my_widget_num[$this_id] = 1;
		}
		if($my_widget_num[$this_id] == 1) { // If this is the first widget
			$class .= ' widget-first ';
		} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
			$class .= ' widget-last ';
		}
		$params[0]['before_widget'] = str_replace('first_last', ' '.$class.' ', $params[0]['before_widget']);
		return $params;
	}
	//Change mega menu widget from div to li tag
	function antomi_mega_menu_widget_change($params) {
		$sidebar_id = $params[0]['id'];
		$pos = strpos($sidebar_id, '_menu_widgets_area_');
		if ( !$pos == false ) {
			$params[0]['before_widget'] = '<li class="widget_mega_menu">'.$params[0]['before_widget'];
			$params[0]['after_widget'] = $params[0]['after_widget'].'</li>';
		}
		return $params;
	}
	// Push sidebar widget content into a div
	function antomi_put_widget_content( $params ) {
		global $wp_registered_widgets;
		if( $params[0]['id']=='sidebar-category' ){
			$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
			$settings = $settings_getter->get_settings();
			$settings = $settings[ $params[1]['number'] ];
			if($params[0]['widget_name']=="Text" && isset($settings['title']) && $settings['text']=="") { // if text widget and no content => don't push content
				return $params;
			}
			if( isset($settings['title']) && $settings['title']!='' ){
				$params[0][ 'after_title' ] .= '<div class="widget_content">';
				$params[0][ 'after_widget' ] = '</div>'.$params[0][ 'after_widget' ];
			} else {
				$params[0][ 'before_widget' ] .= '<div class="widget_content">';
				$params[0][ 'after_widget' ] = '</div>'.$params[0][ 'after_widget' ];
			}
		}
		return $params;
	}
	/**
	* Action hooks
	* ----------------
	*/
	/**
	 * Antomi setup.
	 *
	 * Sets up theme defaults and registers the various WordPress features that
	 * Antomi supports.
	 *
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses add_editor_style() To add a Visual Editor stylesheet.
	 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
	 * 	custom background, and post formats.
	 * @uses register_nav_menu() To add support for navigation menus.
	 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
	 *
	 * @since Antomi 1.0
	 */
	function antomi_setup() {
		/*
		 * Makes Antomi available for translation.
		 *
		 * Translations can be added to the /languages/ directory.
		 * If you're building a theme based on Antomi, use a find and replace
		 * to change 'antomi' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'antomi', get_template_directory() . '/languages' );
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		// This theme supports a variety of post formats.
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );
		// Register menus
		register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'antomi' ) );
		register_nav_menu( 'stickymenu', esc_html__( 'Sticky Menu', 'antomi' ) );
		register_nav_menu( 'mobilemenu', esc_html__( 'Mobile Menu', 'antomi' ) );
		register_nav_menu( 'categories', esc_html__( 'Categories Menu', 'antomi' ) );
		/*
		 * This theme supports custom background color and image,
		 * and here we also set up the default background color.
		 */
		add_theme_support( 'custom-background', array(
			'default-color' => 'e6e6e6',
		) );
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		// This theme uses a custom image size for featured images, displayed on "standard" posts.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1170, 9999 ); // Unlimited height, soft crop
		add_image_size( 'antomi-category-thumb', 360, 240, true ); // (cropped) (post carousel)
		add_image_size( 'antomi-post-thumb', 700, 495, true ); // (cropped) (blog sidebar)
		add_image_size( 'antomi-post-thumbwide', 1170, 700, true ); // (cropped) (blog large img)
	}
	//Display social sharing on product page
	function antomi_woocommerce_social_share(){
		$antomi_opt = get_option( 'antomi_opt' );
	?>
		<?php if (isset($antomi_opt['share_code']) && $antomi_opt['share_code']!='') { ?>
			<div class="share_buttons">
				<?php 
					echo wp_kses($antomi_opt['share_code'], array(
						'div' => array(
							'class' => array()
						),
						'span' => array(
							'class' => array(),
							'displayText' => array()
						),
					));
				?>
			</div>
		<?php } ?>
	<?php
	}
	/**
	 * Enqueue scripts and styles for front-end.
	 *
	 * @since Antomi 1.0
	 */
	function antomi_scripts_styles() {
		global $wp_styles, $wp_scripts;
		$antomi_opt = get_option( 'antomi_opt' );
		/*
		 * Adds JavaScript to pages with the comment form to support
		 * sites with threaded comments (when in use).
		*/
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
		// Add Bootstrap JavaScript
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.1.1', true );
		// Add Owl files
		wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '2.3.4', true );
		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), '2.3.4' );
		// Add Chosen js files
		wp_enqueue_script( 'chosen', get_template_directory_uri() . '/js/chosen/chosen.jquery.min.js', array('jquery'), '1.3.0', true );
		wp_enqueue_script( 'chosenproto', get_template_directory_uri() . '/js/chosen/chosen.proto.min.js', array('jquery'), '1.3.0', true );
		wp_enqueue_style( 'chosen', get_template_directory_uri() . '/js/chosen/chosen.min.css', array(), '1.3.0' );
		// Add parallax script files
		//Superfish
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish/superfish.min.js', array('jquery'), '1.3.15', true );
		//Add Shuffle js
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.min.js', array('jquery'), '2.6.2', true );
		wp_enqueue_script( 'shuffle', get_template_directory_uri() . '/js/jquery.shuffle.min.js', array('jquery'), '3.0.0', true );
		//Add mousewheel
		wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel.min.js', array('jquery'), '3.1.12', true );
		// Add jQuery countdown file
		wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/jquery.countdown.min.js', array('jquery'), '2.0.4', true );
		// Add jQuery counter files
		wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'counterup', get_template_directory_uri() . '/js/jquery.counterup.min.js', array('jquery'), '1.0', true );
		// Add variables.js file
		wp_enqueue_script( 'variables', get_template_directory_uri() . '/js/variables.js', array('jquery'), '20140826', true );
		// Add theme-antomi.js file
		wp_enqueue_script( 'antomi-theme', get_template_directory_uri() . '/js/theme-antomi.js', array('jquery'), '20140826', true );
		wp_localize_script('antomi-theme', 'antomi_countdown_vars', array(
				'day'    => esc_html__( 'Days', 'antomi' ),
				'hour'   => esc_html__( 'Hours', 'antomi' ),
				'min'    => esc_html__( 'Mins', 'antomi' ),
				'sec'    => esc_html__( 'Secs', 'antomi' ),
			)
		);
		wp_localize_script('antomi-theme', 'antomi_nav_text', array(
				'pre'    => esc_html__( 'Prev', 'antomi' ),
				'next'   => esc_html__( 'Next', 'antomi' ),
			)
		);
		$font_url = $this->antomi_get_font_url();
		if ( ! empty( $font_url ) )
			wp_enqueue_style( 'antomi-fonts', esc_url_raw( $font_url ), array(), null );
		// Loads our main stylesheet.
		wp_enqueue_style( 'antomi-style', get_stylesheet_uri() );
		// Mega Main Menu
		wp_enqueue_style( 'megamenu', get_template_directory_uri() . '/css/megamenu_style.css', array(), '2.0.4' );
		// Load fontawesome css
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0' );
		// Load Plaza icon css
		wp_enqueue_style( 'plaza-icons', get_template_directory_uri() . '/css/plaza-icon.css', array(), null );
		// Load bootstrap css
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.1' );
		// Compile Less to CSS
		$previewpreset = (isset($_REQUEST['preset']) ? $_REQUEST['preset'] : null);
			//get preset from url (only for demo/preview)
		if($previewpreset){
			$_SESSION["preset"] = $previewpreset;
		}
		$presetopt = 1; /*change default preset 1 and 209-binhthuongg*/
		if(!isset($_SESSION["preset"])){
			$_SESSION["preset"] = 1;
		}
		if($_SESSION["preset"] != 1) {
			$presetopt = $_SESSION["preset"];
		} else { /* if no preset varialbe found in url, use from theme options */
			if(isset($antomi_opt['preset_option'])){
				$presetopt = $antomi_opt['preset_option'];
			}
		}
		if(!isset($presetopt)) $presetopt = 1; /* in case first time install theme, no options found */
		if(isset($antomi_opt['enable_less'])){
			if($antomi_opt['enable_less']){
				$themevariables = array(
					'product_bg'                     => $antomi_opt['product_bg'],
					'product_name_color'             => $antomi_opt['product_name_color'],
					
					'body_font'                      => $antomi_opt['bodyfont']['font-family'],
					'text_color'                     => $antomi_opt['bodyfont']['color'],
					'text_selected_bg'               => $antomi_opt['text_selected_bg'],
					'text_selected_color'            => $antomi_opt['text_selected_color'],
					'text_size'                      => $antomi_opt['bodyfont']['font-size'],
					'border_color'                   => $antomi_opt['border_color']['border-color'],
					'page_content_background'        => $antomi_opt['page_content_background']['background-color'],
					'row_space'                      => $antomi_opt['row_space'],
					'carousel_topright_position'     => $antomi_opt['carousel_topright_position'],
					'heading_font'                   => $antomi_opt['headingfont']['font-family'],
					'heading_color'                  => $antomi_opt['headingfont']['color'],
					'heading_font_weight'            => $antomi_opt['headingfont']['font-weight'],
					'dropdown_font'                  => $antomi_opt['dropdownfont']['font-family'],
					'dropdown_color'                 => $antomi_opt['dropdownfont']['color'],
					'dropdown_font_size'             => $antomi_opt['dropdownfont']['font-size'],
					'dropdown_font_weight'           => $antomi_opt['dropdownfont']['font-weight'],
					'dropdown_bg'                    => $antomi_opt['dropdown_bg'],
					'menu_font'                      => $antomi_opt['menufont']['font-family'],
					'menu_color'                     => $antomi_opt['menufont']['color'],
					'menu_font_size'                 => $antomi_opt['menufont']['font-size'],
					'menu_font_weight'               => $antomi_opt['menufont']['font-weight'],
					'sub_menu_font'                  => $antomi_opt['submenufont']['font-family'],
					'sub_menu_color'                 => $antomi_opt['submenufont']['color'],
					'sub_menu_font_size'             => $antomi_opt['submenufont']['font-size'],
					'sub_menu_font_weight'           => $antomi_opt['submenufont']['font-weight'],
					'sub_menu_bg'                    => $antomi_opt['sub_menu_bg'],
					'categories_font'                => $antomi_opt['categoriesfont']['font-family'],
					'categories_font_size'           => $antomi_opt['categoriesfont']['font-size'],
					'categories_font_weight'         => $antomi_opt['categoriesfont']['font-weight'],
					'categories_color'               => $antomi_opt['categoriesfont']['color'],
					'categories_menu_label_bg'       => $antomi_opt['categories_menu_label_bg'],
					'categories_menu_bg'             => $antomi_opt['categories_menu_bg'],
					'categories_sub_menu_font'       => $antomi_opt['categoriessubmenufont']['font-family'],
					'categories_sub_menu_font_size'  => $antomi_opt['categoriessubmenufont']['font-size'],
					'categories_sub_menu_font_weight'=> $antomi_opt['categoriessubmenufont']['font-weight'],
					'categories_sub_menu_color'      => $antomi_opt['categoriessubmenufont']['color'],
					'categories_sub_menu_bg'         => $antomi_opt['categories_sub_menu_bg'],
					'link_color'                     => $antomi_opt['link_color']['regular'],
					'link_hover_color'               => $antomi_opt['link_color']['hover'],
					'link_active_color'              => $antomi_opt['link_color']['active'],
					'primary_color'                  => $antomi_opt['primary_color'],
					'sale_color'                     => $antomi_opt['sale_color'],
					'saletext_color'                 => $antomi_opt['saletext_color'],
					'rate_color'                     => $antomi_opt['rate_color'],
					'price_font'                     => $antomi_opt['pricefont']['font-family'],
					'price_color'                    => $antomi_opt['pricefont']['color'],
					'price_font_size'                => $antomi_opt['pricefont']['font-size'],
					'price_font_weight'              => $antomi_opt['pricefont']['font-weight'],
					'topbar_color'                   => $antomi_opt['topbar_color'],
					'topbar_link_color'              => $antomi_opt['topbar_link_color']['regular'],
					'topbar_link_hover_color'        => $antomi_opt['topbar_link_color']['hover'],
					'topbar_link_active_color'       => $antomi_opt['topbar_link_color']['active'],
					'header_bg'                      => $antomi_opt['header_bg'],
					'header_color'                   => $antomi_opt['header_color'],
					'header_link_color'              => $antomi_opt['header_link_color']['regular'],
					'header_link_hover_color'        => $antomi_opt['header_link_color']['hover'],
					'header_link_active_color'       => $antomi_opt['header_link_color']['active'],
					'footer_bg'                      => $antomi_opt['footer_bg'],
					'footer_color'                   => $antomi_opt['footer_color'],
					'footer_link_color'              => $antomi_opt['footer_link_color']['regular'],
					'footer_link_hover_color'        => $antomi_opt['footer_link_color']['hover'],
					'footer_link_active_color'       => $antomi_opt['footer_link_color']['active'],
				);
				if(isset($antomi_opt['header_sticky_bg']['rgba']) && $antomi_opt['header_sticky_bg']['rgba']!="") {
					$themevariables['header_sticky_bg'] = $antomi_opt['header_sticky_bg']['rgba'];
				} else {
					$themevariables['header_sticky_bg'] = 'rgba(255, 255, 255, 0.95)';
				}
				switch ($presetopt) {
					case 2:
					break;
					case 3:
						
					break;
					case 4:
						$themevariables['header_bg'] = '#232f3e';
						$themevariables['header_color'] = '#ffffff';
						$themevariables['header_link_color'] = '#ffffff';
						$themevariables['header_link_hover_color'] = '#c40316';
						$themevariables['header_link_active_color'] = '#c40316';

						$themevariables['topbar_color'] = '#ffffff';
						$themevariables['topbar_link_color'] = '#ffffff';
						$themevariables['topbar_link_hover_color'] = '#c40316';
						$themevariables['topbar_link_active_color'] = '#c40316';

						$themevariables['menu_color'] = '#ffffff';

						$themevariables['header_sticky_bg'] = 'rgba(35, 47, 62, 0.95)';
					break;
				}
				if(function_exists('compileLessFile')){
					compileLessFile('theme.less', 'theme'.$presetopt.'.css', $themevariables);
				}
			}
		}
		// Load main theme css style files
		wp_enqueue_style( 'antomi-theme', get_template_directory_uri() . '/css/theme'.$presetopt.'.css', array('bootstrap'), null );
		wp_enqueue_style( 'antomi-custom', get_template_directory_uri() . '/css/opt_css.css', array('antomi-theme'), null );
		if(function_exists('WP_Filesystem')){
			if ( ! WP_Filesystem() ) {
				$url = wp_nonce_url();
				request_filesystem_credentials($url, '', true, false, null);
			}
			global $wp_filesystem;
			//add custom css, sharing code to header
			if($wp_filesystem->exists(get_template_directory(). '/css/opt_css.css')){
				$customcss = $wp_filesystem->get_contents(get_template_directory(). '/css/opt_css.css');
				if(isset($antomi_opt['custom_css']) && $customcss!=$antomi_opt['custom_css']){ //if new update, write file content
					$wp_filesystem->put_contents(
						get_template_directory(). '/css/opt_css.css',
						$antomi_opt['custom_css'],
						FS_CHMOD_FILE // predefined mode settings for WP files
					);
				}
			} else {
				$wp_filesystem->put_contents(
					get_template_directory(). '/css/opt_css.css',
					$antomi_opt['custom_css'],
					FS_CHMOD_FILE // predefined mode settings for WP files
				);
			}
		}
		//add javascript variables
		ob_start(); ?>
		"use strict";
		var antomi_brandnumber = <?php if(isset($antomi_opt['brandnumber'])) { echo esc_js($antomi_opt['brandnumber']); } else { echo '6'; } ?>,
			antomi_brandscrollnumber = <?php if(isset($antomi_opt['brandscrollnumber'])) { echo esc_js($antomi_opt['brandscrollnumber']); } else { echo '2';} ?>,
			antomi_brandpause = <?php if(isset($antomi_opt['brandpause'])) { echo esc_js($antomi_opt['brandpause']); } else { echo '3000'; } ?>,
			antomi_brandanimate = <?php if(isset($antomi_opt['brandanimate'])) { echo esc_js($antomi_opt['brandanimate']); } else { echo '700';} ?>;
		var antomi_brandscroll = false;
			<?php if(isset($antomi_opt['brandscroll'])){ ?>
				antomi_brandscroll = <?php echo esc_js($antomi_opt['brandscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var antomi_categoriesnumber = <?php if(isset($antomi_opt['categoriesnumber'])) { echo esc_js($antomi_opt['categoriesnumber']); } else { echo '6'; } ?>,
			antomi_categoriesscrollnumber = <?php if(isset($antomi_opt['categoriesscrollnumber'])) { echo esc_js($antomi_opt['categoriesscrollnumber']); } else { echo '2';} ?>,
			antomi_categoriespause = <?php if(isset($antomi_opt['categoriespause'])) { echo esc_js($antomi_opt['categoriespause']); } else { echo '3000'; } ?>,
			antomi_categoriesanimate = <?php if(isset($antomi_opt['categoriesanimate'])) { echo esc_js($antomi_opt['categoriesanimate']); } else { echo '700';} ?>;
		var antomi_categoriesscroll = 'false';
			<?php if(isset($antomi_opt['categoriesscroll'])){ ?>
				antomi_categoriesscroll = <?php echo esc_js($antomi_opt['categoriesscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var antomi_blogpause = <?php if(isset($antomi_opt['blogpause'])) { echo esc_js($antomi_opt['blogpause']); } else { echo '3000'; } ?>,
			antomi_bloganimate = <?php if(isset($antomi_opt['bloganimate'])) { echo esc_js($antomi_opt['bloganimate']); } else { echo '700'; } ?>;
		var antomi_blogscroll = false;
			<?php if(isset($antomi_opt['blogscroll'])){ ?>
				antomi_blogscroll = <?php echo esc_js($antomi_opt['blogscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var antomi_testipause = <?php if(isset($antomi_opt['testipause'])) { echo esc_js($antomi_opt['testipause']); } else { echo '3000'; } ?>,
			antomi_testianimate = <?php if(isset($antomi_opt['testianimate'])) { echo esc_js($antomi_opt['testianimate']); } else { echo '700'; } ?>;
		var antomi_testiscroll = false;
			<?php if(isset($antomi_opt['testiscroll'])){ ?>
				antomi_testiscroll = <?php echo esc_js($antomi_opt['testiscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var antomi_catenumber = <?php if(isset($antomi_opt['catenumber'])) { echo esc_js($antomi_opt['catenumber']); } else { echo '6'; } ?>,
			antomi_catescrollnumber = <?php if(isset($antomi_opt['catescrollnumber'])) { echo esc_js($antomi_opt['catescrollnumber']); } else { echo '2';} ?>,
			antomi_catepause = <?php if(isset($antomi_opt['catepause'])) { echo esc_js($antomi_opt['catepause']); } else { echo '3000'; } ?>,
			antomi_cateanimate = <?php if(isset($antomi_opt['cateanimate'])) { echo esc_js($antomi_opt['cateanimate']); } else { echo '700';} ?>;
		var antomi_catescroll = false;
			<?php if(isset($antomi_opt['catescroll'])){ ?>
				antomi_catescroll = <?php echo esc_js($antomi_opt['catescroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var antomi_menu_number = <?php if(isset($antomi_opt['categories_menu_items'])) { echo esc_js((int)$antomi_opt['categories_menu_items']); } else { echo '9';} ?>;
		var antomi_sticky_header = false;
			<?php if(isset($antomi_opt['sticky_header'])){ ?>
				antomi_sticky_header = <?php echo esc_js($antomi_opt['sticky_header'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		jQuery(document).ready(function(){
			jQuery(".ws").on('focus', function(){
				if(jQuery(this).val()=="<?php esc_html__( 'Search product...', 'antomi' );?>"){
					jQuery(this).val("");
				}
			});
			jQuery(".ws").on('focusout', function(){
				if(jQuery(this).val()==""){
					jQuery(this).val("<?php esc_html__( 'Search product...', 'antomi' );?>");
				}
			});
			jQuery(".wsearchsubmit").on('click', function(){
				if(jQuery("#ws").val()=="<?php esc_html__( 'Search product...', 'antomi' );?>" || jQuery("#ws").val()==""){
					jQuery("#ws").focus();
					return false;
				}
			});
			jQuery(".search_input").on('focus', function(){
				if(jQuery(this).val()=="<?php esc_html__( 'Search...', 'antomi' );?>"){
					jQuery(this).val("");
				}
			});
			jQuery(".search_input").on('focusout', function(){
				if(jQuery(this).val()==""){
					jQuery(this).val("<?php esc_html__( 'Search...', 'antomi' );?>");
				}
			});
			jQuery(".blogsearchsubmit").on('click', function(){
				if(jQuery("#search_input").val()=="<?php esc_html__( 'Search...', 'antomi' );?>" || jQuery("#search_input").val()==""){
					jQuery("#search_input").focus();
					return false;
				}
			});
		});
		<?php
		$jsvars = ob_get_contents();
		$jsvars = preg_replace( '/\s*/m', '', $jsvars);
		$jsvars = str_replace( 'var', 'var ', $jsvars);
		ob_end_clean();
		if(function_exists('WP_Filesystem')){
			if($wp_filesystem->exists(get_template_directory(). '/js/variables.js')){
				$jsvariables = $wp_filesystem->get_contents(get_template_directory(). '/js/variables.js');
				if($jsvars!=$jsvariables){ //if new update, write file content
					$wp_filesystem->put_contents(
						get_template_directory(). '/js/variables.js',
						$jsvars,
						FS_CHMOD_FILE // predefined mode settings for WP files
					);
				}
			} else {
				$wp_filesystem->put_contents(
					get_template_directory(). '/js/variables.js',
					$jsvars,
					FS_CHMOD_FILE // predefined mode settings for WP files
				);
			}
		}
		//add css for footer, header templates
		$jscomposer_templates_args = array(
			'orderby'          => 'title',
			'order'            => 'ASC',
			'post_type'        => 'templatera',
			'post_status'      => 'publish',
			'posts_per_page'   => 30,
		);
		$jscomposer_templates = get_posts( $jscomposer_templates_args );
		if(count($jscomposer_templates) > 0) {
			foreach($jscomposer_templates as $jscomposer_template){
				$jscomposer_template_css = get_post_meta ( $jscomposer_template->ID, '_wpb_shortcodes_custom_css', false );
				if(isset($jscomposer_template_css[0]))
				wp_add_inline_style( 'antomi-custom', $jscomposer_template_css[0] );
			}
		}
		//page width
		$antomi_opt = get_option( 'antomi_opt' );
		if(isset($antomi_opt['box_layout_width'])){
			wp_add_inline_style( 'antomi-custom', '.wrapper.box-layout {max-width: '.$antomi_opt['box_layout_width'].'px;}' );
		}
	}
	//add sharing code to header
	function antomi_custom_code_header() {
		global $antomi_opt;
		if ( isset($antomi_opt['share_head_code']) && $antomi_opt['share_head_code']!='') {
			echo wp_kses($antomi_opt['share_head_code'], array(
				'script' => array(
					'type' => array(),
					'src' => array(),
					'async' => array()
				),
			));
		}
	}
	/**
	 * Register sidebars.
	 *
	 * Registers our main widget area and the front page widget areas.
	 *
	 * @since Antomi 1.0
	 */
	function antomi_widgets_init() {
		$antomi_opt = get_option( 'antomi_opt' );
		register_sidebar( array(
			'name' => esc_html__( 'Blog Sidebar', 'antomi' ),
			'id' => 'sidebar-1',
			'description' => esc_html__( 'Sidebar on blog page', 'antomi' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		register_sidebar( array(
			'name' => esc_html__( 'Shop Sidebar', 'antomi' ),
			'id' => 'sidebar-shop',
			'description' => esc_html__( 'Sidebar on shop page (only sidebar shop layout)', 'antomi' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		register_sidebar( array(
			'name' => esc_html__( 'Single product Sidebar', 'antomi' ),
			'id' => 'sidebar-single_product',
			'description' => esc_html__( 'Sidebar on product details page', 'antomi' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		register_sidebar( array(
			'name' => esc_html__( 'Pages Sidebar', 'antomi' ),
			'id' => 'sidebar-page',
			'description' => esc_html__( 'Sidebar on content pages', 'antomi' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		if(isset($antomi_opt['custom-sidebars']) && $antomi_opt['custom-sidebars']!=""){
			foreach($antomi_opt['custom-sidebars'] as $sidebar){
				$sidebar_id = str_replace(' ', '-', strtolower($sidebar));
				if($sidebar_id!='') {
					register_sidebar( array(
						'name' => $sidebar,
						'id' => $sidebar_id,
						'description' => $sidebar,
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget' => '</aside>',
						'before_title' => '<h3 class="widget-title"><span>',
						'after_title' => '</span></h3>',
					) );
				}
			}
		}
	}
	static function antomi_meta_box_callback( $post ) {
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'antomi_meta_box', 'antomi_meta_box_nonce' );
		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		$value = get_post_meta( $post->ID, '_antomi_post_intro', true );
		echo '<label for="antomi_post_intro">';
		esc_html_e( 'This content will be used to replace the featured image, use shortcode here', 'antomi' );
		echo '</label><br />';
		wp_editor( $value, 'antomi_post_intro', $settings = array() );
	}
	static function antomi_custom_sidebar_callback( $post ) {
		global $wp_registered_sidebars;
		$antomi_opt = get_option( 'antomi_opt' );
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'antomi_meta_box', 'antomi_meta_box_nonce' );
		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		//show sidebar dropdown select
		$csidebar = get_post_meta( $post->ID, '_antomi_custom_sidebar', true );
		echo '<label for="antomi_custom_sidebar">';
		esc_html_e( 'Select a custom sidebar for this post/page', 'antomi' );
		echo '</label><br />';
		echo '<select id="antomi_custom_sidebar" name="antomi_custom_sidebar">';
			echo '<option value="">'.esc_html__('- None -', 'antomi').'</option>';
			foreach($wp_registered_sidebars as $sidebar){
				$sidebar_id = $sidebar['id'];
				if($csidebar == $sidebar_id){
					echo '<option value="'.$sidebar_id.'" selected="selected">'.$sidebar['name'].'</option>';
				} else {
					echo '<option value="'.$sidebar_id.'">'.$sidebar['name'].'</option>';
				}
			}
		echo '</select><br />';
		//show custom sidebar position
		$csidebarpos = get_post_meta( $post->ID, '_antomi_custom_sidebar_pos', true );
		echo '<label for="antomi_custom_sidebar_pos">';
		esc_html_e( 'Sidebar position', 'antomi' );
		echo '</label><br />';
		echo '<select id="antomi_custom_sidebar_pos" name="antomi_custom_sidebar_pos">'; ?>
			<option value="left" <?php if($csidebarpos == 'left') {echo 'selected="selected"';}?>><?php echo esc_html__('Left', 'antomi'); ?></option>
			<option value="right" <?php if($csidebarpos == 'right') {echo 'selected="selected"';}?>><?php echo esc_html__('Right', 'antomi'); ?></option>
		<?php echo '</select>';
	}
	function antomi_save_meta_box_data( $post_id ) {
		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */
		// Check if our nonce is set.
		if ( ! isset( $_POST['antomi_meta_box_nonce'] ) ) {
			return;
		}
		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['antomi_meta_box_nonce'], 'antomi_meta_box' ) ) {
			return;
		}
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}
		/* OK, it's safe for us to save the data now. */
		// Make sure that it is set.
		if ( ! ( isset( $_POST['antomi_post_intro'] ) || isset( $_POST['antomi_custom_sidebar'] ) ) )  {
			return;
		}
		// Sanitize user input.
		$my_data = sanitize_text_field( $_POST['antomi_post_intro'] );
		// Update the meta field in the database.
		update_post_meta( $post_id, '_antomi_post_intro', $my_data );
		// Sanitize user input.
		$my_data = sanitize_text_field( $_POST['antomi_custom_sidebar'] );
		// Update the meta field in the database.
		update_post_meta( $post_id, '_antomi_custom_sidebar', $my_data );
		// Sanitize user input.
		$my_data = sanitize_text_field( $_POST['antomi_custom_sidebar_pos'] );
		// Update the meta field in the database.
		update_post_meta( $post_id, '_antomi_custom_sidebar_pos', $my_data );
	}
	//Change comment form
	function antomi_before_comment_fields() {
		echo '<div class="comment-input">';
	}
	function antomi_after_comment_fields() {
		echo '</div>';
	}
	/**
	 * Register postMessage support.
	 *
	 * Add postMessage support for site title and description for the Customizer.
	 *
	 * @since Antomi 1.0
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer object.
	 */
	function antomi_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
	/**
	 * Enqueue Javascript postMessage handlers for the Customizer.
	 *
	 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
	 *
	 * @since Antomi 1.0
	 */
	function antomi_customize_preview_js() {
		wp_enqueue_script( 'antomi-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
	}
	function antomi_admin_style() {
	  wp_enqueue_style('antomi-admin-styles', get_template_directory_uri().'/css/admin.css');
	}
	/**
	* Utility methods
	* ---------------
	*/
	//Add breadcrumbs
	static function antomi_breadcrumb() {
		global $post;
		$antomi_opt = get_option( 'antomi_opt' );
		$brseparator = '<span class="separator">/</span>';
		if (!is_home()) {
			echo '<div class="breadcrumbs">';
			echo '<a href="';
			echo esc_url( home_url( '/' ));
			echo '">';
			echo esc_html__('Home', 'antomi');
			echo '</a>'.$brseparator;
			if (is_category() || is_single()) {
				if( is_category() ) {
	                single_term_title();
	            } elseif (is_single() ) {
					$categories = get_the_category();
					if ( count( $categories ) > 0 ) { 
						echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>'.$brseparator; 
					}
					the_title();
				}
			} elseif (is_page()) {
				if($post->post_parent){
					$anc = get_post_ancestors( $post->ID );
					$title = get_the_title();
					foreach ( $anc as $ancestor ) {
						$output = '<a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a>'.$brseparator;
					}
					echo wp_kses($output, array(
							'a'=>array(
								'href' => array(),
								'title' => array(),
							),
							'span'=>array(
								'class'=>array(),
							)
						)
					);
					echo '<span title="'.esc_attr($title).'"> '.esc_html($title).'</span>';
				} else {
					echo '<span> '.get_the_title().'</span>';
				}
			}
			elseif (is_tag()) {single_tag_title();}
			elseif (is_day()) {printf( esc_html__( 'Archive for: %s', 'antomi' ), '<span>' . get_the_date() . '</span>' );}
			elseif (is_month()) {printf( esc_html__( 'Archive for: %s', 'antomi' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'antomi' ) ) . '</span>' );}
			elseif (is_year()) {printf( esc_html__( 'Archive for: %s', 'antomi' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'antomi' ) ) . '</span>' );}
			elseif (is_author()) {echo "<span>".esc_html__('Archive for','antomi'); echo'</span>';}
			elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<span>".esc_html__('Blog Archives','antomi'); echo'</span>';}
			elseif (is_search()) {echo "<span>".esc_html__('Search Results','antomi'); echo'</span>';}
			echo '</div>';
		} else {
			echo '<div class="breadcrumbs">';
			echo '<a href="';
			echo esc_url( home_url( '/' ) );
			echo '">';
			echo esc_html__('Home', 'antomi');
			echo '</a>'.$brseparator;
			if(isset($antomi_opt['blog_header_text']) && $antomi_opt['blog_header_text']!=""){
				echo esc_html($antomi_opt['blog_header_text']);
			} else {
				echo esc_html__('Blog', 'antomi');
			}
			echo '</div>';
		}
	}
	static function antomi_limitStringByWord ($string, $maxlength, $suffix = '') {
		if(function_exists( 'mb_strlen' )) {
			// use multibyte functions by Iysov
			if(mb_strlen( $string )<=$maxlength) return $string;
			$string = mb_substr( $string, 0, $maxlength );
			$index = mb_strrpos( $string, ' ' );
			if($index === FALSE) {
				return $string;
			} else {
				return mb_substr( $string, 0, $index ).$suffix;
			}
		} else {
			if(strlen( $string )<=$maxlength) return $string;
			$string = substr( $string, 0, $maxlength );
			$index = strrpos( $string, ' ' );
			if($index === FALSE) {
				return $string;
			} else {
				return substr( $string, 0, $index ).$suffix;
			}
		}
	}
	static function antomi_excerpt_by_id($post, $length = 25, $tags = '<a><span><em><strong>') {
		if ( is_numeric( $post ) ) {
			$post = get_post( $post );
		} elseif( ! is_object( $post ) ) {
			return false;
		}
		if ( has_excerpt( $post->ID ) ) {
			$the_excerpt = $post->post_excerpt;
			return apply_filters( 'the_content', $the_excerpt );
		} else {
			$the_excerpt = $post->post_content;
		}

		$the_excerpt = strip_shortcodes( strip_tags( $the_excerpt, $tags ) );
		$the_excerpt = preg_split( '/\b/', $the_excerpt, $length * 2 + 1 );
		$excerpt_waste = array_pop( $the_excerpt );
		$the_excerpt = implode( $the_excerpt );
		return apply_filters( 'the_content', $the_excerpt );
	}
	/**
	 * Return the Google font stylesheet URL if available.
	 *
	 * The use of Work Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 *
	 * @since Antomi 1.2
	 *
	 * @return string Font stylesheet or empty string if disabled.
	 */
	function antomi_get_font_url() {
		$fonts_url = '';

		/* Translators: If there are characters in your language that are not
		* supported by Rubik, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$rubik = _x( 'on', 'Rubik font: on or off', 'antomi' );
		 
		if ( 'off' !== $rubik ) {
			$font_families[] = 'Rubik:400,500,600,700,900';
		}
		 
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		 
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		 
		return esc_url_raw( $fonts_url );
	}
	/**
	 * Displays navigation to next/previous pages when applicable.
	 *
	 * @since Antomi 1.0
	 */
	static function antomi_content_nav( $html_id ) {
		global $wp_query;
		$html_id = esc_attr( $html_id );
		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav id="<?php echo esc_attr($html_id); ?>" class="navigation" role="navigation">
				<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'antomi' ); ?></h3>
				<div class="nav-previous"><?php next_posts_link( wp_kses(__( '<span class="meta-nav">&larr;</span> Older posts', 'antomi' ),array('span'=>array('class'=>array())) )); ?></div>
				<div class="nav-next"><?php previous_posts_link( wp_kses(__( 'Newer posts <span class="meta-nav">&rarr;</span>', 'antomi' ), array('span'=>array('class'=>array())) )); ?></div>
			</nav>
		<?php endif;
	}
	/* Pagination */
	static function antomi_pagination() {
		global $wp_query, $paged;
		if(empty($paged)) $paged = 1;
		$pages = $wp_query->max_num_pages;
			if(!$pages || $pages == '') {
			   	$pages = 1;
			}
		if(1 != $pages) {
			echo '<div class="pagination">';
			$big = 999999999; // need an unlikely integer
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'prev_text'    => esc_html__('Previous', 'antomi'),
				'next_text'    =>esc_html__('Next', 'antomi')
			) );
			echo '</div>';
		}
	}
	/**
	 * Template for comments and pingbacks.
	 *
	 * To override this walker in a child theme without modifying the comments template
	 * simply create your own antomi_comment(), and that function will be used instead.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Antomi 1.0
	 */
	static function antomi_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php esc_html_e( 'Pingback:', 'antomi' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'antomi' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
			// Proceed with normal comments.
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<div class="comment-avatar">
					<?php echo get_avatar( $comment, 50 ); ?>
				</div>
				<div class="comment-info">
					<header class="comment-meta comment-author vcard">
						<?php
							printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
								get_comment_author_link(),
								// If current post author is also comment author, make it known visually.
								( $comment->user_id === $post->post_author ) ? '<span>' . esc_html__( 'Post author', 'antomi' ) . '</span>' : ''
							);
							printf( '<time datetime="%1$s">%2$s</time>',
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( esc_html__( '%1$s at %2$s', 'antomi' ), get_comment_date(), get_comment_time() )
							);
						?>
						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'antomi' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div><!-- .reply -->
					</header><!-- .comment-meta -->
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'antomi' ); ?></p>
					<?php endif; ?>
					<section class="comment-content comment">
						<?php comment_text(); ?>
						<?php edit_comment_link( esc_html__( 'Edit', 'antomi' ), '<p class="edit-link">', '</p>' ); ?>
					</section><!-- .comment-content -->
				</div>
			</article><!-- #comment-## -->
		<?php
			break;
		endswitch; // end comment_type check
	}
	/**
	 * Set up post entry meta.
	 *
	 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
	 *
	 * Create your own antomi_entry_meta() to override in a child theme.
	 *
	 * @since Antomi 1.0
	 */
	static function antomi_entry_meta() {
		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', ', ' );
		$num_comments = (int)get_comments_number();
		$write_comments = '';
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = esc_html__('0 comments', 'antomi');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . esc_html__(' comments', 'antomi');
			} else {
				$comments = esc_html__('1 comment', 'antomi');
			}
			$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
		}
		$utility_text = null;
		if ( ( post_password_required() || !comments_open() ) && ($tag_list != false && isset($tag_list) ) ) {
			$utility_text = '<span class="meta-title">' . esc_html__( 'Tags:','antomi') . '</span>' . esc_html__('%2$s', 'antomi' );
		} elseif ( $tag_list != false && isset($tag_list) && $num_comments != 0 ) {
			$utility_text = esc_html__( '%1$s', 'antomi' ) . ' / ' .'<span class="meta-title">' . esc_html__( 'Tags:','antomi') . '</span>' . esc_html__('%2$s', 'antomi' );
		} elseif ( ($num_comments == 0 || !isset($num_comments) ) && $tag_list==true ) {
			$utility_text = '<span class="meta-title">' . esc_html__( 'Tags:','antomi') . '</span>' . esc_html__('%2$s', 'antomi' );
		} else {
			$utility_text = esc_html__( '%1$s', 'antomi' );
		}
		if ( ($tag_list != false && isset($tag_list)) || $num_comments != 0 ) { ?>
			<div class="entry-meta">
				<?php printf( $utility_text, $write_comments, $tag_list); ?>
			</div>
		<?php }
	}
	static function antomi_entry_meta_small() {
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list(', ');
		$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( wp_kses(__( 'View all posts by %s', 'antomi' ), array('a'=>array())), get_the_author() ) ),
			get_the_author()
		);
		$utility_text = esc_html__( 'Posted by %1$s / %2$s', 'antomi' );
		printf( $utility_text, $author, $categories_list );
	}
	static function antomi_entry_comments() {
		$date = sprintf( '<time class="entry-date" datetime="%3$s">%4$s</time>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
		$num_comments = (int)get_comments_number();
		$write_comments = '';
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = wp_kses(__('<span>0</span> comments', 'antomi'), array('span'=>array()));
			} elseif ( $num_comments > 1 ) {
				$comments = '<span>'.$num_comments .'</span>'. esc_html__(' comments', 'antomi');
			} else {
				$comments = wp_kses(__('<span>1</span> comment', 'antomi'), array('span'=>array()));
			}
			$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
		}
		$utility_text = esc_html__( '%1$s', 'antomi' );
		printf( $utility_text, $write_comments );
	}
	/**
	* TGM-Plugin-Activation
	*/
	function antomi_register_required_plugins() {
		$plugins = array(
			array(
				'name'               => esc_html__('RoadThemes Helper', 'antomi'),
				'slug'               => 'roadthemes-helper',
				'source'             => get_template_directory() . '/plugins/roadthemes-helper.zip',
				'required'           => true,
				'version'            => '1.0.0',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => '',
			),
			array(
				'name'               => esc_html__('Mega Main Menu', 'antomi'),
				'slug'               => 'mega_main_menu',
				'source'             => PLUGIN_REQUIRED_PATH . '/mega_main_menu.zip',
				'required'           => true,
				'external_url'       => '',
			),
			array(
				'name'               => esc_html__('Import Sample Data', 'antomi'),
				'slug'               => 'road-importdata',
				'source'             => get_template_directory() . '/plugins/road-importdata.zip',
				'required'           => true,
				'external_url'       => '',
			),
			array(
				'name'               => esc_html__('Revolution Slider', 'antomi'),
				'slug'               => 'revslider',
				'source'             => PLUGIN_REQUIRED_PATH . '/revslider.zip',
				'required'           => true,
				'external_url'       => '',
			),
			array(
				'name'               => esc_html__('WPBakery Page Builder', 'antomi'),
				'slug'               => 'js_composer',
				'source'             => PLUGIN_REQUIRED_PATH . '/js_composer.zip',
				'required'           => true,
				'external_url'       => '',
			),
			array(
				'name'               => esc_html__('Templatera', 'antomi'),
				'slug'               => 'templatera',
				'source'             => PLUGIN_REQUIRED_PATH . '/templatera.zip',
				'required'           => true,
				'external_url'       => '',
			),
			array(
				'name'      => esc_html__('Testimonials', 'antomi'),
				'slug'      => 'testimonials-by-woothemes',
				'source'             => PLUGIN_REQUIRED_PATH . '/testimonials-by-woothemes.zip',
				'required'  => true,
			),
			// Plugins from the WordPress Plugin Repository.
			array(
				'name'               => esc_html__('Redux Framework', 'antomi'),
				'slug'               => 'redux-framework',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'      => esc_html__('Contact Form 7', 'antomi'),
				'slug'      => 'contact-form-7',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('MailChimp for WordPress', 'antomi'),
				'slug'      => 'mailchimp-for-wp',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('Regenerate Thumbnails', 'antomi'),
				'slug'      => 'regenerate-thumbnails',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('Simple Local Avatars', 'antomi'),
				'slug'      => 'simple-local-avatars',
				'required'  => false,
			), 
			array(
				'name'      => esc_html__('TinyMCE Advanced', 'antomi'),
				'slug'      => 'tinymce-advanced',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('Widget Importer & Exporter', 'antomi'),
				'slug'      => 'widget-importer-exporter',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('WooCommerce', 'antomi'),
				'slug'      => 'woocommerce',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('YITH WooCommerce Compare', 'antomi'),
				'slug'      => 'yith-woocommerce-compare',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('YITH WooCommerce Wishlist', 'antomi'),
				'slug'      => 'yith-woocommerce-wishlist',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('YITH WooCommerce Zoom Magnifier', 'antomi'),
				'slug'      => 'yith-woocommerce-zoom-magnifier',
				'required'  => false,
			),
		);
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'default_path' => '',                      // Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'antomi' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'antomi' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'antomi' ), // %s = plugin name.
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'antomi' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'antomi' ), // %1$s = plugin name(s).
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'antomi' ), // %1$s = plugin name(s).
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'antomi' ), // %1$s = plugin name(s).
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'antomi' ), // %1$s = plugin name(s).
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'antomi' ), // %1$s = plugin name(s).
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'antomi' ), // %1$s = plugin name(s).
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'antomi' ), // %1$s = plugin name(s).
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'antomi' ), // %1$s = plugin name(s).
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'antomi' ),
				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'antomi' ),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'antomi' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'antomi' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'antomi' ), // %s = dashboard link.
				'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);
		tgmpa( $plugins, $config );
	}
}
// Instantiate theme
$Antomi_Class = new Antomi_Class();
//Fix duplicate id of mega menu
function antomi_mega_menu_id_change($params) {
	ob_start('antomi_mega_menu_id_change_call_back');
}
function antomi_mega_menu_id_change_call_back($html){
	$html = preg_replace('/id="mega_main_menu"/', 'id="mega_main_menu_first"', $html, 1);
	$html = preg_replace('/id="mega_main_menu_ul"/', 'id="mega_main_menu_ul_first"', $html, 1);
	return $html;
}
add_action('wp_loaded', 'antomi_mega_menu_id_change');
function theme_prefix_enqueue_script() {
	wp_add_inline_script( 'antomi-theme', 'var ajaxurl = "'.admin_url('admin-ajax.php').'";','before' );
}
add_action( 'wp_enqueue_scripts', 'theme_prefix_enqueue_script' );
// Wishlist count
if( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ){
function yith_wcwl_ajax_update_count(){
wp_send_json( array(
'count' => yith_wcwl_count_all_products()
) );
}
add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}