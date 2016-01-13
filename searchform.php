<?php
/**
 * The template for displaying search forms in OSI Starter Theme
 *
 * @package OSI Starter Theme
 * @since OSI Starter Theme 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'osi_starter_theme' ); ?></label>
		<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'osi_starter_theme' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'osi_starter_theme' ); ?>" />
	</form>
