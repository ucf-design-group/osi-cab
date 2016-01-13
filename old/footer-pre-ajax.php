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

					<a class="logos" href="#"><img src="http://osi.ucf.edu/images/footer/get_involved_ucf_logo.png" alt="Get Involved Ucf" /></a>

					<a class="logos" href="#"><img src="http://osi.ucf.edu/images/footer/ucf_logo.png" alt="UCF Logo" /></a>

					<a class="logos" href="#"><img src="http://osi.ucf.edu/images/footer/sga_logo.png" alt="Student Government Association" /></a>
				
					<a class="logos" href="#"><img src="http://osi.ucf.edu/images/footer/design_group_logo.png" alt="Design Group" /></a>
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
<script src='http://osi.ucf.edu/cab/wp-content/themes/cab/js/ajaxRetrieval.js'></script>
</body>
</html>