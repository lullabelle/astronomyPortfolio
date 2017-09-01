<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	if(empty($_GET['id'])) {
	  $session->message("Photo ID not provded.");
	  redirect_to('photo_gallery.php');
	}

  $photo = Photograph::find_by_id($_GET['id']); 
 
  if(!$photo) {
    $session->message("Photo not found.");
    redirect_to('gallery.php');
  }
// finds all comments for selected photo
	$comments = Comment::find_comments($photo->id);
	
?>

<?php include_layout_template('admin_header.php'); ?>

<a href="photo_list.php">&laquo; Back</a><br />
<br />
<div class ="body-container">
<h2>Comments on <?php echo $photo->filename; ?></h2>

<?php echo output_message($message); ?>

  <?php foreach($comments as $comment){ ?>
    <div class="comment" style="margin-bottom: 2em;">
	    <div class="author">
	      <?php echo htmlentities($comment->author); ?> wrote:
	    </div>
      <div class="body">
<!--strip tags stops users posting links in the comments - could be malicious -->
				<?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
			</div>
	    <div class="meta-info" style="font-size: 0.8em;">
	      <?php echo datetime_to_text($comment->created); ?>
	    </div>
			<div class="actions" style="font-size: 0.8em;">
			<!--delete comment-->
				<a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete Comment</a>
			</div>
    </div>
  <?php } ?>
  	<!--no comments mesage-->
  <?php if(empty($comments)) { echo "no comments to display."; } ?>
</div>


<?php include_layout_template('admin_footer_short.php'); ?>
