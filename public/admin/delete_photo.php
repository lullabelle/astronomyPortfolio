<?php require_once("../../includes/initialize.php"); 
 if (!$session->is_logged_in()) { redirect_to("login.php"); } 

// check that the photo ID was passed in URL string
  if(empty($_GET['id'])) {
  	$session->message("No photograph ID was provided.");
    redirect_to('index.php');
  }

  $photo = Photograph::find_by_id($_GET['id']);
  if($photo && $photo->delete_photo()) {
//filename can still be used because php still holds on to the 'object' after file and sql entry deleted	  
    $session->message("The photo {$photo->filename} was deleted.");
    redirect_to('photo_list.php');
  } else {
    $session->message("The photo could not be deleted.");
    redirect_to('photo_list.php');
  }
  

/* ensure the database connection is closed */
 if(isset($db)) { $db->close_dbconnection(); } 
 ?>
