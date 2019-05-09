<?php get_header(); ?>
<main class="grid">
	<?php
		$query = new WP_Query(
			'cat=-3,-8'
		);
	?>
	<?php if ( $query->have_posts() ) : ?>
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<div class="post__preview">
				<h2>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Link to <?php the_title_attribute(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
				<?php the_post_thumbnail(); ?>
				<section>
					<?php the_excerpt(); ?>
				</section>
				<div class="postmetadata">
					<?php the_time( 'j F Y' ); ?>
				</div>
				<div class="postmetadata">
					<?php the_author_posts_link(); ?>
				</div>
				<div class="postmetadata">
					<?php esc_html_e( 'Posted in' ); ?> <?php the_category( ', ' ); ?>
				</div>
			</div>
		<?php endwhile;
	 	wp_reset_postdata();
	else : ?>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php get_template_part( 'search', 'no-posts' ); ?>
	<?php endif; ?>
</main>
<?php get_footer(); ?>
