<div class="index">
	<?php if (have_posts()) :
		while (have_posts()) :
			the_post(); 
			get_template_part( 'preview' ); // display post previews
		endwhile;
	else : ?>
		<header class="single_header">
			<h1 class="top_title">Nothing found</h1>
		</header>
		<section class="single_content">
			<p>Sorry, no posts were found.</p>
		</section>
	<?php endif; ?>
</div>
<?php get_template_part( 'nav' ); ?>