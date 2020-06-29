<nav class="index-nav no-print">
	<div class="pagination">
		<?php if ( get_previous_posts_link() ) : ?>
			<div class="pagination__newer"><?php previous_posts_link( 'Newer posts' ); ?></div>
		<?php endif; ?>
		<?php if ( get_next_posts_link() ) : ?>
			<div class="pagination__older"><?php next_posts_link( 'Older posts' ); ?></div>
		<?php endif; ?>
	</div>
	<div class="infinite-scroll"><button class="infinite-scroll-button">View more</button></div>
</nav>