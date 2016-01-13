<?php

require_once('recaptchalib.php');

$publickey = "6LfT798SAAAAAFaD-s1oxk3wV0xaGVEU-OVcx-ut";
$privatekey = "6LfT798SAAAAAN41K4CzzNOAWPAcOm6zRiTVhaqu";

$resp = null;
$error = null;

define('NO_SUBMIT', 0);
define('EMPTY_USERSNAME', 1);
define('EMPTY_USEREMAILADDRESS', 2);
define('EMPTY_SUBJECT', 3);
define('EMPTY_CONTENT', 4);
define('INVAL_EMAIL', 5);
define('SUCCESS', 6);
define('FAILURE', 7);
define('INVAL_CAPTCHA', 8);

$status = NO_SUBMIT;

if (isset($_POST['sendmail']) && $_POST['sendmail'] == 'Send' && isset($_POST['recaptcha_response_field']))
	$status = sendMail();

//var_dump(error_get_last());

function sendMail() {

	ini_set("SMTP", "ucfsmtp1.mail.ucf.edu");

	$publickey = "6LfT798SAAAAAFaD-s1oxk3wV0xaGVEU-OVcx-ut";
	$privatekey = "6LfT798SAAAAAN41K4CzzNOAWPAcOm6zRiTVhaqu";

	$resp = recaptcha_check_answer($privatekey, "http://osi.ucf.edu/", $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

	if (!isset($_POST['usersname']) || $_POST['usersname'] == '')
		return EMPTY_USERSNAME;
	else if (!isset($_POST['useremailaddress']) || $_POST['useremailaddress'] == '')
		return EMPTY_USEREMAILADDRESS;
	if (!isset($_POST['superspecialsubject']) || $_POST['superspecialsubject'] == '')
		return EMPTY_SUBJECT;
	if (!isset($_POST['superspecialcontent']) || $_POST['superspecialcontent'] == '')
		return EMPTY_CONTENT;
	if (!filter_var($_POST['useremailaddress'], FILTER_VALIDATE_EMAIL))
		return INVAL_EMAIL;

	if (!($resp->is_valid)) {
		$error = $resp->error;
		return INVAL_CAPTCHA;
	}

	$recipient = "cab@ucf.edu";
	$subject = "Website Feedback: " . $_POST['superspecialsubject'];
	$message = "The following message was submitted as feedback from the CAB Website:\n\n";
	$message .= "From: " . $_POST['usersname'] . " <" . $_POST['useremailaddress'] . ">" . "\n";
	$message .= "Subject: " . $_POST['superspecialsubject'] . "\n\n";
	$message .= "Message Content:\n\n" . $_POST['superspecialcontent'] . "\n\n\n";
	$message .= "[If you have trouble with these emails, contact AJ at Design Group.]";
	$header = "From: CAB Website <cab@ucf.edu>";

	if (mail($recipient, $subject, $message, $header))
		return SUCCESS;
	else
		return FAILURE;
}

$message = null;

switch ($status) {
	case EMPTY_USERSNAME:
		$message = "Please provide your name.";
		break;
	case EMPTY_USEREMAILADDRESS:
		$message = "Please provide your email.";
		break;
	case EMPTY_SUBJECT:
		$message = "Please provide a subject.";
		break;
	case EMPTY_CONTENT:
		$message = "Please provide content to the message.";
		break;
	case INVAL_EMAIL:
		$message = "Please provide a valid e-mail address.";
		break;
	case SUCCESS:
		$message = "Thank you!  Your feedback has been submitted.";
		break;
	case FAILURE:
		$message = "So sorry!  Your feedback could not be submitted.  We're working on this!";
		break;
	case INVAL_CAPTCHA:
		$message = "Either the text you entered was incorrect or it couldn't be processed.";
		break;
}

$name = isset($_POST['usersname']) ? $_POST['usersname'] : '';
$email = isset($_POST['useremailaddress']) ? $_POST['useremailaddress'] : '';
$subject = isset($_POST['superspecialsubject']) ? $_POST['superspecialsubject'] : '';
$content = isset($_POST['superspecialcontent']) ? $_POST['superspecialcontent'] : '';

?>