<?php
/**
 * Template Name: Events-OLD
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
					<!-- entry-content -->
					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; ?>
				
				<?php
					// grad events and order them by date
					$eventsQuery = array( 'post_type' => 'events', 'posts_per_page' => -1, 'meta_key' => 'events-date', 'orderby' => 'meta_value', 'order' => 'DESC' );
					$loop = new WP_Query( $eventsQuery );
					//associative array for showing easily readable dates.
					//Try to covert string to date from meta box to get rid of this ugly array
					$monthsKey = array(
						"Blank",
						"January",
						"February",
						"March",
						"April",
						"May",
						"June",
						"July",
						"August",
						"September",
						"October",
						"November",
						"December"
					);
					//grab today's date to organize the page
					$todaysDate = time();
					$pastOrFuture = "future";
					//format for images
					$poster = array(
							//In CSS as .attachment-poster
							'class'	=> "poster",
						);


					while ( $loop->have_posts() ) : $loop->the_post();
						$thedate = get_post_meta($post->ID, 'events-date', true);


						//Compare event date to today
						if ( $todaysDate > $thedate) {
									$pastOrFuture = "past";
								}

						echo "<div class='events {$pastOrFuture}'>";
						
						?>
							<h2><?php the_title(); ?></h2>
							<div class="event-date">
								<?php
									$month = date('F', $thedate);
									$day = date('j', $thedate);
									$time = date('g:i a', $thedate);
									//$year = date('Y',$thedate);
								echo "<div class='month'>".$month."</div>";
								echo "<div class='day'>".$day."</div>";
								echo "<div class='time'>".$time."</div>";
								//the year
								//echo "<span class='year'>".$year."</span>"; ?>
							</div>
							<?php the_post_thumbnail( 'medium', $poster); ?>
						</div>
					<?php endwhile; ?>
				
				
				

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		
<?php get_footer(); ?>