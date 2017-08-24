<?php require_once("../../includes/initialize.php"); ?>
<!--check if session is still logged in and redirect if needed-->
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php

//Find all photos
$photos = Photograph::find_all();
?>
<?php include_layout_template('admin_header.php'); ?>

<h2>Photographs</h2>
<!--find all photos in database and add to this table-->
<?php echo output_message($message); ?>
<table class="bordered">
  <tr>
    <th>Image</th>
    <th>Filename</th>
    <th>Caption</th>
    <th>Size</th>
    <th>Type</th>
		<th>Comments</th>
		<th>&nbsp;</th>
  </tr>
  <!--loop through photos in database-->
<?php foreach($photos as $photo){ ?>
  <tr>
<!-- photo class will handle the image path -->
    <td><img src="../<?php echo $photo->image_path(); ?>" width="100" /></td>
    <td><?php echo $photo->filename; ?></td>
    <td><?php echo $photo->caption; ?></td>
    <td><?php echo $photo->image_size(); ?></td>
    <td><?php echo $photo->type; ?></td>
  </tr>
<?php } ?>
</table>
<br />
<!--redirect to photo_upload page-->
<a href="upload_photo.php">Upload a new photograph</a>
<br />
<br />
<?php include_layout_template('footer.php'); ?>