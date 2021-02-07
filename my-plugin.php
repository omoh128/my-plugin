<?php
/*
  Plugin Name:Omomoh Agiogu
  Description: Links to Author social media profile
  Author: Omomoh Agiogu
 */



class my_Social_Profile widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'my_Social_Profile widget',
                __('Social Networks Profiles', 'translation_domain'), // Name
                array('description' => __('Links to Author social media profile', 'translation_domain'),)
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {

        $title = apply_filters('widget_title', $instance['title']);
        $facebook = $instance['facebook'];
        $instagram = $instance['facebook'];
        $twitter = $instance['twitter'];
        $google = $instance['google'];
        $linkedin = $instance['linkedin'];

        // social profile link
        $facebook_profile = '<a class="facebook" href="' . $facebook . '"><i class="fa fa-facebook"></i></a>';
        $instagram_profile = '<a class="instagram" href="' . $instagram . '"><i class="fa fa-instagram"></i></a>';
        $twitter_profile = '<a class="twitter" href="' . $twitter . '"><i class="fa fa-twitter"></i></a>';
        $google_profile = '<a class="google" href="' . $google . '"><i class="fa fa-google-plus"></i></a>';
        $linkedin_profile = '<a class="linkedin" href="' . $linkedin . '"><i class="fa fa-linkedin"></i></a>';
       

        echo $args['before_widget'];

        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo '<div class="social-icons">';
        echo (!empty($facebook) ) ? $facebook_profile : null;
        echo (!empty($instagram) ) ? $instagram_profile : null;
        echo (!empty($twitter) ) ? $twitter_profile : null;
        echo (!empty($google) ) ? $google_profile : null;
        echo (!empty($linkedin) ) ? $linkedin_profile : null;
        echo '</div>';

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        isset($instance['title']) ? $title = $instance['title'] : null;
        empty($instance['title']) ? $title = 'My Social Profile' : null;

        isset($instance['facebook']) ? $facebook = $instance['facebook'] : null;
        isset($instance['instagram']) ? $instagram = $instance['instagram'] : null;
        isset($instance['twitter']) ? $twitter = $instance['twitter'] : null;
        isset($instance['google']) ? $google = $instance['google'] : null;
        isset($instance['linkedin']) ? $linkedin = $instance['linkedin'] : null;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Instagram'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo esc_attr($instagram); ?>">
        </p>
         
        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('google'); ?>"><?php _e('Google+:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('google'); ?>" name="<?php echo $this->get_field_name('google'); ?>" type="text" value="<?php echo esc_attr($google); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linkedin:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>">
        </p>

        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['facebook'] = (!empty($new_instance['facebook']) ) ? strip_tags($new_instance['facebook']) : '';
        $instance['instagram'] = (!empty($new_instance['instagram']) ) ? strip_tags($new_instance['instagram']) : '';
        $instance['twitter'] = (!empty($new_instance['twitter']) ) ? strip_tags($new_instance['twitter']) : '';
        $instance['google'] = (!empty($new_instance['google']) ) ? strip_tags($new_instance['google']) : '';
        $instance['linkedin'] = (!empty($new_instance['linkedin']) ) ? strip_tags($new_instance['linkedin']) : '';

        return $instance;
    }

}

// register my_Social_Profile widget
function register_my_Social_Profile widget() {
    register_widget('my_Social_Profile widget');
}

add_action('widgets_init', 'register_my_Social_Profile widget');

// enqueue css stylesheet
function my_plugin_widget_css() {
    wp_enqueue_style('social-profile-widget', plugins_url('my-plugin-widget.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'my_plugin_widget_css');