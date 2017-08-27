<?php require_once("../../includes/initialize.php"); 
 if (!$session->is_logged_in()) { redirect_to("login.php"); }

// must have an ID if not redirect
  if(empty($_GET['id'])) {
  	$session->message("No comment ID was provided.");
    redirect_to('photo_gallery.php');
  }
// find comment by id  
 $comment = Comment::find_by_id($_GET['id']);
  if($comment && $comment->delete()) {
    $session->message("Comment deleted.");
// can still work with comment instance even though db entry deleted to  id and return	
    redirect_to("photo_comments.php?id={$comment->photograph_id}");
  } else {
    $session->message("Comment could not be deleted.");
    redirect_to('photo_list.php');
  }
  
/* ensure the database connection is closed */
 if(isset($db)) { $db->close_dbconnection(); }  
?>
