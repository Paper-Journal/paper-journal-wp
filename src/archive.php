<?php get_header(); ?>
<main class="main">
	<h1 class="top_title"><?php echo the_archive_title(); ?></h1>
	<?php get_template_part( 'loop' ); ?>
</main>
<?php get_footer(); ?>