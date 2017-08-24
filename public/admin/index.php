<?php
require_once('../../includes/initialize.php');
if(!$session->is_logged_in()) {
	redirect_to("login.php");
	}
?>
<?php include_layout_template('admin_header.php');?>
<?php include_layout_template('admin_nav.php'); ?>
<div id="help">
	<h2 style="text-align:left;"> Welcome to astrogallery administration portal</h2>
	<p> Please make a selection from the menu on the left hand side to upload new images or videos. 
	The site administrator may also delete content including user comments. Please choose the help file
	if you require further assistance.
	</p>
		<li><a href="logout.php">Logout</a></li>
	
	</div>
<?php include_layout_template('footer.php');?>	