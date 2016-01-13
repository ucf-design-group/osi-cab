<?php
/**
 * The Template for displaying all single posts.
 *
 * @package OSI Starter Theme
 * @since OSI Starter Theme 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content event-single" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				$eventDate = intval(get_post_meta($post->ID, 'oe-form-start', true));
				//echo $eventDate;
				$date = date('F j S, g:i a', $eventDate);
				$linkToAlbum = get_post_meta($post->ID, 'oe-form-url', true);
				$category = get_the_category();
				$category = str_replace(" ", "-", strtolower( $category[0]->cat_name ));
				$link = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				
				
				<div class="event-info">
					<h1><?php the_title() ?></h1>
					<div class="event-poster">
						<a href='<?php echo $link ?>'><?php the_post_thumbnail('medium', $poster) ?></a>
					</div>
					<div class="event-text">
						<h2><?php echo $date ?></h2>
						<?php the_content() ?>
						<a href='<?php echo site_url(); ?>/committees-contact'><img src='<?php bloginfo('template_directory'); ?>/images/<?php echo $category ?>.png' alt='Committee' /></a>
						<a href='<?php echo $linkToAlbum ?>'><img src='<?php bloginfo('template_directory'); ?>/images/pictures-icon.png' alt='Event Photos' /></a>
					</div>
					<div class="event-footer"></div>
				</div>
			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>