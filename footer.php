<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package OSI Starter Theme
 * @since OSI Starter Theme 1.0
 */
?>

	</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
					<?php do_action( '_s_credits' ); ?>

					<a class="logos" href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer/get_involved_ucf_logo.png" alt="Get Involved Ucf" /></a>

					<a class="logos" href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer/ucf_logo.png" alt="UCF Logo" /></a>

					<a class="logos" href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer/sga_logo.png" alt="Student Government Association" /></a>
				
					<a class="logos" href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer/design_group_logo.png" alt="Design Group" /></a>
					<p>
						© 2012 University of Central Florida Office of Student Involvement<br />
						Student Union, Room 208, P.O. Box 163245, Orlando, Fl 32816-3245<br />
						Email: <a href="mailto:osi@mail.ucf.edu">osi@mail.ucf.edu</a> | ph: 407.823.6471 | fx: 407.823.5899
					</p>
				</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>
<script type="text/javascript">
	var visible = false;
	function changeText(){
		if ( visible == false ){
			visible = true;
			document.getElementById('expand-menu').innerHTML = 'Tap to close';
		}
		else{
			visible = false;
			document.getElementById('expand-menu').innerHTML = 'Tap for menu';
		}
	}
</script>
<!-- <script src='http://osi.ucf.edu/cab/wp-content/themes/cab/js/ajaxRetrieval.js'></script> -->
<!-- <script src='http://osi.ucf.edu/cab/wp-content/themes/cab/js/eventRetrieval.js'></script> -->
<!-- <script src='http://osi.ucf.edu/cab/wp-content/themes/cab/js/live.js'></script> -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-9046652-5']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php

if (time() > strtotime("7/4/2013 12:01am") && time() < strtotime("7/4/2013 11:59pm")) {

?>

<SCRIPT type="text/javascript" SRC="<?php echo site_url(); ?>/fireworks/JSFX_Layer.js"></SCRIPT>
<SCRIPT type="text/javascript" SRC="<?php echo site_url(); ?>/fireworks/JSFX_Browser.js"></SCRIPT>
<SCRIPT type="text/javascript" SRC="<?php echo site_url(); ?>/fireworks/JSFX_Fireworks3.js"></SCRIPT>
<SCRIPT type="text/javascript">
	jQuery(document).ready(function(){
		JSFX_StartEffects();
	});
	function JSFX_StartEffects()
	{
		JSFX.Fire(40, 100, 100);
		setTimeout("JSFX.Fire(40, 100, 100)", 1000);
	}
</SCRIPT>
<?php
}
?>
</body>
</html>