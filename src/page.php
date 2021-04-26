<?php get_header(); ?>
    <article <?php post_class('single-article'); ?>>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<header class="single-header">
					<h1 class="top_title"><?php the_title(); ?></h1>
				</header>
				<section class="single-content<?php if ( is_woocommerce() ) { echo ' shop__content';} ?>">
					<?php the_content(); ?>
				</section>
			<?php endwhile; else: ?>
				<header class="single-header">
					<h1 class="top_title">Nothing found</h1>
				</header>
				<section class="single-content">
					<p>Sorry, no page was found.</p>
				</section>
			<?php endif; ?>
    </article>
<?php get_footer(); ?>
