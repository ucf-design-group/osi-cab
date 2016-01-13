jQuery(".committee-name").click(function (event) {
    event.preventDefault();
    var whichCommittee = jQuery(this).attr("id");
    var postType = 'committee';
    ContentSwap(whichCommittee, postType);
});
jQuery(".director-title").click(function (event) {
    event.preventDefault();
    var whichPosition = jQuery(this).attr("id");
    var postType = 'director';
    ContentSwap(whichPosition, postType);
});

function ContentSwap(whichCategory, postType) {
    var page = 1;  
    var loading = true;
    var $content = jQuery(".entry-content");
    var load_info = function(whichCategory) {
        jQuery.ajax({
            type       : "GET",  
            data       : {category : whichCategory, type : postType},  
            dataType   : "html",  
            url        : "http://osi.ucf.edu/cab/wp-content/themes/cab/aboutLoop.php",  // Check this.
            beforeSend : function() {},  
            success    : function(data){
                $content.hide();
                $content.empty();
                $content.append(data);
                $content.fadeIn(500);  
            },  
            error     : function(jqXHR, textStatus, errorThrown) {}
        });
    };
    load_info(whichCategory, postType);
}