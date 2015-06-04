<?php 
/**
 * Plugin Name:responsive-twitter-widget
 * Plugin URI: https://wordpress.org/plugins/responsive-twitter-widget/
 * Description: A widget that show recent Latest twitter feeds according to widget setting. Actually it is responsive twitter feed Widget. 
 * Version: 1.0
 * Author: engrmostafijur
 * Author URI: http://pixelsolution4it.com/
 *
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if (!defined('PLUGIN_ROOT')) {
	define('PLUGIN_ROOT', dirname(__FILE__) . '/');
	define('PLUGIN_NAME', basename(dirname(__FILE__)) . '/' . basename(__FILE__));
}
add_action( 'widgets_init', 'rtw_responsive_twitter_widget' );
function rtw_responsive_twitter_widget() {
	register_widget( 'pix_responsive_twitter_feed' );
}
class pix_responsive_twitter_feed extends WP_Widget {
	// Initialize the widget
	function pix_responsive_twitter_feed() {
		parent::WP_Widget('pix_responsive_twitter', __('Responsive Twitter Feed','pix_responsive_twitter_feed'), 
			array('description' => __('A widget that show  Latest twitter Feeds', 'pix_responsive_twitter_feed')));  	
	}
    // Widget Form
	function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance['title'] );
			$twitter_username = esc_attr( $instance[ 'twitter_username'] );
			$twitter_id = esc_attr( $instance['twitter_id'] );
			$width = esc_attr( $instance['width'] );
			$height = esc_attr( $instance['height'] );
		}
		?>
		<!-- Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title :', 'pix_responsive_twitter_feed' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"  placeholder="Title here"/>
		</p>
		<!-- Show Widget Title --> 
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_username' ); ?>"><?php _e('User Name :', 'pix_responsive_twitter_feed'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter_username' ); ?>" name="<?php echo $this->get_field_name( 'twitter_username' ); ?>" type="text" value="<?php echo $twitter_username; ?>" placeholder="twitter username here.." />
		</p>
        <!-- Show Twitter Username  --> 
        <p>
            <label for="<?php echo $this->get_field_id( 'twitter_id' ); ?>"><?php _e('Twitter Widget ID :', 'pix_responsive_twitter_feed'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'twitter_id' ); ?>" name="<?php echo $this->get_field_name( 'twitter_id' ); ?>" type="text" value="<?php echo $twitter_id; ?>" placeholder="Twitter widget Id" />
        	<!-- Show Twitter Widget ID --> 
        </p> 
        <p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('width :', 'pix_responsive_twitter_feed'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo $width; ?>" />
		</p>
         <p>
            <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height :', 'pix_responsive_twitter_feed'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
        	<!-- Show height --> 
        </p>        
	<?php
	}
	// Output of the widget
        function widget( $args, $instance ) {
        extract( $args );		
        $title = apply_filters( 'widget_title', $instance['title'] );	
        $username = $instance['twitter_username'];
        $twitter_id = $instance['twitter_id'];	
        $width = $instance['width'];
        $height = $instance['height'];	
        echo $before_widget;      
    ?>    
     <div class="twitter-wrapper">
        <div class="twitter-row">
               <div class="pix-twitter-widget">
			    <h2 class="pix-title"><?php echo $title; ?></h2>
			    <a class="twitter-timeline" href="https://twitter.com/<?php echo $username; ?>" data-widget-id=<?php echo $twitter_id; ?>>Tweets by @ <?php echo $username; ?></a>
			    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
             </div> 
          </div>
     </div>            
    <?php
		// Closing of widget
		echo $after_widget;
	// Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );		
		$instance['twitter_username'] = strip_tags( $new_instance['twitter_username'] );
 	    $instance['twitter_id'] = strip_tags( $new_instance['twitter_id'] );
 	    $instance['width'] = strip_tags( $new_instance['width'] );
 	    $instance['height'] = strip_tags( $new_instance['height'] );
		return $instance;
	}	
  }
}
add_action( 'wp_enqueue_scripts', 'pix_twitter_feed_stylesheet' );
/**
 * Enqueue plugin style-file
 */
function pix_twitter_feed_stylesheet() {
    // Twitter Respects Style.css is relative to the current file
    wp_register_style( 'rtwprefix-style', plugins_url('css/feeds_style.css', __FILE__) );
    wp_enqueue_style( 'rtwprefix-style' );
}
?>
