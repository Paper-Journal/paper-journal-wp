<?php get_header(); ?>
<h1 class="top_title"><?php echo $wp_query->found_posts; ?> <?php _e( 'Search Results for', 'locale' ); ?>: "<?php the_search_query(); ?>"</h1>
<?php get_template_part( 'loop' ); ?>
<?php get_footer(); ?>