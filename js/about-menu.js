/* About Page Menu Toggling
 * 
 * This code changes the class of the <ul> with ID "committee-menu"
 * depending on the screen size.  It also swaps the text in the
 * <h2> title for the menu, between "Committees:" and "Scroll right
 * for more committees"
 */

jQuery( document ).ready( function( $ ) {
	var $aboutmenu = $( '#committee-menu' ),
		$title = $('.committees h2'),
	    timeout = false;

	$.fn.smallAbout = function() {
		$aboutmenu.removeClass( 'about-menu-large' );
		$aboutmenu.addClass( 'about-menu-small' );
		$title.text('Scroll right for more committees');
		var snapScroll = new iScroll('committee-menu-wrapper', {
			hScroll: true,
			vScroll: false,
			hScrollbar: false,
			vScrollbar: false,
			snap: true,
			momentum: false
		});
		setTimeout(function () {
			snapScroll.refresh();
		} , 0);
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