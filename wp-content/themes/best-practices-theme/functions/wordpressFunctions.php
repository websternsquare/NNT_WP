<?php
/**
 * Stark functions and definitions
 *
 * @since Stark 1.0
 */

/**
 * This theme only works in WordPress 4.1 or later.
 */

if ( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
    acf_add_options_sub_page('Header');
    acf_add_options_sub_page('Footer');
}

if ( ! function_exists( 'theme_setup' ) ) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function theme_setup() {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * TODO: Use this to add translation support
         */
        // load_theme_textdomain( 'stark', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /**
         * Remove a whole bunch of useless tags / security vulnerabilities
         */
        remove_action('wp_head', 'rsd_link'); //removes EditURI/RSD (Really Simple Discovery) link.
        remove_action('wp_head', 'wlwmanifest_link'); //removes wlwmanifest (Windows Live Writer) link.
        remove_action('wp_head', 'wp_generator'); //removes meta name generator.
        remove_action('wp_head', 'wp_shortlink_wp_head'); //removes shortlink.
        remove_action( 'wp_head', 'feed_links', 2 ); //removes feed links.
        remove_action('wp_head', 'feed_links_extra', 3 );  //removes comments feed.
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); //remove 'prev' and 'next' broken tags


        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support( 'post-thumbnails' );
        // TODO: Change this to desired size based on design
        set_post_thumbnail_size( 825, 510, true );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
            'primary' => __( 'Header Menu' ),
            'footer'  => __( 'Footer Menu' ),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );
    }
endif; // theme_setup
add_action( 'after_setup_theme', 'theme_setup' );

function stark_theme_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Homepage Introductory Text Area', '' ),
        'id'            => 'homepage-intro-text',
        'description'   => __( 'Appears in the homepage section of the site.', '' ),
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => __( 'Sidebar Widget Area', '' ),
        'id'            => 'sidebar_widget',
        'description'   => __( 'Appears in sidebar of pages.', '' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => __( 'Blog Widget Area', '' ),
        'id'            => 'blog_widget',
        'description'   => __( 'Appears on blog page.', '' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area', '' ),
        'id'            => 'footer_widget',
        'description'   => __( 'Appears in the standard footer.', '' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}
add_action( 'widgets_init', 'stark_theme_widgets_init' , 11);

add_theme_support( 'infinite-transporter' ); // TODO: Figure out what this is hooking into

/* TODO: Figure out if any of this is strictly necessary or useful */

/*
1. Search for all headings
2. Generate the slug
3. Set that slug as id attribute */

function add_id_to_headings( $html ) {

    // Store all headings of the post in an array
    $tagNames = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' );
    $headings = array();
    $headingContents = array();
    foreach ( $tagNames as $tagName ) {
        $nodes = $html->getElementsByTagName( $tagName );
        foreach ( $nodes as $node ) {
            $headings[] = $node;
            $headingContents[ $node->textContent ] = 0;
        }
    }

    foreach ( $headings as $heading ) {

        $title = $heading->textContent;

        if ( $title === '' ) {
            continue;
        }

        $count = ++$headingContents[ $title ];

        $suffix = $count > 1 ? "-$count" : '';

        $slug = sanitize_title( $title );
        $heading->setAttribute( 'id', $slug . $suffix );
    }

}

/* Remove the wrapping paragraph from images and other elements, such as picture, video, audio, and iframe. */

function content_remove_wrapping_p( $html ) {

    // Iterating a nodelist while manipulating it is not a good thing, because
    // the nodelist dynamically updates itself. Get all things that must be
    // unwrapped and put them in an array.
    $tagNames = array( 'img', 'picture', 'video', 'audio', 'iframe' );
    $mediaElements = array();
    foreach ( $tagNames as $tagName ) {
        $nodes = $html->getElementsByTagName( $tagName );
        foreach ( $nodes as $node ) {
            $mediaElements[] = $node;
        }
    }

    foreach ( $mediaElements as $element ) {

        // Get a reference to the parent paragraph that may have been added by
        // WordPress. It might be the direct parent node or the grandparent
        // (LOL) in case of links
        $paragraph = null;

        // Get a reference to the image itself or to the link containing the
        // image, so we can later remove the wrapping paragraph
        $theElement = null;

        if ( $element->parentNode->nodeName == 'p' ) {
            $paragraph = $element->parentNode;
            $theElement = $element;
        } else if ( $element->parentNode->nodeName == 'a' &&
            $element->parentNode->parentNode->nodeName == 'p' ) {
            $paragraph = $element->parentNode->parentNode;
            $theElement = $element->parentNode;
        }

        // Make sure the wrapping paragraph only contains this child
        if ( $paragraph && $paragraph->textContent == '' ) {
            $paragraph->parentNode->replaceChild( $theElement, $paragraph );
        }
    }

}

class MSDOMDocument extends DOMDocument {
    public function saveHTML ( $node = null ) {
        $string = parent::saveHTML( $node );

        return str_replace( array( '<html><body>', '</body></html>' ), '', $string );
    }
}

// TODO: Figure out what this functions purpose exactly.
function example_the_content( $content ) {

    // First encode all characters to their HTML entities
    $encoded = mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' );

    // Load the content, suppressing warnings (libxml complains about not having
    // a root element (we have many paragraphs)
    $html = new MSDOMDocument();
    $ok = @$html->loadHTML( $encoded, LIBXML_HTML_NODEFDTD | LIBXML_NOBLANKS );

    // If it didn't parse the HTML correctly, do not proceed. Return the original, untransformed, post
    if ( !$ok ) {
        return $content;
    }

    // Pass the document to all filters
    add_id_to_headings( $html );
    content_remove_wrapping_p( $html );

    // Filtering is done. Serialize the transformed post
    return $html->saveHTML();

}
add_filter( 'the_content', 'example_the_content' );