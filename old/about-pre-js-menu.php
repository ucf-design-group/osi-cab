<?php
/**
 * Template Name: About-OLD
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package OSI Starter Theme
 * @since OSI Starter Theme 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
			
				<ul class="committee-menu">
	
	<?php
	$committeesQuery = array( 'post_type' => 'committees', 'posts_per_page' => -1, 'order_column' => 'post_name', 'orderby' => 'ASC' );
	$loop = new WP_Query( $committeesQuery );
	while ( $loop->have_posts() ) : $loop->the_post();
		$whatCommittee = strtolower( get_the_title() );
		echo '<li><a class="committee-name" href="#">'.get_the_title().'</a></li>
					';
	endwhile; ?>
				</ul>

				<?php while ( have_posts() ) : the_post(); ?>
					<!-- entry-content -->
					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; ?>
				
			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		
<?php get_footer(); ?>