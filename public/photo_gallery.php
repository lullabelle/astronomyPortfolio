<?php require_once("../includes/initialize.php"); ?>
<?php
//PAGINATION
//get the number of the current page $this_page use GET
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

//get the number of records per page to display
	$no_per_page = 3;

//total count of all photograph records
	$total_records = Photograph::total_records();
	
/* pagination will take care of find all photos. Pass object related 
parameters in to pagination object */
	
	$pagination = new Pagination($page, $no_per_page, $total_records);
	
//return just the records for this page limit no. per page
	$sql = "SELECT * FROM photographs ";
	$sql .= "LIMIT {$no_per_page} ";
	$sql .= "OFFSET {$pagination->offset()}";
	$photos = Photograph::find_by_sql($sql);
	
?>
<?php
//call find all photos method
//$photos = Photograph::find_all();
?>
<?php include_layout_template('header.php'); ?>
<?php include_layout_template('nav.php'); ?>
<!--DISPLAY PAGINATION -->
<div id="pagination">
<?php
//pagination navigation next and previous pages
	if($pagination->total_pages() > 1) {
		
		if($pagination->is_first_page()) { 
			echo "<a href=\"photo_gallery.php?page=";
			echo $pagination->previous_page();
			echo "\">&laquo; Previous</a> "; 
		}

		for($i=1; $i <= $pagination->total_pages(); $i++) {
			if($i == $page) {
				echo " <span class=\"selected\">{$i}</span> ";
			} else {
				echo " <a href=\"photo_gallery.php?page={$i}\">{$i}</a> "; 
			}
		}

		if($pagination->is_last_page()) { 
			echo " <a href=\"photo_gallery.php?page=";
			echo $pagination->next_page();
			echo "\">Next &raquo;</a> "; 
		}
		
	}//END if

?>
</div><!--END PAGINATION -->

<!--loop through photos in database-->
<?php foreach($photos as $photo){ ?>
  <div id="photo_gallery">
  <!--link to larger image on large_photo.php-->
		<a href="large_photo.php?id=<?php echo $photo->id; ?>">
		<!--ALT TEXT DOES NOT WORK ON CHROME!! USE TITLE INSTEAD!!-->
			<img src="<?php echo $photo->image_path(); ?>" width="20%" title="<?php echo $photo->caption;?>"/>
		</a>
   <p><?php echo $photo->caption; ?></p>
  </div>
<?php } ?>

<?php include_layout_template('footer.php'); ?>


