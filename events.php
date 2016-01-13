<?php
/**
 * Template Name: Events
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package OSI Starter Theme
 * @since OSI Starter Theme 1.0
 */

require_once('eventsLoop.php');

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
				
					<!-- future events -->
					<div class='future'>
						<h2>Upcoming Events</h2>
						<?php retrieveEvents('future', 0, 5); ?>
					</div>
				
					<!-- past events -->
					<div class='past'>
						<h2>Past Events</h2>
						<?php retrieveEvents('past', 0, 5); ?>
					</div>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		
	<script src="<?php bloginfo('template_directory'); ?>/js/eventRetrieval.js"></script>
		
<?php get_footer(); ?>