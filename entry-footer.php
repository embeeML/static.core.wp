<footer class="entry-footer">
<span class="cat-links"><?php esc_html_e( 'Categories: ', 'static-core' ); ?><?php the_category( ', ' ); ?></span>
<?php the_tags( '<span class="tag-links">' . esc_html__( 'Tags: ', 'static-core' ), ', ', '</span>' ); ?>
<?php if ( comments_open() ) { echo '<span class="meta-sep">|</span> <span class="comments-link"><a href="' . esc_url( get_comments_link() ) . '">' . sprintf( esc_html__( 'Comments', 'static-core' ) ) . '</a></span>'; } ?>
</footer>