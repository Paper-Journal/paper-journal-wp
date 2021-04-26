<?php if ( have_rows('artists_group') ) : ?>
	<section class="post-contributors">
		<h2 class="no-show">Contributors</h2>
		<?php if ( have_rows('artists_group') ): 
			while( have_rows('artists_group') ):
				the_row();
				$post_artists = get_sub_field('post_artists');
				$show_artists = get_sub_field('show_artists');
				if( $post_artists && ($show_artists != 'Hide') ):
					$terms = get_sub_field('post_artists'); ?>
					<section class="post-artists">
						<?php // include( locate_template( 'contributor-data.php', false, false ) ); // use this rather than get_template_part() so that we can pass the $terms variable to the contributor-data.php file. ?>
						<?php
							foreach( $terms as $term ):
								// Get values
							//	$display_artists = get_sub_field('show_artists');
							//	$display_writers = get_sub_field('show_writers');
								$archive = esc_url( get_term_link( $term ) );
								$name = esc_html( $term->name );
								$description = esc_html( $term->description);
								$url = get_field('website', $term);
								$url_parse = wp_parse_url( preg_replace( '{/$}', '', $url ) );
								$instagram_url = get_field('instagram', $term);
								$instagram_username = '@' . str_replace('/','',wp_parse_url( get_field('instagram', $term), 5 )); ?>
								<section class="contributor">
									<p class="contributor_name"><a class="contributor_archive" href="<?php echo $archive; ?>"><?php echo $name; ?></a></p>
									<?php if ( ($description) && ($display_artists == 'Show') ): ?>
										<p class="contributor_description"><?php echo $description; ?></p>
									<?php endif; ?>
									<?php if ( $url || $instagram_url ): ?>
										<ul class="contributor_contact">
											<?php if( $url ): ?>
												<li class="contributor_website">
													<a rel="external noopener" href="<?php echo $url; ?>"><?php echo $url_parse['host'] . $url_parse['path']; ?></a>
												</li>
											<?php endif; ?>
											<?php if( $instagram_url ): ?>
												<li class="contributor_instagram">
													<a rel="external noopener" href="<?php echo $instagram_url; ?>"><?php echo $instagram_username; ?></a>
												</li>
											<?php endif; ?>
										</ul>
									<? endif; ?>
								</section>
						<?php endforeach; ?>
					</section>
			<?php endif;
			endwhile;
		endif; ?>
	</section>
<?php endif; ?>
