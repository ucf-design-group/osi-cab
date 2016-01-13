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
				<ul>
					<li><a class="committee-name" href="#">Cinema</a></li>
					<li><a class="committee-name" href="#">Comedy</a></li>
					<li><a class="committee-name" href="#">Concerts</a></li>
					<li><a class="committee-name" href="#">Fine Arts</a></li>
					<li><a class="committee-name" href="#">Marketing</a></li>
					<li><a class="committee-name" href="#">Speakers</a></li>
					<li><a class="committee-name" href="#">Special Events</a></li>
					<li><a class="committee-name" href="#">Spectacular Knights</a></li>
				</ul>
				<?php while ( have_posts() ) : the_post(); ?>
					<!-- entry-content -->
					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; ?>
				

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		
<?php get_footer(); ?>