<?php
/**
 * The template for displaying the sidebar
 *
 * @package StaticCore
 * @since StaticCore 1.0.0
 */

if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
<aside id="sidebar">
<div id="primary" class="widget-area">
<ul class="xoxo">
<?php dynamic_sidebar( 'primary-widget-area' ); ?>
</ul>
</div>
</aside>
<?php endif; ?>