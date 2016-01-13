<?php

// This is the loop for accessing events.  It is called both by the
// events template and the AJAX for loading more events dynamically.


$usingAJAX = false;

if (isset($_GET['pastorfuture']) || isset($_GET['start']) || isset($_GET['number'])) {

	$usingAJAX = true;
	$pastOrFuture = (isset($_GET['pastorfuture'])) ? $_GET['pastorfuture'] : '';
	$startEvent = (isset($_GET['start'])) ? $_GET['start'] : '';
	$number = (isset($_GET['number'])) ? $_GET['number'] : '';

	define('WP_USE_THEMES', false);
	require_once('../../../wp-load.php');

	retrieveEvents($pastOrFuture, $startEvent, $number);
}

function retrieveEvents ($pastOrFuture, $startEvent, $number) {

	$ascOrDesc = '';
	if ($pastOrFuture == 'past') $ascOrDesc = 'DESC';
	else $ascOrDesc = 'ASC';

	$showLoadMore = false;
	if ($startEvent == 0) {
		$startEvent = time();
		$showLoadMore = true;
	}

	$eventsQuery = array( 'post_type' => 'osi-events', 'posts_per_page' => -1, 'meta_key' => 'oe-form-start', 'orderby' => 'meta_value', 'order' => $ascOrDesc );
	$loop = new WP_Query($eventsQuery);

	$poster = array('class' => 'poster');
	$counter = 0;
	$lastEvent = 0;

	while ($loop->have_posts() && $counter < $number) {

		$loop->the_post();
		global $post;

		$eventDate = get_post_meta($post->ID, 'oe-form-start', true);
		
		if ($ascOrDesc == 'DESC' && $eventDate < $startEvent || $ascOrDesc == 'ASC' && $eventDate > $startEvent) {

			// $eventDiv changes depending on if there are more events to show.
			if ($counter == $number - 1 && $loop->current_post + 1 < $loop->post_count) {
				$eventDiv = '<div class="events" id="'.$eventDate.'">';
			}
			else if ($loop->current_post + 1 >= $loop->post_count) {
				$eventDiv = '<div class="events" id="lastevent">';
				$showLoadMore = false;
			}
			else $eventDiv = '<div class="events">';
			
			$month = date('F', $eventDate);
			$day = date('j', $eventDate);
			$time = date('g:i a', $eventDate);
			$linkToAlbum = get_post_meta($post->ID, 'oe-form-url', true);
			$category = get_the_category();
			$category = str_replace(" ", "-", strtolower( $category[0]->cat_name ));
			$link = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

			<h3><a href='<?php echo get_permalink() ?>'><?php the_title() ?></a></h3>
			<?php echo $eventDiv ?>
				<div class='event-date'>
					<div class='month'><?php echo $month ?></div>
					<div class='day'><?php echo $day ?></div>
					<div class='time'><?php echo $time ?></div>
					<a href='../committees-contact'><img src='<?php bloginfo('template_directory'); ?>/images/<?php echo $category ?>.png' alt='Committee' /></a>
					<a href='<?php echo $linkToAlbum ?>'><img src='<?php bloginfo('template_directory'); ?>/images/pictures-icon.png' alt='Event Photos' /></a>
				</div>
				<a href='<?php echo $link ?>'><?php the_post_thumbnail('medium', $poster) ?></a>
			</div>
			<?php $counter++;

			$lastEvent = $eventDate;
		}
	}

	if ($showLoadMore && $counter != 0) echo "<div id='".$lastEvent. "' class='load-events'><a href='#'>Load More Events</a></div>";
	if ($usingAJAX == false && $counter == 0) echo "<p class='noevents'>There are no events to show at this time.</p>";
}

?>