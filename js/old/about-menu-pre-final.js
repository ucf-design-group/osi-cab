/**
 * Handles toggling the main navigation menu for small screens.
 */
jQuery( document ).ready( function( $ ) {
	var $aboutmenu = $( '#committee-menu' ),
		$title = $('.committees h2'),
	    timeout = false;

	$.fn.smallAbout = function() {
		$aboutmenu.removeClass( 'about-menu-large' );
		$aboutmenu.addClass( 'about-menu-small' );
		$title.text('Scroll right for more committees');
	};

	// Check viewport width on first load.
	if ( $( window ).width() < 767 )
		$.fn.smallAbout();

	// Check viewport width when user resizes the browser window.
	$( window ).resize( function() {
		var browserWidth = $( window ).width();

		if ( false !== timeout )
			clearTimeout( timeout );

		timeout = setTimeout( function() {
			if ( browserWidth < 767 ) {
				$.fn.smallAbout();
			} else {
				$aboutmenu.removeClass( 'about-menu-small' ).addClass( 'about-menu-large' );
				$title.text('Committees:');
			}
		}, 200 );
	} );
} );