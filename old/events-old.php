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

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; // end of the loop. ?>
				
				<?php 

					$eventsQuery = array( 'post_type' => 'events', 'posts_per_page' => -1, 'meta_key' => 'events_date', 'orderby' => 'meta_value');
					$loop = new WP_Query( $eventsQuery );
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
					$counter = 0;
					while ( $loop->have_posts() ) : $loop->the_post();
					$counter++;
					$howManyPosts = floor($counter / 2);
					endwhile;
					echo "testing!";
					$todaysDate = date(Y)."-".date(m)."-".date(d);
					echo $todaysDate;
					echo "<br />";

					while ( $loop->have_posts() ) : $loop->the_post();

						echo "<div class='blocks'>";
						the_title();
						echo "<p>";
						$thedate = get_post_meta($post->ID, 'events_date', true);
						echo $thedate;
						$yearMonthDay = explode("-", $thedate);
						echo "</p>";
						$month = intval($yearMonthDay[1]);
						echo $monthsKey[$month];
						echo " {$yearMonthDay[2]}, ";
						echo $yearMonthDay[0];

						if ( $todaysDate > $thedate ){
							echo "This happened already!";
						}
						if ( $todaysDate <= $thedate ){
							echo "This is going to happen today or in the Future!";
						}
						echo "</div>";
					endwhile;
				?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		
<?php get_footer(); ?>