<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}

if ( ! function_exists( 'twentynineteen_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function twentynineteen_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Twenty Nineteen, use a find and replace
         * to change 'twentynineteen' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'twentynineteen', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

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
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1568, 9999 );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(
            [
                'menu-1' => __( 'Primary', 'twentynineteen' ),
                'footer' => __( 'Footer Menu', 'twentynineteen' ),
                'social' => __( 'Social Links Menu', 'twentynineteen' ),
            ]
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            [
                'height'      => 190,
                'width'       => 190,
                'flex-width'  => false,
                'flex-height' => false,
            ]
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Enqueue editor styles.
        add_editor_style( 'style-editor.css' );

        // Add custom editor font sizes.
        add_theme_support(
            'editor-font-sizes',
            [
                [
                    'name'      => __( 'Small', 'twentynineteen' ),
                    'shortName' => __( 'S', 'twentynineteen' ),
                    'size'      => 19.5,
                    'slug'      => 'small',
                ],
                [
                    'name'      => __( 'Normal', 'twentynineteen' ),
                    'shortName' => __( 'M', 'twentynineteen' ),
                    'size'      => 22,
                    'slug'      => 'normal',
                ],
                [
                    'name'      => __( 'Large', 'twentynineteen' ),
                    'shortName' => __( 'L', 'twentynineteen' ),
                    'size'      => 36.5,
                    'slug'      => 'large',
                ],
                [
                    'name'      => __( 'Huge', 'twentynineteen' ),
                    'shortName' => __( 'XL', 'twentynineteen' ),
                    'size'      => 49.5,
                    'slug'      => 'huge',
                ],
            ]
        );

        // Editor color palette.
        add_theme_support(
            'editor-color-palette',
            [
                [
                    'name'  => __( 'Primary', 'twentynineteen' ),
                    'slug'  => 'primary',
                    'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
                ],
                [
                    'name'  => __( 'Secondary', 'twentynineteen' ),
                    'slug'  => 'secondary',
                    'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
                ],
                [
                    'name'  => __( 'Dark Gray', 'twentynineteen' ),
                    'slug'  => 'dark-gray',
                    'color' => '#111',
                ],
                [
                    'name'  => __( 'Light Gray', 'twentynineteen' ),
                    'slug'  => 'light-gray',
                    'color' => '#767676',
                ],
                [
                    'name'  => __( 'White', 'twentynineteen' ),
                    'slug'  => 'white',
                    'color' => '#FFF',
                ],
            ]
        );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );
    }
endif;
add_action( 'after_setup_theme', 'twentynineteen_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentynineteen_widgets_init() {

    register_sidebar(
        [
            'name'          => __( 'Footer', 'twentynineteen' ),
            'id'            => 'sidebar-1',
            'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ]
    );
}
add_action( 'widgets_init', 'twentynineteen_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 640 );
}
add_action( 'after_setup_theme', 'twentynineteen_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function twentynineteen_scripts() {
    wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), [], wp_get_theme()->get( 'Version' ) );

    wp_style_add_data( 'twentynineteen-style', 'rtl', 'replace' );

    if ( has_nav_menu( 'menu-1' ) ) {
        wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), [], '1.1', true );
        wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), [], '1.1', true );
    }

    wp_enqueue_style( 'twentynineteen-print-style', get_template_directory_uri() . '/print.css', [], wp_get_theme()->get( 'Version' ), 'print' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'twentynineteen_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
    // The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
    ?>
    <script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
    </script>
    <?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentynineteen_editor_customizer_styles() {

    wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

    if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
        // Include color patterns.
        require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
        wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
    }
}
add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function twentynineteen_colors_css_wrap() {

    // Only include custom colors in customizer or frontend.
    if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
        return;
    }

    require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

    $primary_color = 199;
    if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
        $primary_color = get_theme_mod( 'primary_color_hue', 199 );
    }
    ?>

    <style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
        <?php echo twentynineteen_custom_colors_css(); ?>
    </style>
    <?php
}
add_action( 'wp_head', 'twentynineteen_colors_css_wrap' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';



add_action( 'wp_enqueue_scripts', 'add_form_scripts' );
function add_form_scripts() {
    if ( is_page( 'move' ) ) {
        wp_enqueue_script(
            'move-in-script', // internal identifier
            get_template_directory_uri() . '/js/move-in.js', // path to js file
            ['jquery'], // dependencies
            '',
            true
        );

        // pass some wordpress data from the server into our js file, so it knows where to communicate
        // and has the nonce value so we can verify the request comes from our site
        wp_localize_script(
            'move-in-script',
            'FROM_WP',
            [
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce( 'move-n' ),
            ]
        );
    }
}

add_action( 'wp_ajax_move_in_form_submission', 'move_in_form_submission' );
add_action( 'wp_ajax_nopriv_move_in_form_submission', 'move_in_form_submission' );

function move_in_form_submission() {
    // we check to make sure the nonce is valid
    check_ajax_referer( 'move-n', 'nonce' );

    error_log( print_r( $_POST, true ) );
    // do some validation on the back end


    // send request off to the 3rd party service
    $url = 'https://cptest.move-n.com/api/Lead/LeadInfo';
    $body = [
        'sender_id' => '849b2101c11b171ca1cb65b27d1119127ee38f2c',
        'parent_id' => '224' ,
        'first_name' => filter_non_alpha( sanitize_text_field( $_POST['firstName'] ) ),
        'last_name' => filter_non_alpha( sanitize_text_field( $_POST['lastName'] ) ),
        'prospect_first_name' => filter_non_alpha( sanitize_text_field( $_POST['prospectFirstName'] ) ),
        'prospect_last_name' => filter_non_alpha( sanitize_text_field( $_POST['prospectLastName'] ) ),
        'home_phone' => filter_phone_number( sanitize_text_field( $_POST['homePhone'] ) ),
        'cell_phone' => filter_phone_number( sanitize_text_field( $_POST['cellPhone'] ) ),
        'email' => sanitize_text_field( $_POST['email'] ),
        'notes' => sanitize_text_field( $_POST['notes'] ),
        'source_code' => '1',
        'property_id' => '483',
        'address1' => sanitize_text_field( $_POST['address1'] ),
        'address2' => sanitize_text_field( $_POST['address2'] ),
        'city' => sanitize_text_field( $_POST['city'] ),
        'state' => sanitize_text_field( $_POST['state'] ),
        'zip' => sanitize_text_field( $_POST['zip'] ),
        'TypeOfService' => sanitize_text_field( $_POST['typeOfService'] ),
    ];


    $args = [
        'method' => 'POST',
        'timeout' => 10,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => [],
        'body' => http_build_query( $body ),
        'cookies' => []
    ];

    $response = wp_remote_post( $url, $args );

    error_log( print_r( $response, true ) );
    if ( wp_remote_retrieve_response_code( $response ) !== 200 ) {
        // calling send_json_error or success has a die() in it
        wp_send_json_error( wp_remote_retrieve_body( $response ) );
        return;
    }

    wp_send_json_success();
}

// /**
//  * checks if params are between 0 and a max length
//  */
// function check_length( $param, $max_len ) {
//     $len = strlen( $param );
//     if ( $len > 0 && $len < $max_len ) {
//         return true;
//     }
//     return false;
// }

/**
 * removes all non alpha chars
 */
function filter_non_alpha( $param ) {
    $filtered = preg_replace( '/[^a-zA-Z ]+/', '', $param );
    return $filtered;
}

/**
 * removes everything except 0-9 () - .
 */
function filter_phone_number( $param ) {
    $filtered = preg_replace( '/[^0-9]+/', '', $param );
    return $filtered;
}
