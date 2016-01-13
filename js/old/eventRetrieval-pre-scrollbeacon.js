jQuery(".load-events").on("click", function(){
    var strand = jQuery(this).parents("div.past, div.future").attr("class");
    var startEvent = jQuery(this).attr("id");
	var content = jQuery(this);
    LoadEvents(strand, startEvent, content);
});

jQuery(".load-events").waypoint(function(){
    var strand = jQuery(this).parents("div.past, div.future").attr("class");
    var startEvent = jQuery(this).attr("id");
    var content = jQuery(this);
    LoadEvents(strand, startEvent, content);
}, {
    offset: '100%'
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
				$data = jQuery(data);
				$data.hide();
                $content.before($data);
				$data.show("slow");
                var $lastevent = $content.prev('.events');
                var $lastid = $lastevent.attr('id');
                if ($lastid != 'lastevent') {
                    $lastevent.removeAttr('id');
                    $content.attr('id', $lastid);
                    $content.waypoint('remove');
                    $content.waypoint();
                }
                else {
                    $content.remove();
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {}
        });
    };
    load_info(strand, startEvent);
    jQuery.waypoints('refresh');
}