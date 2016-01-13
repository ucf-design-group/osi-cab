<?php

// Our include  
define('WP_USE_THEMES', false);  
require_once('../../../wp-load.php');

if ($_GET['type'] == 'committee') {

	// Our variables  
	$whatCommittee = (isset($_GET['category'])) ? $_GET['category'] : '';
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
	$currentCommittee = $post->post_name;

		if ( $currentCommittee == $whatCommittee ){
			$committeeName = get_the_title();
			$committeeContent = get_the_content();
			$meetingDay = get_post_meta($post->ID, 'meeting-day', true);
			$meetingTime = get_post_meta($post->ID, 'meeting-time', true);
			$meetingLocation = get_post_meta($post->ID, 'meeting-location', true);
		}
	endwhile;
	$eventsQuery = array(  'post_type' => 'events', 'category_name' => $whatCommittee, 'posts_per_page' => 1, 'orderby' => 'ASC' );
	$showEvents = new WP_Query( $eventsQuery );
	while ( $showEvents->have_posts() ) : $showEvents->the_post();
		$thedate = get_post_meta($post->ID, 'events-date', true);
		$eventName = get_the_title();
		$eventImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );//get_the_post_thumbnail();
		$eventDay = date('F', $thedate);
		$eventMonth = date('j', $thedate);
		$eventTime = date('g:i a', $thedate);
	endwhile;
	?>
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
	<div class="director">
		<?php echo $directorImage; ?>
		<div class="bio">
			<h3><?php echo $directorName; ?></h3>
			<p><?php echo $directorContent; ?></p>
		</div>
	</div>
<?php }



else if ($_GET['type'] == 'director') {

	// Our variables
	$whatDirector = (isset($_GET['category'])) ? $_GET['category'] : '';
	$directorQuery = array(  'post_type' => 'directors', 'name' => $whatDirector, 'posts_per_page' => 1);
	$showDirector = new WP_Query( $directorQuery );
	while ( $showDirector->have_posts() ) : $showDirector->the_post();
		$directorName = get_the_title();
		$directorContent = get_the_content();
		$directorImage = get_the_post_thumbnail();
		$directorInfo = get_post_meta($post->ID, 'position-info', true);
	endwhile;
	?>
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
	</div>

<?php } ?>