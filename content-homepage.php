<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package OSI Starter Theme
 * @since OSI Starter Theme 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- <header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>.entry-header -->

	<div class="entry-content">
		<?php 
		global $post;
		$content = get_the_content(); ?>
		<div class="home-features">

		<?php
		$video_url = get_post_meta($post->ID, 'video-url', true);
		echo '<iframe src="' . $video_url . '" frameborder="0" width="480" height="270"></iframe>';

		$newsLoop = new WP_Query(array('post_type' => 'news', 'posts_per_page' => 2));
		while ($newsLoop->have_posts()) {
			$newsLoop->the_post(); ?>
			<h2><?php the_title(); ?></h2>
			<?php the_content();
		} ?>

		</div>
		<div class="home-content">
			<?php echo $content; ?>
		</div>

		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'osi_starter_theme' ), 'after' => '</div>' ) ); ?>
		<?php //edit_post_link( __( 'Edit', 'osi_starter_theme' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
