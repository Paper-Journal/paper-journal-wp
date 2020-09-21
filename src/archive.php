<?php get_header(); ?>
<h1 class="top_title"><?php echo the_archive_title(); ?></h1>
<?php get_template_part( 'loop' ); ?>
<?php get_footer(); ?>