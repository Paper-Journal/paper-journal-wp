<?php get_header(); ?>
<main class="main">
    <article <?php post_class('single__article'); ?>>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<header class="single_header">
					<h1 class="top_title"><?php the_title(); ?></h1>
				</header>
				<section class="single_content">
					<?php 
						$terms = get_terms( array(
							'taxonomy' => 'contributor',
							'hide_empty' => false,
							'orderby' => 'name',
							'order' => 'ASC',
						));

						if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
							
							echo '<ul>';
							
							foreach($terms as $term){
								$term_name = $term->name;
								$term_char = mb_strtolower(mb_substr($term_name), 0, 1));
	
								if($term_char != $current_char){ 
									$current_char = mb_strtolower($term_char);
									echo '<li>' . $current_char . '</li>';
								}
								echo '<li>' . $term_name . '</li>';
							}
							
							echo '</ul>';
						}
					?>
				</section>
			<?php endwhile; else: ?>
				<header class="single_header">
					<h1 class="top_title">Nothing found</h1>
				</header>
				<section class="single_content">
					<p>Sorry, no posts were found.</p>
				</section>
			<?php endif; ?>
    </article>
</main>
<?php get_footer(); ?>
