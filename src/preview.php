<div class="post__preview">
	<a class="post__preview_link" href="<?php the_permalink(); ?>">
		<div class="post__preview_background">
			<h2 class="post__preview_title"><?php the_title(); ?></h2>
		</div>
		<?php the_post_thumbnail('thumbnail', ['class' => 'post__preview_image']); ?>
	</a>
	<?php if(has_excerpt()): ?>
		<p class="post__preview_excerpt no-show">
			<?php echo get_the_excerpt(); ?>	
		</p>
	<?php endif; ?>
</div>
