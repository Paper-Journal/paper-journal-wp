<?php get_header(); ?>
<h1 class="top_title"><?php single_term_title(); ?></h1>
<?php
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
	$description = esc_html( $term->description);
	$url = get_field('website', $term);
	$url_parse = wp_parse_url( preg_replace( '{/$}', '', get_field('website', $term) ) );
	$instagram_url = get_field('instagram', $term);
	$instagram_username = '@' . str_replace('/','',wp_parse_url( get_field('instagram', $term), 5 ));
?>
<?php if ( $description || $url || $instagram_url ): ?>
	<section class="contributor-about">
		<?php if ( $description ): ?>
			<p class="contributor_description"><?php echo $description; ?></p>
		<?php endif; ?>
		<?php if ( $url || $instagram_url ): ?>
			<ul class="contributor_contact">
				<?php if( $url ): ?>
					<li class="contributor_website">
						<a rel="external noopener" href="<?php echo $url; ?>">
							<?php echo $url_parse['host'] . $url_parse['path']; ?>
						</a>
					</li>
				<?php endif; ?>
				<?php if( $instagram_url ): ?>
					<li class="contributor_instagram">
						<a rel="external noopener" href="<?php echo $instagram_url; ?>">
							<?php echo $instagram_username; ?>
						</a>
					</li>
				<?php endif; ?>
			</ul>
		<? endif; ?>
	</section>
<? endif; ?>
<?php get_template_part('loop') ?>
<?php get_footer(); ?>            
