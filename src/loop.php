<?php if ( have_posts() ) : ?>
	<div class="index">
		<h2 class="no-show">Index</h2>
		<?php while ( have_posts() ) :
			the_post(); ?>
			<div class="post__preview">
				<a class="post__preview_link" href="<?php the_permalink(); ?>">
					<div class="post__preview_background">
						<h2 class="post__preview_title"><?php the_title(); ?></h2>
					</div>
					<?php the_post_thumbnail('thumbnail'); ?>
				</a>
			</div>
		<?php endwhile; ?>
	</div> 
<?php else : ?>
		<header class="single_header">
			<h1 class="top_title">Nothing Found</h1>
		</header>
		<section class="single_content">
			<p>Sorry, no posts found.</p>
		</section>
	<?php endif; ?>
<?php if ( get_previous_posts_link() || get_next_posts_link() ) : ?>
<nav class="index-nav no-print">
	<div class="pagination">
		<?php if ( get_previous_posts_link() ) : ?>
			<div class="pagination__newer button"><?php previous_posts_link( 'Newer posts' ); ?></div>
		<?php endif; ?>
		<?php if ( get_next_posts_link() ) : ?>
			<div class="pagination__older button"><?php next_posts_link( 'Older posts' ); ?></div>
		<?php endif; ?>
	</div>
	<?php if ( get_next_posts_link() ) : ?>
		<div class="infinite-scroll"><button class="infinite-scroll-button">View more</button></div>
	<?php endif; ?>
</nav>
<?php endif; ?>