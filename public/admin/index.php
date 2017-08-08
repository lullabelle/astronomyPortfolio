<?php
require_once('../../includes/functions.php');
require_once('../../includes/session.php');

if(!$session->is_logged_in()) {
	redirect_to("login.php");
	}
?>

<div id="help">
	<h2 style="text-align:left;"> Welcome to astrogallery administration portal</h2>
	<p> Please make a selection from the menu on the left hand side to upload new images or videos. 
	The site administrator may also delete content including user comments. Please choose the help file
	if you require further assistance.
	</p>

	
	</div>