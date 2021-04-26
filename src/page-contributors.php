<?php get_header(); ?>
    <article <?php post_class('single-article'); ?>>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<header class="single-header">
					<h1><?php the_title(); ?></h1>
				</header>
				<section class="single-content">
					<?php the_content() ?>
					<?php
	
						$terms = get_terms( array(
							'taxonomy' => 'contributor',
							'hide_empty' => false,
							'orderby' => 'name',
							'order' => 'ASC',
						));
						if ($terms){
							if ( ! is_wp_error( $terms ) ) {
								
								$term_len = count($terms);	
								$i = 0;

								echo '<ul class="contributor-list">';
								
								foreach ( $terms as $term ) {
									
									$term_count = $term->count;
									
									if ( $term_count > 0 ) {
										
										$term_name = $term->name;
										$term_char = remove_accents(mb_strtoupper(mb_substr($term_name, 0, 1)));
										$term_link = get_term_link( $term );

										if ($term_char !== $current_char ){
											if ( $i !== 0 ) {
												echo '</ul></li>';
											}
											echo '<li class="list-item"><h2 class="contributor-sub-list-heading">' . $term_char . '</h2><ul class="contributor-sub-list">';
											$current_char = $term_char;
										}

										// If there was an error, continue to the next term.
										if ( is_wp_error( $term_link ) ) {
											continue;
										}

										echo '<li class="contributor-sub-list-item"><a href="' . esc_url($term_link) . '">' . $term_name . '</a></li>';

										echo $term_char_decoded;

										if ( $i == $term_len) {
											echo '</ul></li>';
										}

	//									$current_char = $term_char;
										$i++;
									}
								}
								
								echo '</ul>';
							}
						}
					?>
				</section>
			<?php endwhile; else: ?>
				<header class="single-header">
					<h1 class="top_title">Nothing found</h1>
				</header>
				<section class="single-content">
					<p>Sorry, no posts were found.</p>
				</section>
			<?php endif; ?>
    </article>
<?php get_footer(); ?>
