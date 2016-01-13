<?php
/**
 * Template Name: Directors-OLD
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

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>
					<?php
						//Committees Loop
						$committeesQuery = array( 'post_type' => 'committees', 'posts_per_page' => -1, 'orderby' => 'DESC' );
						$loop = new WP_Query( $committeesQuery );
						while ( $loop->have_posts() ) : $loop->the_post();
							the_title();
							the_content();
							$whatCommittee = strtolower( get_the_title() );

							//Next Events for this Committee
							$eventsForCommitteeQuery = array( 'post_type' => 'events', 'category_name' => $whatCommittee, 'posts_per_page' => -1, 'meta_key' => 'events_date', 'orderby' => 'meta_value' );
							$eventsLoop =  new WP_Query( $eventsForCommitteeQuery );
							while ( $eventsLoop->have_posts() ) : $eventsLoop->the_post();
								the_title();
							endwhile;

							//Directors Loop
							$directorsQuery = array(  'post_type' => 'directors', 'category_name' => $whatCommittee, 'posts_per_page' => -1, 'orderby' => 'DESC' );
							$showDirector = new WP_Query( $directorsQuery );
							while ( $showDirector->have_posts() ) : $showDirector->the_post();
								the_title();
							endwhile;//End Director Loop

						endwhile;//End Committee Loop
					?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		
<?php get_footer(); ?>
