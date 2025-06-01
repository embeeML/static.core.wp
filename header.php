<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php staticCore_schema_type(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<meta name="description" content="<?php if ( is_single() ) { echo esc_html( wp_strip_all_tags( get_the_excerpt(), true ) ); } else { bloginfo( 'description' ); } ?>">

<!-- SEO & Social Meta -->
<meta name="title" content="<?php bloginfo( 'name' ); ?>">
<meta name="robots" content="index, follow">
<link rel="canonical" href="<?php echo esc_url( home_url( add_query_arg( null, null ) ) ); ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
<meta property="og:url" content="<?php echo esc_url( home_url() ); ?>">
<meta property="og:image" content="<?php echo esc_url( get_template_directory_uri() . '/assets/img/og/sdf.og.img.png' ); ?>">
<meta property="og:image:alt" content="The Spencer Davis Foundation - saving lives through awareness, education, training, and equipment.">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php bloginfo( 'name' ); ?>">
<meta name="twitter:description" content="<?php bloginfo( 'description' ); ?>">
<meta name="twitter:image" content="<?php echo esc_url( get_template_directory_uri() . '/assets/img/og/sdf.og.img.png' ); ?>">
<!--favicon-->
<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/icons/favicon.svg' ); ?>" type="image/x-icon">
<link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/icons/favicon.svg' ); ?>">
<!-- google fonts if needed, uncomment and change to the correct url for your fonts.
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@400;500;600&family=Nunito:wght@800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
-->
<!-- Google Tag Manager
<script async src="https://www.googletagmanager.com/gtag/replace-with-your-tag-url"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-YOURTAG');
</script>
-->
<script type="application/ld+json">
{
"@context": "https://www.schema.org/",
"@type": "WebSite",
"name": "<?php bloginfo( 'name' ); ?>",
"url": "<?php echo esc_url( home_url() ); ?>/"
}
</script>
<script type="application/ld+json">
{
"@context": "https://www.schema.org/",
"@type": "Organization",
"name": "<?php bloginfo( 'name' ); ?>",
"url": "<?php echo esc_url( home_url() ); ?>/",
"logo": "<?php if ( has_custom_logo() ) { $custom_logo_id = get_theme_mod( 'custom_logo' ); $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' ); echo esc_url( $logo[0] ); } ?>",
"image": "<?php if ( has_site_icon() ) { echo esc_url( get_site_icon_url() ); } ?>",
"description": "<?php bloginfo( 'description' ); ?>"
}
</script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="wrapper" class="hfeed">
<header id="header">
<div id="branding">
<div id="site-title" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
<?php
if ( is_front_page() || is_home() || is_front_page() && is_home() ) {
echo '<h1>';
}
if ( has_custom_logo() ) {
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
$nologo = '';
} elseif ( has_site_icon() ) {
$logo = get_site_icon_url();
$nologo = '';
} else {
$logo = '';
$nologo = 'no-logo';
}
echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home" itemprop="url"><span class="screen-reader-text" itemprop="name">' . esc_html( get_bloginfo( 'name' ) ) . '</span><span id="logo-container" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject"><img src="';
if ( has_custom_logo() ) {
echo esc_url( $logo[0] );
} else {
echo esc_url( $logo );
}
echo '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" id="logo" class="' . esc_attr( $nologo ) . '" itemprop="url"></span></a>';
if ( is_front_page() || is_home() || is_front_page() && is_home() ) {
echo '</h1>';
}
?>
</div>
<div id="site-description"<?php if ( !is_single() ) { echo ' itemprop="description"'; } ?>><?php bloginfo( 'description' ); ?></div>
</div>
<nav id="menu" itemscope itemtype="https://schema.org/SiteNavigationElement">
<span class="looper before" tabindex="0"></span>
<button type="button" class="menu-toggle first"><span class="menu-icon">&#9776;</span><span class="menu-text screen-reader-text"><?php esc_html_e( ' Menu', 'staticCore' ); ?></span></button>
<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
<div id="search"><form method="get" class="search-form" action="<?php echo esc_url( home_url() ); ?>/"><label><span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'staticCore' ); ?></span><input type="search" class="search-field last" placeholder="<?php esc_attr_e( 'Search …', 'staticCore' ); ?>" value="" name="s"><span></span></label><input type="submit" class="search-submit" value="<?php esc_attr_e( 'Search', 'staticCore' ); ?>"></form></div>
<span class="looper after" tabindex="0"></span>
</nav>
</header>
<div id="container">
<main id="content" class="<?php if ( !is_active_sidebar( 'sidebar-widget-area' ) ) { echo 'full-width'; } ?>">