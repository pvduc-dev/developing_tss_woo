<?php
/**
 * Plugin Name: RoadThemes Helper
 * Plugin URI: http://roadthemes.com/
 * Description: The helper plugin for RoadThemes themes.
 * Version: 1.0.0
 * Author: RoadThemes
 * Author URI: http://roadthemes.com/
 * Text Domain: flaton
 * License: GPL/GNU.
 /*  Copyright 2015  RoadThemes  (email : roadthemez@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if ( file_exists( ABSPATH . 'wp-admin/includes/file.php' ) ) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
}    
require_once('slider-setting.php');
require_once('road-products.php');
//Add less compiler
function compileLessFile($input, $output, $params) {
   require_once( plugin_dir_path( __FILE__ ).'less/lessc.inc.php' );
   
    $less = new lessc;
    $less->setVariables($params);
    //$less->setFormatter("compressed"); // compressed format
    
    // input and output location
    $inputFile = get_template_directory().'/less/'.$input;
    $outputFile = get_template_directory().'/css/'.$output;

    try {
        $less->compileFile($inputFile, $outputFile);
    } catch (Exception $ex) {
        echo "lessphp fatal error: ".$ex->getMessage();
    }
}
function compileChildLessFile($input, $output, $params) {
    require_once( plugin_dir_path( __FILE__ ).'less/lessc.inc.php' );
    $less = new lessc;
    $less->setVariables($params);
    $less->setFormatter("compressed");
    
    // input and output location
    $inputFile = get_stylesheet_directory().'/less/'.$input;
    $outputFile = get_stylesheet_directory().'/css/'.$output;

    try {
        $less->compileFile($inputFile, $outputFile);
    } catch (Exception $ex) {
        echo "lessphp fatal error: ".$ex->getMessage();
    }
}
//Shortcodes 
add_shortcode( 'roadmainmenu', 'antomi_mainmenu_shortcode' );
add_shortcode( 'roadstickymenu', 'antomi_stickymenu_shortcode' );
add_shortcode( 'roadmobilemenu', 'antomi_mobilemenu_shortcode' );
add_shortcode( 'roadcategoriesmenu', 'antomi_roadcategoriesmenu_shortcode' );  
add_shortcode( 'roadminicart', 'antomi_roadminicart_shortcode' );
add_shortcode( 'roadwishlist', 'antomi_roadwishlist_shortcode' );
add_shortcode( 'roadproductssearch', 'antomi_roadproductssearch_shortcode' ); 
add_shortcode( 'roadproductssearchdropdown', 'antomi_roadproductssearchdropdown_shortcode' );
add_shortcode( 'ourbrands', 'antomi_brands_shortcode' );
add_shortcode( 'image_slider', 'antomi_imageslider_shortcode' );
add_shortcode( 'antomi_counter', 'antomi_counter_shortcode' );
add_shortcode( 'popular_categories', 'antomi_popular_categories_shortcode' ); 
add_shortcode( 'latestposts', 'antomi_latestposts_shortcode' );
add_shortcode( 'testimonials', 'antomi_testimonials_shortcode' );
add_shortcode( 'magnifier_image', 'antomi_magnifier_options' );
add_shortcode( 'timesale', 'antomi_timesale_shortcode' );
add_shortcode( 'roadthemes_title', 'antomi_heading_title_shortcode' );
add_shortcode( 'roadthemes_newsletter', 'antomi_newsletter_shortcode' );
add_shortcode( 'roadsocialicons', 'antomi_roadsocialicons_shortcode' );
add_shortcode( 'roadthemes_countdown', 'antomi_countdown_shortcode' );
add_shortcode( 'roadlogo', 'antomi_logo_shortcode' );
add_shortcode( 'roadthemes_menu', 'antomi_roadthemes_menu' );
add_shortcode( 'roadthemes_policy', 'antomi_roadthemes_policy' );
add_shortcode( 'roadthemes_static_1', 'antomi_roadthemes_static_block_1' );
add_shortcode( 'roadthemes_static_2', 'antomi_roadthemes_static_block_2' );
function antomi_blog_sharing() {
    global $post;

    $antomi_opt = get_option( 'antomi_opt' );
    
    $share_url = get_permalink( $post->ID );
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
    $postimg = $large_image_url[0];
    $posttitle = get_the_title( $post->ID );
    ?>
    <div class="widget widget_socialsharing_widget"> 
        <h3 class="widget-title"><?php if(isset($antomi_opt['blog_share_title']) && $antomi_opt['blog_share_title']!='') { echo esc_html($antomi_opt['blog_share_title']); } else { esc_html_e('Share this post', 'antomi'); } ?></h3>
        <ul class="social-icons">
            <li><a class="facebook social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.facebook.com/sharer/sharer.php?u='.$share_url; ?>'); return false;" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter social-icon" href="#" title="Twitter" onclick="javascript: window.open('<?php echo 'https://twitter.com/home?status='.$posttitle.'&nbsp;'.$share_url; ?>'); return false;" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a class="pinterest social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://pinterest.com/pin/create/button/?url='.$share_url.'&amp;media='.$postimg.'&amp;description='.$posttitle; ?>'); return false;" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>
            <li><a class="gplus social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://plus.google.com/share?url='.$share_url; ?>'); return false;" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a></li>
            <li><a class="linkedin social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.linkedin.com/shareArticle?mini=true&amp;url='.$share_url.'&amp;title='.$posttitle; ?>'); return false;" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>
    <?php
}
function antomi_product_sharing() {
    $antomi_opt = get_option( 'antomi_opt' );
    
    if(isset($_POST['data'])) { // for the quickview
        $postid = intval( $_POST['data'] );
    } else {
        $postid = get_the_ID();
    }
    
    $share_url = get_permalink( $postid );

    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'large' );
    $postimg = $large_image_url[0];
    $posttitle = get_the_title( $postid );
    ?>
    <div class="widget widget_socialsharing_widget"> 
        <h3 class="widget-title"><?php if(isset($antomi_opt['product_share_title']) && $antomi_opt['product_share_title']!='') { echo esc_html($antomi_opt['product_share_title']); } else { esc_html_e('Chia sẻ', 'antomi'); } ?></h3>
        <ul class="social-icons">
            <li><a class="facebook social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.facebook.com/sharer/sharer.php?u='.$share_url; ?>'); return false;" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter social-icon" href="#" title="Twitter" onclick="javascript: window.open('<?php echo 'https://twitter.com/home?status='.$posttitle.'&nbsp;'.$share_url; ?>'); return false;" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a class="pinterest social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://pinterest.com/pin/create/button/?url='.$share_url.'&amp;media='.$postimg.'&amp;description='.$posttitle; ?>'); return false;" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>
            <li><a class="gplus social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://plus.google.com/share?url='.$share_url; ?>'); return false;" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a></li>
            <li><a class="linkedin social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.linkedin.com/shareArticle?mini=true&amp;url='.$share_url.'&amp;title='.$posttitle; ?>'); return false;" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>
    <?php
}
add_action( 'add_meta_boxes', 'antomi_add_meta_box');
add_action( 'save_post', 'antomi_save_meta_box_data');
function antomi_meta_box_callback( $post ) {

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
function antomi_custom_sidebar_callback( $post ) {
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

function antomi_add_meta_box() {

    $screens = array( 'post', 'page' );

    foreach ( $screens as $screen ) {
        if($screen == 'post'){
            add_meta_box(
                'antomi_post_intro_section',
                esc_html__( 'Post featured content', 'antomi' ),
                'antomi_meta_box_callback',
                $screen
            );
            add_meta_box(
                'antomi_custom_sidebar',
                esc_html__( 'Custom Sidebar', 'antomi' ),
                'antomi_custom_sidebar_callback',
                $screen
            );
        }
        if($screen == 'page'){
            add_meta_box(
                'antomi_custom_sidebar',
                esc_html__( 'Custom Sidebar', 'antomi' ),
                'antomi_custom_sidebar_callback',
                $screen
            );
        }
    }
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
?>
<?php
class antomi_widgets extends WP_Widget {
    function __construct() {
        parent::__construct(
            'antomi_widgets', 
            esc_html__('Roadthemes Widgets', 'antomi'), 
            // Widget description
            array( 'description' => esc_html__( 'Display recent posts, comments, popular posts', 'antomi' ), ) 
        );
    }
    // Creating widget front-end
    public function widget( $args, $instance ) {
        global $post;
        $antomi_opt = get_option( 'antomi_opt' );
        $title = apply_filters( 'widget_title', $instance['title'] );
        // before and after widget arguments are defined by themes
        echo wp_kses($args['before_widget'], array(
            'aside'=> array(
                'id'=>array(),
                'class'=>array()
            )
        ));
        if ( ! empty( $title ) )
            echo wp_kses($args['before_title'] . $title . $args['after_title'], array(
                'aside'=> array(
                    'id'=>array(),
                    'class'=>array()
                ),
                'h3'=> array(
                    'class'=>array()
                ),
                'span'=> array(
                    'class'=>array()
                )
            ));
        switch ($instance['type']) {
            case 'recent_posts':
                $postargs = array( 'posts_per_page' => $instance['amount'], 'order'=> 'DESC', 'orderby' => 'post_date' );
                $postslist = get_posts( $postargs );
                $thumbsize = explode(',', $instance['size']);
                $thumbsize[0] = (int)$thumbsize[0];
                $thumbsize[1] = (int)$thumbsize[1];
                ?>
                <div class="recent-posts">
                    <ul>
                        <?php
                        foreach ( $postslist as $post ) :
                            setup_postdata( $post ); ?> 
                            <li>
                                <div class="post-wrapper">
                                    <?php if ( has_post_thumbnail( $post->ID ) ) { ?>
                                        <div class="post-thumb">
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumbsize); ?></a>
                                        </div>
                                    <?php } ?>
                                    <div class="post-info">
                                        <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="post-date">
                                            <?php echo get_the_date(); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                </div>
                <?php
                wp_reset_postdata();
            break;
            case 'popular_posts':
                $postargs = array( 'posts_per_page' => $instance['amount'], 'order'=> 'DESC', 'orderby' => 'comment_count' );
                $postslist = get_posts( $postargs );
                $thumbsize = explode(',', $instance['size']);
                $thumbsize[0] = (int)$thumbsize[0];
                $thumbsize[1] = (int)$thumbsize[1];
                ?>
                <div class="recent-posts">
                    <ul>
                        <?php
                        foreach ( $postslist as $post ) :
                            setup_postdata( $post ); ?> 
                            <li>
                                <div class="post-wrapper">
                                    <?php if ( has_post_thumbnail( $post->ID ) ) { ?>
                                        <div class="post-thumb">
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumbsize); ?></a>
                                        </div>
                                    <?php } ?>
                                    <div class="post-info">
                                        <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="post-date">
                                            <?php echo get_the_date(); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                </div>
                <?php
                wp_reset_postdata();
            break;
            case 'recent_comments':
                $thumbsize = explode(',', $instance['size']);
                $thumbsize[0] = (int)$thumbsize[0];
                $commentargs = array(
                    'status' => 'approve',
                    'post_type' => 'post',
                    'number' => $instance['amount']
                );
                $comments = get_comments($commentargs); ?>
                <ul>
                    <?php foreach($comments as $comment) : ?>
                    <li>
                        <div class="post-wrapper">
                            <div class="post-thumb">
                                <?php echo get_avatar( $comment, $thumbsize[0], '', '' ); ?>
                            </div>
                            <div class="post-info">
                                <p><span class="comment-author"><?php echo esc_html($comment->comment_author); ?></span> <?php esc_html_e('says', 'antomi');?>:</p>
                                <a href="<?php echo get_comments_link( $comment->comment_post_ID ); ?>" title="<?php echo esc_attr($comment->comment_author) .' on '. get_the_title( $comment->comment_post_ID );?>"><?php echo antomi_Class::antomi_limitStringByWord($comment->comment_content, 30, '...'); ?></a>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>   
                <?php   
            break;
        }
        echo wp_kses($args['after_widget'], array(
            'aside'=> array(
                'id'=>array(),
                'class'=>array()
            ),
            'h3'=> array(
                'class'=>array()
            ),
            'span'=> array(
                'class'=>array()
            )
        ));
    }
    // Widget Backend 
    public function form( $instance ) {
        // Widget admin form
        if( $instance) {
            $title = $instance[ 'title' ];
            $amount = esc_attr($instance['amount']);
            $size = esc_attr($instance['size']);
            $type = esc_attr($instance['type']);
        } else {
            $title = '';
            $amount = '12';
            $size = '50,50';
            $type = 'recent_posts';
        }
        ?>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'antomi' ); ?></label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'amount' )); ?>"><?php esc_html_e( 'Amount:', 'antomi' ); ?></label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'amount' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'amount' )); ?>" type="text" value="<?php echo esc_attr($amount); ?>" />
        </p>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'size' )); ?>"><?php esc_html_e( 'Image size (example: 50,50):', 'antomi' ); ?></label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'size' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'size' )); ?>" type="text" value="<?php echo esc_attr($size); ?>" />
        </p>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'type' )); ?>"><?php esc_html_e( 'Widget Type:', 'antomi' ); ?></label> 
        <select id="<?php echo esc_attr($this->get_field_id( 'amount' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>">
            <option value="recent_posts" <?php if($type=='recent_posts') echo 'selected="selected"';?>><?php esc_html_e('Recent Posts', 'antomi');?></option>
            <option value="popular_posts" <?php if($type=='popular_posts') echo 'selected="selected"';?>><?php esc_html_e('Popular Posts', 'antomi');?></option>
            <option value="recent_comments" <?php if($type=='recent_comments') echo 'selected="selected"';?>><?php esc_html_e('Recent Comments', 'antomi');?></option>
        </select>
        </p>
    <?php 
    }
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['amount'] = ( ! empty( $new_instance['amount'] ) ) ? strip_tags( $new_instance['amount'] ) : '3';
        $instance['size'] = ( ! empty( $new_instance['size'] ) ) ? strip_tags( $new_instance['size'] ) : '50,50';
        $instance['type'] = ( ! empty( $new_instance['type'] ) ) ? strip_tags( $new_instance['type'] ) : 'recent_posts';
        return $instance;
    }
}
//Override woocommerce widgets
function antomi_override_woocommerce_widgets() {
    //Show mini cart on all pages
    if ( class_exists( 'WC_Widget_Cart' ) && file_exists(get_template_directory().'/woocommerce/class-wc-widget-cart.php')) {
        unregister_widget( 'WC_Widget_Cart' ); 
        include_once( get_template_directory().'/woocommerce/class-wc-widget-cart.php' );
        register_widget( 'Custom_WC_Widget_Cart' );
    }
}
add_action( 'widgets_init', 'antomi_override_woocommerce_widgets' );
// Register and load the widget
function antomitheme_load_antomi_widgets() {
    register_widget( 'antomi_widgets' );
}
add_action( 'widgets_init', 'antomitheme_load_antomi_widgets' );