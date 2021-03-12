<?php
add_action( 'widgets_init', 'tz_homepageintroductoryimages_widgets' );

/* -- Register widget -- */
function tz_homepageintroductoryimages_widgets() { register_widget( 'TZ_homepageintroductoryimages_widget' ); }

/* -- Widget class -- */
class tz_homepageintroductoryimages_widget extends WP_Widget {

    /* -- Widget setup -- */
    function TZ_homepageintroductoryimages_widget() {

        /* -- Create the widget -- */
        $this->WP_Widget( 'tz_homepageintroductoryimages_widget', 'Homepage Introductory Images', $widget_ops, $control_ops );
    }

    /* -- Display widget -- */
    function widget( $args, $instance ) {
        extract( $args );

        /* -- Our variables from the widget settings -- */
        $title1 = apply_filters('title1', $instance['title1'] );
        $subtitle1 = apply_filters('subtitle1', $instance['subtitle1'] );
        $link1 = apply_filters('link1', $instance['link1'] );
        $image1 = apply_filters('image1', $instance['image1'] );

        $title2 = apply_filters('title2', $instance['title2'] );
        $subtitle2 = apply_filters('subtitle2', $instance['subtitle2'] );
        $link2 = apply_filters('link2', $instance['link2'] );
        $image2 = apply_filters('image2', $instance['image2'] );

        $title3 = apply_filters('title3', $instance['title3'] );
        $subtitle3 = apply_filters('subtitle3', $instance['subtitle3'] );
        $link3 = apply_filters('link3', $instance['link3'] );
        $image3 = apply_filters('image3', $instance['image3'] );

        echo $before_widget;
        ?>
        <div class="data data-one">
            <?php if($link1!=""){?><a href="<?php echo $link1;?>"><?php }?>
                <img src="<?php echo $image1;?>" alt="" /><?php if($link1!=""){?></a><?php }?>
            <?php if($link1!=""){?><a href="<?php echo $link1;?>"><?php }?><h2><?php echo $title1;?></h2><?php if($link1!=""){?></a><?php }?>
            <p><?php echo $subtitle1;?></p>
        </div>

        <div class="data data-two">
            <?php if($link2!=""){?><a href="<?php echo $link2;?>"><?php }?>
                <img src="<?php echo $image2;?>" alt="" /><?php if($link2!=""){?></a><?php }?>
            <?php if($link2!=""){?><a href="<?php echo $link2;?>"><?php }?><h2><?php echo $title2;?></h2><?php if($link2!=""){?></a><?php }?>
            <p><?php echo $subtitle2;?></p>
        </div>

        <div class="data data-three">
            <?php if($link3!=""){?><a href="<?php echo $link3;?>"><?php }?><img src="<?php echo $image3;?>" alt="" /><?php if($link3!=""){?></a><?php }?>
            <?php if($link3!=""){?><a href="<?php echo $link3;?>"><?php }?><h2><?php echo $title3;?></h2><?php if($link3!=""){?></a><?php }?>
            <p><?php echo $subtitle3;?></p>
        </div>

        <?php
        echo $after_widget;
    }

    /* -- Update widget -- */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title1'] =  $new_instance['title1'] ;
        $instance['subtitle1'] =  $new_instance['subtitle1'] ;
        $instance['link1'] =  $new_instance['link1'] ;
        $instance['image1'] =  $new_instance['image1'] ;

        $instance['title2'] =  $new_instance['title2'] ;
        $instance['subtitle2'] =  $new_instance['subtitle2'] ;
        $instance['link2'] =  $new_instance['link2'] ;
        $instance['image2'] =  $new_instance['image2'] ;

        $instance['title3'] =  $new_instance['title3'] ;
        $instance['subtitle3'] =  $new_instance['subtitle3'] ;
        $instance['link3'] =  $new_instance['link3'] ;
        $instance['image3'] =  $new_instance['image3'] ;
        return $instance;
    }

    /* -- Widget settings -- */
    function form( $instance ) {
        $defaults = array(
            'title1' => '',
            'subtitle1' => '',
            'link1' => '',
            'image1' => '',

            'title2' => '',
            'subtitle2' => '',
            'link2' => '',
            'image2' => '',

            'title3' => '',
            'subtitle3' => '',
            'link3' => '',
            'image3' => ''
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Title -->
        <strong>Image 1:</strong>
        <p>
            <label for="<?php echo $this->get_field_id( 'title1' ); ?>"><?php _e('Title 1:', 'framework') ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'title1' ); ?>" name="<?php echo $this->get_field_name( 'title1' ); ?>" value="<?php echo $instance['title1'];?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'subtitle1' ); ?>"><?php _e('Sub Title 1:', 'framework') ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'subtitle1' ); ?>" name="<?php echo $this->get_field_name( 'subtitle1' ); ?>" value="<?php echo $instance['subtitle1'];?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e('Link 1:', 'framework') ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'link1' ); ?>" name="<?php echo $this->get_field_name( 'link1' ); ?>" value="<?php echo $instance['link1'];?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'image1' ); ?>"><?php _e('Image 1:', 'framework') ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'image1' ); ?>" name="<?php echo $this->get_field_name( 'image1' ); ?>" value="<?php echo $instance['image1'];?>">
        </p>


        <strong>Image 2:</strong>
        <p>
            <label for="<?php echo $this->get_field_id( 'title2' ); ?>"><?php _e('Title 2:', 'framework') ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'title2' ); ?>" name="<?php echo $this->get_field_name( 'title2' ); ?>" value="<?php echo $instance['title2'];?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'subtitle2' ); ?>"><?php _e('Sub Title 2:', 'framework') ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'subtitle2' ); ?>" name="<?php echo $this->get_field_name( 'subtitle2' ); ?>" value="<?php echo $instance['subtitle2'];?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e('Link 2:', 'framework') ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'link2' ); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" value="<?php echo $instance['link2'];?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'image2' ); ?>"><?php _e('Image 2:', 'framework') ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'image2' ); ?>" name="<?php echo $this->get_field_name( 'image2' ); ?>" value="<?php echo $instance['image2'];?>">
        </p>


        <strong>Image 3:</strong>
        <p>
            <label for="<?php echo $this->get_field_id( 'title3' ); ?>"><?php _e('Title 3:', 'framework') ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'title3' ); ?>" name="<?php echo $this->get_field_name( 'title3' ); ?>" value="<?php echo $instance['title3'];?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'subtitle3' ); ?>"><?php _e('Sub Title 3:', 'framework') ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'subtitle3' ); ?>" name="<?php echo $this->get_field_name( 'subtitle3' ); ?>" value="<?php echo $instance['subtitle3'];?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'link3' ); ?>"><?php _e('Link 3:', 'framework') ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'link3' ); ?>" name="<?php echo $this->get_field_name( 'link3' ); ?>" value="<?php echo $instance['link3'];?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'image3' ); ?>"><?php _e('Image 3:', 'framework') ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'image3' ); ?>" name="<?php echo $this->get_field_name( 'image3' ); ?>" value="<?php echo $instance['image3'];?>">
        </p>

        <?php
    }
}