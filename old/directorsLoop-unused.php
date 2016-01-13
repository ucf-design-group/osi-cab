<?php

// Our include  
define('WP_USE_THEMES', false);  
require_once('../../../wp-load.php');


// Our variables  
$whatCommittee = (isset($_GET['committee'])) ? $_GET['committee'] : '';
$directorQuery = array(  'post_type' => 'directors', 'category_name' => $whatCommittee, 'posts_per_page' => 1, 'orderby' => 'DESC' );
$showDirector = new WP_Query( $directorQuery );
while ( $showDirector->have_posts() ) : $showDirector->the_post();
	$directorName = get_the_title();
	$directorContent = get_the_content();
	$directorImage = get_the_post_thumbnail();
endwhile;

$committeeQuery = array(  'post_type' => 'committees', 'posts_per_page' => -1, 'orderby' => 'DESC' );
$showCommittee = new WP_Query( $committeeQuery );
while ( $showCommittee->have_posts() ) : $showCommittee->the_post();
$currentCommittee = get_the_title();
$currentCommittee = strtolower($currentCommittee);

	if ( $currentCommittee == $whatCommittee ){
		$committeeName = get_the_title();
		$committeeContent = get_the_content();
		$meetingDay = get_post_meta($post->ID, 'meeting-day', true);
		$meetingTime = get_post_meta($post->ID, 'meeting-time', true);
		$meetingLocation = get_post_meta($post->ID, 'meeting-location', true);
	}
endwhile;
$eventsQuery = array(  'post_type' => 'events', 'category_name' => $whatCommittee, 'posts_per_page' => 2, 'orderby' => 'DESC' );
$showEvents = new WP_Query( $eventsQuery );
while ( $showEvents->have_posts() ) : $showEvents->the_post();
	$thedate = get_post_meta($post->ID, 'events-date', true);
	$eventName = get_the_title();
	$eventImage = get_the_post_thumbnail();
	$eventDay = date('F', $thedate);
	$eventMonth = date('j', $thedate);
	$eventTime = date('g:i a', $thedate);
endwhile;
?>
<div class="committee">
	<h2><?php echo $committeeName; ?></h2>
	<p><?php echo $committeeContent; ?></p>
</div>
<div class="meeting-info">
	<span><?php echo $meetingDay; ?></span>
	<span><?php echo $meetingTime; ?></span>
	<span><?php echo $meetingLocation; ?></span>
</div>
<div class="featured-event">
	<h3>Featured Event</h3>
	<h4><?php echo $eventName; ?></h4>
	<?php echo $eventImage; ?>
	<span><?php echo $eventMonth; ?></span>
	<span><?php echo $eventDay; ?></span>
	<span><?php echo $eventTime; ?></span>
</div>
<div class="director">
	<h3><?php echo $directorName; ?></h3>
	<p><?php echo $directorContent; ?></p>
	<?php echo $directorImage; ?>
</div>
