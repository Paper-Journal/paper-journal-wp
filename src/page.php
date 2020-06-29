<?php get_header(); ?>
<main class="main">
    <article <?php post_class('single__article'); ?>>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<header class="single_header">
					<h1 class="top_title"><?php the_title(); ?></h1>
				</header>
				<section class="single_content<?php if ( is_woocommerce() ) { echo ' shop__content';} ?>">
					<?php the_content(); ?>
				</section>
			<?php endwhile; else: ?>
				<header class="single_header">
					<h1 class="top_title">Nothing found</h1>
				</header>
				<section class="single_content">
					<p>Sorry, no page was found.</p>
				</section>
			<?php endif; ?>
    </article>
</main>
<?php get_footer(); ?>
