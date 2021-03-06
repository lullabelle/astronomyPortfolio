<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php

	if(isset($_POST['submit'])) {// post super global
		$photo = new Photograph();
		$photo->caption = $_POST['caption'];
	//attach_file method from photograph class
		$photo->attach_file($_FILES['file_upload']);
	//save function from photograph class	
		if($photo->save()) {
	// if successful - message stored in session variable to display on the list photos 
	//page on redirect
		$session->message("Photograph uploaded.");
		redirect_to('photo_list.php');	
		} else {
	// Failure - output from errors array in photo class
		$message = join("<br />", $photo->errors);
		
		}
		
	}
?>

<?php include_layout_template('admin_header.php'); ?>
<?php include_layout_template('admin_nav.php'); ?>

<div class="body-container">
<div class ="list_header">
	<h2>Upload Photos</h2>
</div>	
<!--HTML form to submit-->
	<?php echo output_message($message);?>
	
  <form action="upload_photo.php" enctype="multipart/form-data" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
    <p><input type="file" name="file_upload" /></p>
    <p>Caption: <input type="text" name="caption" value="" /></p>
    <input type="submit" name="submit" value="Upload" />
  </form>
  
</div>
<?php include_layout_template('admin_footer_short.php'); ?>