<?php
/**
 * The footer template file
 *
 * @package StaticCore
 * @since StaticCore 1.0.0
 */
?>
</main>
<?php get_sidebar(); ?>
</div>
<footer id="footer">
<div id="copyright">
&copy; <?php echo esc_html( date_i18n( __( 'Y', 'static-core' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>