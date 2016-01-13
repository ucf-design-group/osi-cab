/* Event Retrieval - AJAX
 *
 * This code dynamically loads more events (either past or future)
 * to the events page.  It is activated once by the scrollbeacon
 * plugin when the "Load More Events" <div> (.load-events)
 * appears on the screen.  Unfortunately we cannot do this more
 * than once, because the browser does not update the <div>'s
 * position after more events have been displayed.
 * 
 * The action is also triggered by clicking the "Load More Events"
 * link.
 *
 */

// Click event handling

jQuery(".load-events").on("click", function(event){
        // Prevent the link from activating
    event.preventDefault();
        // Find out whether to load past or future events
    var strand = jQuery(this).parents("div.past, div.future").attr("class");
        // Grab the ID of the <div>, which is the timestamp of the last event to be displayed
    var startEvent = jQuery(this).attr("id");
        // Define the "Load More Events" <div> as "content" for manipulation later
	var content = jQuery(this);
        // Call the function
    LoadEvents(strand, startEvent, content);
});

// Scrollbeacon event handling

jQuery(".load-events").scrollbeacon({
    appear: function () {
            // Find out whether to load past or future events
        var strand = jQuery(this).parents("div.past, div.future").attr("class");
            // Grab the ID of the <div>, which is the timestamp of the last event to be displayed
        var startEvent = jQuery(this).attr("id");
            // Define the "Load More Events" <div> as "content" for manipulation later
        var content = jQuery(this);
            // Call the function
        LoadEvents(strand, startEvent, content);
    }
});

// AJAX Retrieval and data handling

function LoadEvents(strand, startEvent, content) {
    var $content = jQuery(content);

    // We're not sure why a variable is a function, but it works.

    var load_info = function(strand, startEvent) {
        jQuery.ajax({

                // Access a separate PHP loop with several GET variables
            type       : "GET",
            data       : {pastorfuture : strand, start : startEvent, number : 5},
            dataType   : "html",
            url        : "http://osi.ucf.edu/cab/wp-content/themes/cab/eventsLoop.php", // Warning: Absolute Path
            
                // We do not want anything to activate before the AJAX works
            beforeSend : function() {},

                // On success, we want to display the HTML output from the PHP loop
            success    : function(data){
				$data = jQuery(data);
                    // Before we add the HTML data, hide it
				$data.hide();
                    // Add the new events before the "Load More Events" <div>
                $content.before($data);
                    // Show the new events, slow and smooth
				$data.show("slow");
                    // Now, check the ID of the last event in the list
                var $lastevent = $content.prev('.events');
                var $lastid = $lastevent.attr('id');
                    // If doesn't have an ID of "lastevent", then use the last event's ID
                    // (which will be its UTC timestamp) as the new ID of "Load More Events"
                    // ... and destroy the scrollbeacon. 
                if ($lastid != 'lastevent') {
                    $lastevent.removeAttr('id');
                    $content.attr('id', $lastid);
                    $content.data('scrollbeacon').destroy();
                }
                    // If it has an ID of "lastevent", then remove the "Load More Events" <div>
                else {
                    $content.remove();
                }
            },

                // If there's an error... Don't Worry, Be Happy
            error     : function(jqXHR, textStatus, errorThrown) {}
        });
    };

        // Oh yeah... you have to call the function you just defined.
    load_info(strand, startEvent);
}

/* Notes:
 * 
 * Credit for the majority of this code comes from a tutorial:
 * http://wp.tutsplus.com/tutorials/getting-loopy-ajax-powered-loops-with-jquery-and-wordpress/
 *
 * - AJ Foster
 */