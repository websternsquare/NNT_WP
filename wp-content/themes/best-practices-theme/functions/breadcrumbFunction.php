<?php

class BreadCrumbFactory {

    private $post_object;
    private $term_object;
    private $breadcrumbs;

     public function build() {
        // Makes sure to make our own wp_the_query, because GLOBAL version is dangerous
        $this->post_object = $GLOBALS['wp_the_query']->get_queried_object();
        $this->term_object = get_term($this->post_object);
        
        $this->get_home();
        
        if (is_404()) { 
            $this->page_404();
        }
        else {
            if (is_singular()) { 
                $this->single_post_breadcrumb();
            }
            else if(is_archive()) { 
                $this->archive_post_breadcrumb();
            }
            else if($this->post_object->post_type = 'post') {
                $this->get_current_page();
            }
        }

        return $this->breadcrumbs;
    }

    private function single_post_breadcrumb() {
        
        $this->get_custom_post_pair();
        $this->get_parent_posts_pair();
        $this->get_parent_terms_pair();
        $this->get_current_page();
    }

    private function archive_post_breadcrumb() {

        if (is_category()
        ||  is_tag()
        ||  is_tax()
        ) {
            $this->get_post_type_archive();
            $this->get_archive_parent_pairs();
            $this->get_current_page_term();
        }
 
    }

    private function get_home() {
        if ( is_front_page() ) {                   
        } else {
            
            $home_link = home_url('/');
            $home_name = __( 'Home' );

            $this->breadcrumbs[] = new Breadcrumb($home_link,$home_name);
        }
    }

    private function get_custom_post_pair() {

        $post_type = $this->post_object->post_type;

        if( $post_type !== 'page') {

            $post_type_object = get_post_type_object( $post_type );
            $archive_link     = esc_url( get_post_type_archive_link( $post_type ) );
            $post_type_name   = $post_type_object->labels->singular_name;

            if( $post_type == 'post') {

                $post           = get_post(get_option('page_for_posts'));
                $post_type_name = $post->post_title;
            }

            $this->breadcrumbs[] = new Breadcrumb($archive_link,$post_type_name);
        }   
    }

    private function get_parent_posts_pair() {
        
        $parent_breadcrumbs = [];
        $parent_id = $this->post_object->post_parent;
        
        while ( $parent_id ) { 
            $parent_post = get_post($parent_id);
            $parent_post_link = get_permalink( $parent_post->ID );
            $parent_post_name = get_the_title( $parent_post->ID);

            $parent_breadcrumbs[] = new Breadcrumb($parent_post_link, $parent_post_name);

            $parent_id = $parent_post->post_parent;
        }
        if (!empty($parent_breadcrumbs)) { 
            $parent_breadcrumbs = array_reverse( $parent_breadcrumbs );

            $this->breadcrumbs = array_merge($this->breadcrumbs, $parent_breadcrumbs);
        }
    }

    private function get_parent_terms_pair() {

        $taxonomy = get_object_taxonomies( $this->post_object );
        $post_id  = $this->post_object->ID;

        if($taxonomy) {
            $term_of_post = wp_get_post_terms($post_id,$taxonomy[1], array("fields" => "all"));
        } 
        if (!empty($term_of_post)) { 
            $post_id           = $this->post_object->ID;
            $term_of_post_name = $term_of_post[0]->name;
            $term_id           = get_term_by('name', $term_of_post[0]->name, $taxonomy[1]);
            $term_parent       = $term_id->parent;
           
            $parent_term_link = esc_url( get_term_link( $term_id ) );
            $parent_term_name = $term_of_post_name;

            $breadcrumbs_temp[] = new Breadcrumb($parent_term_link,$parent_term_name);

            while ( $term_parent ) {
                $term             = get_term($term_parent,$taxonomy[1]);
                $term_parent_name = $term->name;

                $parent_term_link = esc_url( get_term_link( $term ) );
                $parent_term_name = $term_parent_name;

                $breadcrumbs_temp[] = new Breadcrumb($parent_term_link,$parent_term_name);

                $term_parent = $term->parent;
            }

            $breadcrumbs_temp = array_reverse( $breadcrumbs_temp );

            $this->breadcrumbs = array_merge($this->breadcrumbs, $breadcrumbs_temp);
        }
    }

    private function get_current_page() {

        $current_page_link  = esc_url( get_permalink( $this->post_object ) );
        $current_page_name  = apply_filters( 'the_title', $this->post_object->post_title );

        $this->breadcrumbs[] = new Breadcrumb($current_page_link,$current_page_name);
    }     

    private function get_post_type_archive() {

        $taxonomy         = $this->term_object->taxonomy;
        $post_type        = get_post_type( get_the_ID() );
        $post_type_object = get_post_type_object( $post_type );

        if( $taxonomy ) {
            $post_type_link = esc_url( get_post_type_archive_link( $post_type ));
            $post_type_name = $post_type_object->labels->singular_name;

            $this->breadcrumbs[] = new Breadcrumb($post_type_link,$post_type_name);
        }
    }

    private function get_archive_parent_pairs() {

        $term_parent = $this->term_object->parent;

        if ( 0 !== $term_parent ) {
            $taxonomy = $this->term_object->taxonomy;
            
            while ( $term_parent ) {
                $term = get_term( $term_parent, $taxonomy );

                $parent_term_link = esc_url( get_term_link( $term ) );
                $parent_term_name = $term->name;

                $breadcrumbs_temp[] = new Breadcrumb($parent_term_link,$parent_term_name);

                $term_parent = $term->parent;
            }
            $breadcrumbs_temp = array_reverse( $breadcrumbs_temp );

            $this->breadcrumbs = array_merge($this->breadcrumbs, $breadcrumbs_temp);
        }
    }

    private function get_current_page_term() {

        $current_term_link = esc_url( get_term_link( $this->term_object ) );
        $current_term_name = $this->term_object->name;

        $this->breadcrumbs[] = new Breadcrumb($current_term_link,$current_term_name);
    }
    
    private function page_404() {

        $this->breadcrumbs[] = new Breadcrumb(__( 'Error 404' ),__( 'Error 404' ));
    }
}

class Breadcrumb {

    public $link;
    public $name;

    public function __construct($link, $name) {

        $this->link = $link;
        $this->name = $name;
    }
    public function get_link() {

        return $this->link;
    }
    public function get_name() {

        return $this->name;
    }
}