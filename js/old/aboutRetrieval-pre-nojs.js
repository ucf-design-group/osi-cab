/* About Retrieval - AJAX
 *
 * This code dynamically loads information about each committee
 * when links (.committee-name or .director-title) are activated.
 * It uses a AJAX and a separate PHP loop to get this information.
 * 
 * Note that the PHP loop acts differently depending on whether it
 * receives "committee" or "director" as in the postType GET.
 *
 */

// Click event handling

jQuery(".committee-name").click(function (event) {
        // Prevent the link from activating
    event.preventDefault();
        // Find out which committee was clicked (ID = post slug)
    var whichCommittee = jQuery(this).attr("id");
        // Declare that a Committee, not Director, was selected
    var postType = 'committee';
        // Call the function
    ContentSwap(whichCommittee, postType);
});
jQuery(".director-title").click(function (event) {
        // Prevent the link from activating
    event.preventDefault();
        // Find out which director was clicked (ID = category slug)
    var whichPosition = jQuery(this).attr("id");
        // Declare that a Director, not Committee, was selected
    var postType = 'director';
        // Call the function
    ContentSwap(whichPosition, postType);
});

// AJAX Retrieval and data handling

function ContentSwap(whichCategory, postType) {
    var page = 1;  
    var loading = true;
        // We're going to be working with a <div> with class "entry-content"
    var $content = jQuery(".entry-content");

    // We're not sure why a variable is a function, but it works.

    var load_info = function(whichCategory) {
        jQuery.ajax({

                // Access a separate PHP loop with several GET variables
            type       : "GET",  
            data       : {category : whichCategory, type : postType},  
            dataType   : "html",  
            url        : "http://osi.ucf.edu/cab/wp-content/themes/cab/aboutLoop.php", // Warning: Absolute Path
            
                // We do not want anything to activate before the AJAX works
            beforeSend : function() {},

                // On success, we want to display the HTML output from the PHP loop
            success    : function(data){
                    // Before we change anything, hide the entire <div>
                $content.hide();
                    // Empty whatever is in there right now
                $content.empty();
                    // Add in whatever the AJAX returned
                $content.append(data);
                    // Fade in, slow and smooth
                $content.fadeIn(500);  
            },

                // If there's an error... Don't Worry, Be Happy
            error     : function(jqXHR, textStatus, errorThrown) {}
        });
    };

        // Oh yeah... we have to call the function we just defined.
    load_info(whichCategory, postType);
}

/* Notes:
 * 
 * Credit for the majority of this code comes from a tutorial:
 * http://wp.tutsplus.com/tutorials/getting-loopy-ajax-powered-loops-with-jquery-and-wordpress/
 *
 * - AJ Foster
 */