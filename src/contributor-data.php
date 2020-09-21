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
		<h3 class="contributor_name"><a class="contributor_archive" href="<?php echo $archive; ?>"><?php echo $name; ?></a></h3>
		<?php if ( ($description) && ( ( $display_artists == 'Show') || ( $display_writers == 'Show' ) ) ): ?>
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
