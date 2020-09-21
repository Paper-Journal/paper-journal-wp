<?php if ( have_rows('artists_group') || have_rows('writers_group') ) : ?>
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
						<?php include( locate_template( 'contributor-data.php', false, false ) ); // use this rather than get_template_part() so that we can pass the $terms variable to the contributor-data.php file. ?>
					</section>
			<?php endif;
			endwhile;
		endif; ?>
		<?php if( have_rows('writers_group')):
			while( have_rows('writers_group') ):
				the_row();
				
				$post_writers = get_sub_field('post_writers') ;
				$show_writers = get_sub_field('show_writers') ;
				
				if ($post_writers && ($show_writers != 'Hide') ):
					$terms = get_sub_field('post_writers'); ?>
					<section class="post-writers">
						<?php include( locate_template( 'contributor-data.php', false, false ) ); // use this rather than the get_template_part() so that we can pass the $terms variable to the contributor-data.php file. ?>
					</section>
			<?php endif;
			endwhile;
		endif; ?>
	</section>
<?php endif; ?>
