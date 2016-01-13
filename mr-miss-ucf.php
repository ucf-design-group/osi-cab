<?php
/**
 * Template Name: mr-miss-ucf

 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package OSI Starter Theme
 * @since OSI Starter Theme 1.0
 */

require_once('aboutLoop.php');

get_header(); ?>

	<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
				<div class="committees">
					<h2>Committees:</h2>
					<div id="committee-menu-wrapper" class="committee-options">
						<ul id="committee-menu" class="about-menu-large">

						<?php

						$committeesQuery = array( 'post_type' => 'committees', 'posts_per_page' => -1, 'order_column' => 'post_name', 'orderby' => 'ASC' );
						$committeesLoop = new WP_Query( $committeesQuery );
						while ($committeesLoop->have_posts()) {
							$committeesLoop->the_post();
							$whatCommittee = strtolower(get_the_title());
							$slug = $post->post_name;
							echo '<li class="slide"><a id="'. $slug .'" class="committee-name" href="?type=committee&category='. $slug .'">'.get_the_title().'</a></li>
										';
						}

						$leadershipCatObj = get_category_by_slug('leadership');
						$leadershipCatID = $leadershipCatObj->term_id;
						$leadership = get_categories(array('child_of' => $leadershipCatID, 'orderby' => 'slug', 'order' => 'ASC', 'hide_empty' => 0));
						foreach($leadership as $leader) {
							$name = $leader->name;
							$slug = $leader->slug;
							echo '<li class="slide"><a id="'. $slug .'" class="director-title" href="?type=director&category='. $slug .'">'. $name .'</a></li>
										';
						} ?>
					</ul>
					</div>	
				</div>
				
				<article>
					<div class="entry-content">
					
						<?php retrieveAbout(); ?>
						
					</div>
				</article>
				
			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
	<script src="<?php bloginfo('template_directory'); ?>/js/iscroll.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/about-menu.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/aboutRetrieval.js" type="text/javascript"></script>
		
<?php get_footer(); ?>