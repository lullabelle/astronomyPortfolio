<?php require_once("../../includes/initialize.php"); ?>
<!--check if session is still logged in and redirect if needed-->
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php

//Find all photos
$photos = Photograph::find_all();
?>
<?php include_layout_template('admin_header.php');?>
<?php include_layout_template('admin_nav.php'); ?>
<div class ="body-container">
<div class ="list_header">
<h2>List of Site Photos</h2>
</div>
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
<!--displays comment count as a link to view comments and delete them -->	
	<td><a href="photo_comments.php?id=<?php echo $photo->id; ?>"><?php echo count($photo->comments()); ?></a></td>
<!--redirect to delete photo page passing in ID via URL-->
	<td><a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a></td>
  </tr>
<?php } ?>
</table>
<br />
<!--redirect to photo_upload page-->
	<a href="upload_photo.php">Upload a new photograph</a>
	<br />
	<br />
</div>

<?php include_layout_template('footer.php'); ?>
