<?php require_once("../includes/initialize.php"); ?>
<?php
//call find all photos method
$photos = Photograph::find_all();
?>
<?php include_layout_template('header.php'); ?>
<?php include_layout_template('nav.php'); ?>
<!--loop through photos in database-->
<?php foreach($photos as $photo): ?>
  <div id="photo_gallery">
  <!--link to larger image on large_photo.php-->
		<a href="large_photo.php?id=<?php echo $photo->id; ?>">
		<!--ALT TEXT DOES NOT WORK ON CHROME!! USE TITLE INSTEAD!!-->
			<img src="<?php echo $photo->image_path(); ?>" width="20%" title="<?php echo $photo->caption;?>"/>
		</a>
		<!--caption commented out for style reasons-->
   <p><?php echo $photo->caption; ?></p>
  </div>
<?php endforeach; ?>

<?php include_layout_template('footer.php'); ?>


