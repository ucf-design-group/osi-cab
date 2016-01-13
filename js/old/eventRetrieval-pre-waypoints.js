jQuery(".load-events").live("click", function(){
    var strand = jQuery(this).parents("div.past, div.future").attr("class");
    var startEvent = jQuery(this).parent().attr("id");
	var content = jQuery(this);
    LoadEvents(strand, startEvent, content);
});

function LoadEvents(strand, startEvent, content) {

    var $content = jQuery(content);
    var load_info = function(strand, startEvent) {
        jQuery.ajax({
            type       : "GET",
            data       : {pastorfuture : strand, start : startEvent, number : 5},
            dataType   : "html",
            url        : "http://osi.ucf.edu/cab/wp-content/themes/cab/eventsLoop.php",
            beforeSend : function() {},
            success    : function(data){
                $content.hide();
				$data = jQuery(data);
				$data.hide();
                $content.parent().after($data);
				$data.show("slow");
                $content.remove();
            },
            error     : function(jqXHR, textStatus, errorThrown) {}
        });
    };
    load_info(strand, startEvent);
}