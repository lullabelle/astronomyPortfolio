<?php require_once("../includes/initialize.php"); ?>

<?php
//ERROR HANDLING		
//check to see if ID is found if not return to photo_gallery
  if(empty($_GET['id'])) {
    $session->message("No photo ID.");
    redirect_to('photo_gallery.php');
  }
  
  $photo = Photograph::find_by_id($_GET['id']);
//if photo was not found  
  if(!$photo) {
    $session->message("The photo was not found.");
    redirect_to('photo_gallery.php');
  }
 ?>
  
<?php include_layout_template('header.php'); ?>
<!--provide back link to return to photo gallery page -->
  <a href="photo_gallery.php">&laquo; Back</a><br />
<br />

<div id="photo">
<!--ALT TEXT DOES NOT WORK ON CHROME!! USE TITLE INSTEAD!!-->
  <img src="<?php echo $photo->image_path();?>" width="50% "title="<?php echo $photo->caption;?>"/>
  <p><?php echo $photo->caption; ?></p>
</div>
 <?php include_layout_template('footer.php'); ?> 