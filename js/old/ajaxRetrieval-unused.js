jQuery(".committee-name").click(function (event) {
    event.preventDefault();
    var whichCommittee = jQuery(this).text();
    whichCommittee = whichCommittee.toLowerCase();
    ContentSwap(whichCommittee);
});

function ContentSwap(whichCommittee) { 
    var page = 1;  
    var loading = true;
    var $content = jQuery(".entry-content");
    var load_info = function(whichCommittee) {
        jQuery.ajax({
            type       : "GET",  
            data       : {committee : whichCommittee},  
            dataType   : "html",  
            url        : "http://osi.ucf.edu/cab/wp-content/themes/cab/directorsLoop.php",  // Check this.
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
    load_info(whichCommittee);
}
