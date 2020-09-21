<?php get_header(); ?>
    <article <?php post_class('single_article'); ?>>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<header class="single_header">
					<h1 class="top_title"><?php the_title(); ?></h1>
				</header>
				<section class="single_content">
					<?php the_content(); ?>
				</section>
				<footer class="single_footer">
					<?php get_template_part( 'contributors' ); ?>
					<section class="single_meta">
						<?php if ( have_rows('writers_group') ):
							while( have_rows('writers_group') ):
								the_row();
								$terms = get_sub_field('post_writers');
							endwhile;
						endif;
						if ( $terms ) {
							$credit = '<span class="single_author">Written by';
							foreach( $terms as $term ):
								$archive = esc_url( get_term_link( $term ) );
								$name = esc_html( $term->name );
								$addition = ' ' . '<a href="' . $archive . '">' . $name . '</a>';
								$credit .= $addition;
							endforeach;
							$credit .= ' / </span>';
							echo $credit;
						} ?>
						<h2 class="no-show">Metadata</h2>
						<span class="single_date">Published<time datetime="<?php echo get_the_date('c'); ?>"><?php echo ' ' . get_the_date('j F, Y'); ?></time></span>
					</section>
				</footer>
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
