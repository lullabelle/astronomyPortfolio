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

<div id="large_photo">
<!--ALT TEXT DOES NOT WORK ON CHROME!! USE TITLE INSTEAD!!-->
  <img src="<?php echo $photo->image_path();?>" width="50% "title="<?php echo $photo->caption;?>"/>
  <p><?php echo $photo->caption; ?></p>
</div>

<!--List back comments for current photo-->
<!-- loop through comments and sanitize user data using htmlentities and strip tags -->
<div class ="body-container">
<div id="comments">
  <?php foreach($comments as $comment){ ?>
    <div style="margin-bottom: 2em;">
	    <div>
	      <?php echo htmlentities($comment->author); ?> added:
	    </div>
      <div>
				<?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
			</div>
	    <div style="font-size: 0.8em;">
	      <?php echo datetime_to_text($comment->created); ?>
	    </div>
    </div>
  <?php } ?>
  <?php if(empty($comments)) { echo "No comments "; } ?>
</div>

<!-- Comment form to submit new comment -->

<div id="comment_form">
  <h3>Add a Comment</h3>
  <?php echo output_message($message); ?>
  <form action="large_photo.php?id=<?php echo $photo->id; ?>" method="post">
          
	  <div><input type="text" name="author" value="<?php echo $author; ?>" placeholder="Name" /></div>
	  <div><textarea name="body" placeholder="Comment" cols="40" rows="8"><?php echo $body; ?></textarea></div>
	  <div><input type="submit" name="submit" value="Submit Comment" /></div>

  </form>
</div>
</div>

 <?php include_layout_template('footer.php'); ?> 