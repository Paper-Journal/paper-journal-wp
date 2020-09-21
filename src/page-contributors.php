<?php get_header(); ?>
    <article <?php post_class('single__article'); ?>>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<header class="single_header">
					<h1 class="top_title"><?php the_title(); ?></h1>
				</header>
				<section class="single_content">
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
									$term_name = $term->name;
									$term_char = mb_strtoupper(mb_substr($term_name, 0, 1));

									if ($term_char !== $current_char ){
										if ( $i !== 0 ) {
											echo '</ul></li>';
										}
										echo '<li class="list-item"><h2 class="contributor-sub-list-heading">' . $term_char . '</h2><ul class="contributor-sub-list">';
										$current_char = $term_char;
									}

									$term_link = get_term_link( $term );
									    
									// If there was an error, continue to the next term.
									if ( is_wp_error( $term_link ) ) {
										continue;
									}

									echo '<li class="contributor-sub-list-item"><a href="' . esc_url($term_link) . '">' . $term_name . '</a></li>';

									if ( $i == $term_len) {
										echo '</ul></li>';
									}	

//									$current_char = $term_char;
									$i++;
								}
								
								echo '</ul>';
							}
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
<?php get_footer(); ?>
