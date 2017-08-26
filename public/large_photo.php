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
 //COMMENTS 
    if(isset($_POST['submit'])) {
	  $author = trim($_POST['author']);
	  $body = trim($_POST['body']);
//create new comment using the method in comment class and attempt save	
	  $new_comment = Comment::create_comment($photo->id, $author, $body);
	  if($new_comment && $new_comment->save()) {
//comment saved, redirect page to itself to refresh and display
//otherwise comment will be submitted again
	    redirect_to("large_photo.php?id={$photo->id}");
		} else {
// comment failed
	    $message = "There was an error that prevented the comment from being saved.";
		}
	} else {
		$author = "";
		$body = "";
	}
//find the comments related to that photo	
	$comments = Comment::find_comments($photo->id);
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

<!--List back comments for current photo-->
<!-- loop through comments and sanitize user data using htmlentities and strip tags -->
<div id="comments">
  <?php foreach($comments as $comment){ ?>
    <div class="comment" style="margin-bottom: 2em;">
	    <div class="author">
	      <?php echo htmlentities($comment->author); ?> added:
	    </div>
      <div class="body">
				<?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
			</div>
	    <div class="meta-info" style="font-size: 0.8em;">
	      <?php echo datetime_to_text($comment->created); ?>
	    </div>
    </div>
  <?php } ?>
  <?php if(empty($comments)) { echo "No comments "; } ?>
</div>

<!-- Comment form to submit new comment -->
<div id="comment-form">
  <h3>Add a Comment</h3>
  <?php echo output_message($message); ?>
  <form action="large_photo.php?id=<?php echo $photo->id; ?>" method="post">
    <table>
      <tr>
        <td>Your name:</td>
        <td><input type="text" name="author" value="<?php echo $author; ?>" /></td>
      </tr>
      <tr>
        <td>Your comment:</td>
        <td><textarea name="body" cols="40" rows="8"><?php echo $body; ?></textarea></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="submit" value="Submit Comment" /></td>
      </tr>
    </table>
  </form>
</div>

 <?php include_layout_template('footer.php'); ?> 