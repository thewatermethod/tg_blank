<?php
/*
* Plugin Name: TG Facebook Widget
* Plugin URI: http://www.whalingcityweb.com/facebook-widget
* Description: A widget that allows you to add an Facebook feed to the sidebar
* Version: 1.0
* Author: Matt Bevilacqua
* Author URI: http://www.whalingcityweb.com
* License: GPL2
*/
/**
 * Register the Widget
 */
add_action( 'widgets_init', create_function( '', 'register_widget("tg_facebook_widget");' ) );

class tg_facebook_widget extends WP_Widget
{
    /**
     * Constructor
     **/
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'tg_facebook_widget',
            'description' => 'Widget that shows custom button link.'
        );

        parent::__construct( 'tg_facebook_widget', 'TG Facebook', $widget_ops );

    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    public function widget( $args, $instance )
    {
        echo $args['before_widget'];
        
        $before_title = $args['before_title'];
        $after_title = $args['after_title'];
       
        if ( ! empty ($instance['fb_user']) ) {
            $n = $instance['fb_user'];
            $fb_url = 'https://www.facebook.com/' .  $instance['fb_user'];
		} else {
            $n = 'allgodlesshere';	
            $fb_url = 'https://www.facebook.com/allgodlesshere';
		}
        		
		if ( ! empty( $instance['title'] ) ) {
			echo $before_title . '<a href="'. $fb_url.'">' . apply_filters( 'widget_title', $instance['title'] ). '</a>' . $after_title;
		}

		if ( ! empty ($instance['fb_limit']) ) {
			$limit = $instance['fb_limit'];
		} else {
			$limit = 5;	
		}


        if ( false === ( $fb = get_transient( 'tgfbstatus' ) ) ) {
            $fb_raw = wp_remote_get("https://graph.facebook.com/".$n."/posts?fields=object_id,message,description,full_picture,link&access_token=1015681298515127|A4MKF3y_zdRjVCQswAP1T-rEv64");
            $fb_body = json_decode($fb_raw['body']);
            $fb = $fb_body->data;          
            set_transient( 'tgfbstatus', $fb, 12 * HOUR_IN_SECONDS );
        }

		echo "<ul class='fb-feed'>";
        
        for ($i=0; $i < $limit ; $i++) { 	
			if (array_key_exists('message', $fb[$i])) {
				$mes = $fb[$i]->message;
			} else {
				$mes = '';
			}
			
			if (array_key_exists('description', $fb[$i])) {
				$alt = $fb[$i]->description;
			} else {
				$alt = '';
			}
			
			if( array_key_exists('object_id', $fb[$i])) { 
				$pic = "<img src='".$fb[$i]->full_picture."' alt='".$alt."' class='fb-img'/>";
			} else {
				$pic = '';
			}
			
			if ( strlen($mes) > 200) {
				$fbmsg = substr($fb[$i]->message, 0, 200) . "...";
			} else {
				$fbmsg = $mes;
			}

			$fblink = $fb[$i]->link;

			echo "<li>" . $pic . '' .$fbmsg . "<br/><br/><a target='blank' href='" . $fblink . "' class='callout'>Read Full Post</a></li>"; 

		}

		echo "</ul>";

		echo $args['after_widget'];
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    public function update( $new_instance, $old_instance ) {

        delete_transient( 'tgfbstatus' );
        // update logic goes here
        $updated_instance = $new_instance;
        return $updated_instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void
     **/
    public function form( $instance )
    {
        $i = '';
        $l = '';

        $title = __('TG Facebook');
        if(isset($instance['title']))
        {
            $title = $instance['title'];
        }
		if(isset($instance['fb_user']))
        {
            $i = $instance['fb_user'];
        }
		if(isset($instance['fb_limit']))
        {
            $l = $instance['fb_limit'];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'fb_user' ); ?>"><?php _e( 'Facebook User ID:' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'fb_user' ); ?>" name="<?php echo $this->get_field_name( 'fb_user' ); ?>" value="<?php echo esc_attr( $i ); ?>"/>
        	<br/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'fb_limit' ); ?>"><?php _e( '# of posts to show:' ); ?></label>
            <input type="number" class="widefat" id="<?php echo $this->get_field_id( 'fb_limit' ); ?>" name="<?php echo $this->get_field_name( 'fb_limit' ); ?>" value="<?php echo esc_attr( $l ); ?>" oninput="maxLengthCheck(this)" min="1" max="9" />
        	<br/><small>Pick a number between 1-9.</small>
        </p>
    <?php
    }
}