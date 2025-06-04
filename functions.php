<?php
add_action( 'after_setup_theme', 'staticCore_setup' );
function staticCore_setup() {
load_theme_textdomain( 'staticCore', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'custom-logo' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
add_theme_support( 'appearance-tools' );
add_theme_support( 'woocommerce' );
global $content_width;
if ( !isset( $content_width ) ) { $content_width = 1920; }
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'static-core' ) ) );
}
add_action( 'wp_enqueue_scripts', 'staticCore_enqueue' );
function staticCore_enqueue() {
//These are the staticCore stylesheets and should remain at the top. Place all of your vendor/custom stylesheets below these to avoid overwritten styles conflicts
wp_enqueue_style( 'staticCore-style', get_stylesheet_uri() );
wp_enqueue_style( 'staticCore-icons', get_template_directory_uri() . '/icons/icons.css' );
//Add Vendor Stylesheets or your own additional stylesheets here use the example below as a guide:
//Place these styles in the /assets/css or assets/vendor/css folders 
// 
// wp_enqueue_style( 'staticCore-animate', get_template_directory_uri() . '/assets/vendor/css/animate.min.css', array(), '4.1.1' );

wp_enqueue_script( 'jquery' );
wp_register_script( 'straticCore-videos', get_template_directory_uri() . '/js/videos.js' );
wp_enqueue_script( 'staticCore-videos' );
wp_add_inline_script( 'staticCore-videos', 'jQuery(document).ready(function($){$("#wrapper").vids();});' );
//Add vendor or custom JS files here, use the example below as a guide:
//
// wp_enqueue_script( 'staticCore-scrollup', get_template_directory_uri() . '/assets/vendor/js/scrollup.js', array( 'jquery' ), null, true );
}
/*---
* Font awesome kit support
---*/
function staticCore_enqueue_fa_kit() {

    //Add your own kit URL ─ replace the token if it ever changes
    $fa_kit_url = 'https://kit.fontawesome.com/replace-with-url.js';

    wp_enqueue_script(
        'staticCore-fa-kit',     // handle
        $fa_kit_url,             // src
        [],                      // no dependencies
        null,                    // let FA control cache-busting
        false                    // load in <head>
    );
}
/*---
 * WordPress strips unknown attributes so adding crossorigin="anonymous" back to the <script> tag.
 ---*/
function staticCore_fa_crossorigin( $tag, $handle, $src ) {

    if ( 'staticCore-fa-kit' === $handle ) {
        $tag = str_replace(
            '<script ',
            '<script crossorigin="anonymous" ',
            $tag
        );
    }
    return $tag;
}
/*---
 * Restore the `$` alias after WordPress loads its copy of jQuery
---*/
function staticCore_enable_dollar_alias() {

    // Tell WP to print this line *immediately after* jquery.min.js
    wp_add_inline_script(
        'jquery',                // the handle WP uses for its own jQuery
        'window.$ = window.jQuery;', // the code to inject
        'after'                  // place it after the script tag
    );
}
// run after all scripts have been registered/enqueued
add_action( 'wp_enqueue_scripts', 'staticCore_enable_dollar_alias', 20 );

add_action( 'wp_enqueue_scripts', 'staticCore_enqueue_fa_kit' );
add_filter( 'script_loader_tag',  'staticCore_fa_crossorigin', 10, 3 );

add_action( 'wp_footer', 'staticCore_footer' );
function staticCore_footer() {
?>
<script>
jQuery(document).ready(function($) {
$(".before").on("focus", function() {
$(".last").focus();
});
$(".after").on("focus", function() {
$(".first").focus();
});
$(".menu-toggle").on("keypress click", function(e) {
if (e.which == 13 || e.type === "click") {
e.preventDefault();
$("#menu").toggleClass("toggled");
$(".looper").toggle();
}
});
$(document).keyup(function(e) {
if (e.keyCode == 27) {
if ($("#menu").hasClass("toggled")) {
$("#menu").toggleClass("toggled");
}
}
});
$("img.no-logo").each(function() {
var alt = $(this).attr("alt");
$(this).replaceWith(alt);
});
});
</script>
<?php
}
add_filter( 'document_title_separator', 'staticCore_document_title_separator' );
function staticCore_document_title_separator( $sep ) {
$sep = esc_html( '|' );
return $sep;
}
add_filter( 'the_title', 'staticCore_title' );
function staticCore_title( $title ) {
if ( $title == '' ) {
return esc_html( '...' );
} else {
return wp_kses_post( $title );
}
}
function staticCore_schema_type() {
$schema = 'https://schema.org/';
if ( is_single() ) {
$type = "Article";
} elseif ( is_author() ) {
$type = 'ProfilePage';
} elseif ( is_search() ) {
$type = 'SearchResultsPage';
} else {
$type = 'WebPage';
}
echo 'itemscope itemtype="' . esc_url( $schema ) . esc_attr( $type ) . '"';
}
add_filter( 'nav_menu_link_attributes', 'staticCore_schema_url', 10 );
function staticCore_schema_url( $atts ) {
$atts['itemprop'] = 'url';
return $atts;
}
if ( !function_exists( 'staticCore_wp_body_open' ) ) {
function staticCore_wp_body_open() {
do_action( 'wp_body_open' );
}
}
add_action( 'wp_body_open', 'staticCore_skip_link', 5 );
function staticCore_skip_link() {
echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'staticCore' ) . '</a>';
}
add_filter( 'the_content_more_link', 'staticCore_read_more_link' );
function staticCore_read_more_link() {
if ( !is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'staticCore' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'excerpt_more', 'staticCore_excerpt_read_more_link' );
function staticCore_excerpt_read_more_link( $more ) {
if ( !is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'staticCore' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'big_image_size_threshold', '__return_false' );
add_filter( 'intermediate_image_sizes_advanced', 'staticCore_image_insert_override' );
function staticCore_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
unset( $sizes['1536x1536'] );
unset( $sizes['2048x2048'] );
return $sizes;
}
add_action( 'widgets_init', 'staticCore_widgets_init' );
function staticCore_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'staticCore' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'staticCore_pingback_header' );
function staticCore_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'staticCore_enqueue_comment_reply_script' );
function staticCore_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function staticCore_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url( comment_author_link() ); ?></li>
<?php
}
add_filter( 'get_comments_number', 'staticCore_comment_count', 0 );
function staticCore_comment_count( $count ) {
if ( !is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}