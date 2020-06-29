<?php if ( have_rows('artists_group') || have_rows('writers_group') ) : ?>
	<section class="single_contributors">
		<?php if (have_rows('artists_group')): 
			while( have_rows('artists_group') ):
				the_row();
				$show_artists = get_sub_field('show_artists');
				if( ( $show_artists == 'Show' ) OR ( $show_artists == 'Social' ) ):
					$terms = get_sub_field('post_artists'); ?>
					<h2 class="no-show">Artists</h2>
					<?php include( locate_template( 'contributor-data.php', false, false ) ); // use this rather than get_template_part() so that we can pass the $terms variable to the contributor-data.php file.
				endif;
			endwhile;
		endif; ?>
		<?php if( have_rows('writers_group')):
			while( have_rows('writers_group') ):
				the_row();
				$show_writers = get_sub_field('show_writers') ;
				if( ( $show_writers == 'Show' ) OR ( $show_writers == 'Social' ) ):
					$terms = get_sub_field('post_writers'); ?>
					<h2 class="no-show">Writers</h2>
					<?php include( locate_template( 'contributor-data.php', false, false ) ); // use this rather than the get_template_part() so that we can pass the $terms variable to the contributor-data.php file.
				endif;
			endwhile;
		endif; ?>
	</section>
<?php endif; ?>
