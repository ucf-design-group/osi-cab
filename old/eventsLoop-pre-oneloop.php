<?php

// Our include  
define('WP_USE_THEMES', false);  
require_once('../../../wp-load.php');


// Our variables
$pastOrFuture = (isset($_GET['pastorfuture'])) ? $_GET['pastorfuture'] : '';
$startEvent = (isset($_GET['start'])) ? $_GET['start'] : '';
$number = (isset($_GET['number'])) ? $_GET['number'] : '';

if ($pastOrFuture == "past") {
					// grab events and order them by date
					$eventsQuery = array( 'post_type' => 'events', 'posts_per_page' => -1, 'meta_key' => 'events-date', 'orderby' => 'meta_value', 'order' => 'DESC' );
					$loop = new WP_Query( $eventsQuery );

					//format for images
					$poster = array(
							//In CSS as .attachment-poster
							'class'	=> "poster",
						);

						$pastCount = 0;
						while ( $loop->have_posts() && $pastCount < $number) : $loop->the_post();
						//get date from meta
						$thedate = get_post_meta($post->ID, 'events-date', true);
						//compare dates
						if( $thedate < $startEvent ) { 
						?>
							<h3><?php the_title(); ?></h3>
							<!-- div for each event -->
							<?php
								if ($pastCount == $number - 1 && $loop->current_post + 1 < $loop->post_count) {
									echo '<div class="events" id="'.$thedate.'">';
								}
								else if ($loop->current_post + 1 >= $loop->post_count) {
									echo '<div class="events" id="lastevent">';
								}
								else {
									echo '<div class="events">';
								}

								//get date
								$month = date('F', $thedate);
								$day = date('j', $thedate);
								$time = date('g:i a', $thedate);
								$linkToAlbum = get_post_meta($post->ID, 'event-meta-album', true);
								$category = get_the_category();
								$category = $category[0]->cat_name;
								$category = strtolower($category);
								$category =  str_replace(" ", "-", $category);
								
								//echo the date info in divs
								?>
								<div class="event-date">
									<?php
									echo "<div class='month'>".$month."</div>";
									echo "<div class='day'>".$day."</div>";
									echo "<div class='time'>".$time."</div>";
									echo "<a href='../committees-contact'><img src='http://osi.ucf.edu/cab/wp-content/themes/cab/images/{$category}.png' alt='Event Photos' /></a>";
									echo "<a href='{$linkToAlbum}'><img src='http://osi.ucf.edu/cab/wp-content/themes/cab/images/pictures-icon.png' alt='Event Photos' /></a>";
									?>
									
								</div>
								<?php
								//the poster for the event
								$link = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
								echo "<a href='{$link}'>";
								the_post_thumbnail( 'medium', $poster);
								$pastCount++; ?></a>
							</div>
						<?php 
						}
						endwhile;
						?>
					</div>
<?php
}
else if ($pastOrFuture == "future") {
					// grab events and order them by date
					$eventsQuery = array( 'post_type' => 'events', 'posts_per_page' => -1, 'meta_key' => 'events-date', 'orderby' => 'meta_value', 'order' => 'ASC' );
					$loop = new WP_Query( $eventsQuery );

					//format for images
					$poster = array(
							//In CSS as .attachment-poster
							'class'	=> "poster",
						);

						$futureCount = 0;
						while ( $loop->have_posts() && $futureCount < $number) : $loop->the_post();
						//get date from meta
						$thedate = get_post_meta($post->ID, 'events-date', true);
						//compare dates
						if( $thedate >= $startEvent ) { 
						?>
							<h3><?php the_title(); ?></h3>
							<!-- div for each event -->
							<?php
								if ($futureCount == $number - 1 && $loop->current_post + 1 < $loop->post_count) {
									echo '<div class="events" id="'.$thedate.'">';
								}
								else if (!$loop->have_posts()) {
									echo '<div class="events last">';
								}
								else {
									echo '<div class="events">';
								}

								//get date
								$month = date('F', $thedate);
								$day = date('j', $thedate);
								$time = date('g:i a', $thedate);
								$linkToAlbum = get_post_meta($post->ID, 'event-meta-album', true);
								$category = get_the_category();
								$category = $category[0]->cat_name;
								$category = strtolower($category);
								$category =  str_replace(" ", "-", $category);
								//echo the date info in divs
								?>
								<div class="event-date">
									<?php
									echo "<div class='month'>".$month."</div>";
									echo "<div class='day'>".$day."</div>";
									echo "<div class='time'>".$time."</div>";
									echo "<a href='../committees-contact'><img src='http://osi.ucf.edu/cab/wp-content/themes/cab/images/{$category}.png' alt='Event Photos' /></a>";
									echo "<a href='{$linkToAlbum}'><img src='http://osi.ucf.edu/cab/wp-content/themes/cab/images/pictures-icon.png' alt='Event Photos' /></a>";
									?>
								</div>
								<?php
								//the poster for the event
								$link = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
								echo "<a href='{$link}'>";
								the_post_thumbnail( 'medium', $poster);
								$futureCount++; ?></a>
							</div>
						<?php 
						}
						endwhile;
						?>
					</div>
<?php } ?>