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
	if ( ! isset( $content_width ) ) {
		$content_width = 1920;
	}

	register_nav_menus(
		array(
			'main-menu' => esc_html__( 'Main Menu', 'staticCore' ),
		)
	);
}

require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

add_action( 'wp_enqueue_scripts', 'staticCore_enqueue' );
function staticCore_enqueue() {
	// These are the staticCore stylesheets and should remain at the top.
	// Place all of your vendor/custom stylesheets below these to avoid overwritten styles conflicts.
	wp_enqueue_style( 'staticCore-style', get_stylesheet_uri() );
	wp_enqueue_style( 'staticCore-icons', get_template_directory_uri() . '/icons/icons.css' );

	wp_enqueue_style( 'staticCore-animate', get_template_directory_uri() . '/assets/vendor/css/animate.css', array(), '4.1.1' );
	wp_enqueue_style( 'staticCore-bootstrap', get_template_directory_uri() . '/assets/vendor/css/bootstrap.min.css', array(), '4.1.1' );
	wp_enqueue_style( 'staticCore-fontawesome', get_template_directory_uri() . '/assets/vendor/css/fontawesome-all.min.css', array(), '4.1.1' );
	wp_enqueue_style( 'staticCore-hover', get_template_directory_uri() . '/assets/vendor/css/hover-min.css', array(), '4.1.1' );
	wp_enqueue_style( 'staticCore-jquery-mCustomScrollbar', get_template_directory_uri() . '/assets/vendor/css/jquery.mCustomScrollbar.min.css', array(), '4.1.1' );

	wp_enqueue_style( 'staticCore-hapl', get_template_directory_uri() . '/assets/css/hapl.css', array(), '4.1.1' );

	wp_enqueue_script( 'jquery' );
	wp_register_script( 'staticCore-videos', get_template_directory_uri() . '/js/videos.js' );
	wp_enqueue_script( 'staticCore-videos' );
	wp_add_inline_script( 'staticCore-videos', 'jQuery(document).ready(function($){$("#wrapper").vids();});' );

	wp_enqueue_script( 'staticCore-bootstrap-bundle', get_template_directory_uri() . '/assets/vendor/js/bootstrap.bundle.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'staticCore-wow', get_template_directory_uri() . '/assets/vendor/js/wow.min.js', array( 'jquery' ), null, true );

	wp_enqueue_script( 'staticCore-hapl', get_template_directory_uri() . '/assets/js/hapl.js', array( 'jquery' ), null, true );
}

/*---
 * Font awesome kit support
---*/
function staticCore_enqueue_fa_kit() {

	// Add your own kit URL ─ replace the token if it ever changes.
	$fa_kit_url = 'https://kit.fontawesome.com/c2021474a9.js';

	wp_enqueue_script(
		'staticCore-fa-kit',
		$fa_kit_url,
		array(),
		null,
		false
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
	wp_add_inline_script(
		'jquery',
		'window.$ = window.jQuery;',
		'after'
	);
}
add_action( 'wp_enqueue_scripts', 'staticCore_enable_dollar_alias', 20 );

add_action( 'wp_enqueue_scripts', 'staticCore_enqueue_fa_kit' );
add_filter( 'script_loader_tag', 'staticCore_fa_crossorigin', 10, 3 );

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
	if ( $title === '' ) {
		return esc_html( '...' );
	} else {
		return wp_kses_post( $title );
	}
}

function staticCore_schema_type() {
	$schema = 'https://schema.org/';

	if ( is_single() ) {
		$type = 'Article';
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

if ( ! function_exists( 'staticCore_wp_body_open' ) ) {
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
	if ( ! is_admin() ) {
		return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'staticCore' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
	}
}

add_filter( 'excerpt_more', 'staticCore_excerpt_read_more_link' );
function staticCore_excerpt_read_more_link( $more ) {
	if ( ! is_admin() ) {
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
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar Widget Area', 'staticCore' ),
			'id'            => 'primary-widget-area',
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}

/*---
 * Disable comments globally
---*/
function staticCore_disable_comments_post_types_support() {
	$post_types = get_post_types();

	foreach ( $post_types as $post_type ) {
		if ( post_type_supports( $post_type, 'comments' ) ) {
			remove_post_type_support( $post_type, 'comments' );
			remove_post_type_support( $post_type, 'trackbacks' );
		}
	}
}
add_action( 'admin_init', 'staticCore_disable_comments_post_types_support' );

add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );
add_filter( 'comments_array', '__return_empty_array', 10, 2 );

function staticCore_disable_comments_admin_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'staticCore_disable_comments_admin_menu' );

function staticCore_disable_comments_admin_redirect() {
	global $pagenow;

	if ( $pagenow === 'edit-comments.php' ) {
		wp_redirect( admin_url() );
		exit;
	}
}
add_action( 'admin_init', 'staticCore_disable_comments_admin_redirect' );

function staticCore_disable_dashboard_comments_metabox() {
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
}
add_action( 'admin_init', 'staticCore_disable_dashboard_comments_metabox' );

function staticCore_disable_comments_admin_bar() {
	if ( is_admin_bar_showing() ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
	}
}
add_action( 'init', 'staticCore_disable_comments_admin_bar' );

// Add subtitle meta box for pages.
function staticCore_add_page_subtitle_meta_box() {
	add_meta_box(
		'staticcore_page_subtitle',
		'Page Subtitle',
		'staticCore_page_subtitle_meta_box_html',
		'page',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'staticCore_add_page_subtitle_meta_box' );

function staticCore_page_subtitle_meta_box_html( $post ) {
	$value = get_post_meta( $post->ID, '_staticcore_page_subtitle', true );
	wp_nonce_field( 'staticcore_save_page_subtitle', 'staticcore_page_subtitle_nonce' );
	echo '<input type="text" name="staticcore_page_subtitle" style="width:100%;" value="' . esc_attr( $value ) . '" placeholder="Enter page subtitle here">';
}

function staticCore_save_page_subtitle( $post_id ) {
	if (
		! isset( $_POST['staticcore_page_subtitle_nonce'] ) ||
		! wp_verify_nonce( $_POST['staticcore_page_subtitle_nonce'], 'staticcore_save_page_subtitle' )
	) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['post_type'] ) && $_POST['post_type'] === 'page' && ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['staticcore_page_subtitle'] ) ) {
		update_post_meta( $post_id, '_staticcore_page_subtitle', sanitize_text_field( $_POST['staticcore_page_subtitle'] ) );
	}
}
add_action( 'save_post', 'staticCore_save_page_subtitle' );