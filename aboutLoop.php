<?php

// This is the loop for accessing the 'about' information.  It is called
// both by the about page template (if the page is loaded with an #anchor)
// and by the AJAX for dynamic loading.

$usingAJAX = false;

if (isset($_GET['ajax']) && $_GET['ajax'] == 'true') {

	define('WP_USE_THEMES', false);
	require_once('../../../wp-load.php');

	retrieveAbout();
}

function retrieveAbout () {

	$type = (isset($_GET['type'])) ? $_GET['type'] : '';
	$category = (isset($_GET['category'])) ? $_GET['category'] : 'general';

	if ($category == 'general') {

		while (have_posts()) {
			the_post();
			$attr = array('class' => 'group-photo');
			the_post_thumbnail('large', $attr);
			the_content();
		}
	}

	if ($type == 'committee') {

		$directorQuery = array( 'post_type' => 'directors', 'category_name' => $category, 'posts_per_page' => 2, 'order' => 'ASC' );
		$directorLoop = new WP_Query( $directorQuery );


		$committeeQuery = array( 'post_type' => 'committees', 'name' => $category, 'posts_per_page' => 1, 'orderby' => 'DESC' );
		$committeeLoop = new WP_Query( $committeeQuery );

		while ($committeeLoop->have_posts()) {
			$committeeLoop->the_post();
			global $post;
			$committeeName = get_the_title();
			$committeeContent = get_the_content();
			$meetingDay = get_post_meta($post->ID, 'meeting-day', true);
			$meetingTime = get_post_meta($post->ID, 'meeting-time', true);
			$meetingLocation = get_post_meta($post->ID, 'meeting-location', true);
		}

		$eventsQuery = array( 'post_type' => 'osi-events', 'category_name' => $category, 'posts_per_page' => 1, 'meta_key' => 'oe-form-start', 'orderby' => 'meta_value', 'order' => 'DESC');
		$eventsLoop = new WP_Query( $eventsQuery );

		while ($eventsLoop->have_posts()) {
			$eventsLoop->the_post();
			global $post;
			$eventDate = get_post_meta($post->ID, 'oe-form-start', true);
			$eventName = get_the_title();
			$eventImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			$eventDay = date('F', $eventDate);
			$eventMonth = date('j', $eventDate);
			$eventTime = date('g:i a', $eventDate);
		} ?>
		
		<div class="committee">
			<div class="committee-info">
				<h2><?php echo $committeeName; ?></h2>
				<h3>Responsibilities:</h3>
				<p><?php echo $committeeContent; ?></p>
			</div>
			<div class="meeting-info">
				<h2>Meeting Times</h2>
				<h3>When:</h3>
				<span><?php echo $meetingDay; ?></span>
				<span><?php echo $meetingTime; ?></span>
				<h3>Where:</h3>
				<span><?php echo $meetingLocation; ?></span>
			</div>
			<div class="featured-events">
				<h2>Upcoming Event</h2>
				<?php echo "<div class='next-event' style='background: url({$eventImage}) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;'>"; ?>
				<h2><?php echo $eventName; ?></h2>
				<?php //echo $eventImage; ?>
				<span><?php echo $eventMonth; ?></span>
				<span><?php echo $eventDay; ?></span>
				<span><?php echo $eventTime; ?></span>
				</div>
			</div>
		</div>

		<?php

		while ($directorLoop->have_posts()) {
			$directorLoop->the_post();
			$directorName = get_the_title();
			$directorContent = get_the_content();
			$directorImage = get_the_post_thumbnail();

		?>

		<div class="director">
			<?php echo $directorImage; ?>
			<div class="bio">
				<h3><?php echo $directorName; ?></h3>
				<p><?php echo $directorContent; ?></p>
			</div>
		</div> <?php

		}
	}

	else if ($type == 'director') {

		$directorQuery = array( 'post_type' => 'directors', 'category_name' => $category, 'posts_per_page' => 1, 'orderby' => 'DESC' );
		$directorLoop = new WP_Query( $directorQuery );

		while ($directorLoop->have_posts()) {
			$directorLoop->the_post();
			$directorName = get_the_title();
			$directorContent = get_the_content();
			$directorImage = get_the_post_thumbnail();
			$directorInfo = get_post_meta($post->ID, 'position-info', true);
		} ?>
		
		<div class="director">
			<div class="director-info">
				<h2><?php echo $directorName; ?></h2>
				<h3>Responsibilities:</h3>
				<p><?php echo $directorInfo; ?></p>
				<?php echo $directorImage; ?>
			</div>
			<div class="director-about">
				<p><?php echo $directorContent; ?></p>
			</div>
		</div> <?php
	}
}

?>