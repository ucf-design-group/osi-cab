<?php
/**
 * Template Name: About-OLD
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
				<div class="committees">
					<h2>Committees:</h2>
					<div id="committee-menu-wrapper" class="committee-options">
						<ul id="committee-menu" class="about-menu-large">

						<?php
						$committeesQuery = array( 'post_type' => 'committees', 'posts_per_page' => -1, 'order_column' => 'post_name', 'orderby' => 'ASC' );
						$loop = new WP_Query( $committeesQuery );
						while ( $loop->have_posts() ) : $loop->the_post();
							$whatCommittee = strtolower( get_the_title() );
							$slug = $post->post_name;
							echo '<li class="slide"><a id="'. $slug .'" class="committee-name" href="#">'.get_the_title().'</a></li>
										';
						endwhile;
						$studentDirectorQuery = array( 'post_type' => 'directors', 'posts_per_page' => -1, 'category_name' => 'student-director');
						$studentDirectorloop = new WP_Query( $studentDirectorQuery );
						while ( $studentDirectorloop->have_posts() ) : $studentDirectorloop->the_post();
							$slug = $post->post_name;
							echo '<li class="slide"><a id="'. $slug .'" class="director-title" href="#">Student Director</a></li>
										';
						endwhile;
						$asstStudentDirectorQuery = array( 'post_type' => 'directors', 'posts_per_page' => -1, 'category_name' => 'assistant-student-director');
						$asstStudentDirectorloop = new WP_Query( $asstStudentDirectorQuery );
						while ( $asstStudentDirectorloop->have_posts() ) : $asstStudentDirectorloop->the_post();
							$slug = $post->post_name;
							echo '<li class="slide"><a id="'. $slug .'" class="director-title" href="#">Assistant Student Director</a></li>
										';
						endwhile;
						$gradAsstQuery = array( 'post_type' => 'directors', 'posts_per_page' => -1, 'category_name' => 'graduate-assistant');
						$gradAsstloop = new WP_Query( $gradAsstQuery );
						while ( $gradAsstloop->have_posts() ) : $gradAsstloop->the_post();
							$slug = $post->post_name;
							echo '<li class="slide"><a id="'. $slug .'" class="director-title" href="#">Graduate Assistant</a></li>
										';
						endwhile; ?>
					</ul>
					</div>	
				</div>

				<?php while ( have_posts() ) : the_post(); ?>
					<!-- entry-content -->
					<article>
						<div class="entry-content">
							<?php
								$attr = array(
									'class'	=> "group-photo",
								);
							?>
							<?php the_post_thumbnail( 'large', $attr ); ?>
							<?php the_content(); ?>
						</div>
					</article>
					<?php //the_post_thumbnail( 'large' ); ?>
					<?php //get_template_part( 'content', 'page' ); ?>

				<?php endwhile; ?>
				
			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
	<script src="<?php bloginfo('template_directory'); ?>/js/iscroll.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/about-menu.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/aboutRetrieval.js" type="text/javascript"></script>
		
<?php get_footer(); ?>