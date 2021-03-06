<?php require_once("../includes/initialize.php"); 

 include_layout_template('home_header.php'); 
 include_layout_template('nav.php'); 
 
?>

<!-- jQuery library (served from Google) -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

<!-- bxSlider Javascript file from website not stored on server-->
<script src="javascripts/jquery.bxslider.js"></script>
<!-- bxSlider CSS file stored with stylesheets -->

<link href="stylesheets/jquery.bxslider.css" rel="stylesheet" />

<div id="photo">
<!-- javascript controls for slider-->
<script type="text/javascript">
  $(document).ready(function(){
    $('.bxslider').bxSlider({
        mode: 'fade',
        captions: 'true',
        auto: 'true',
        autoControls: 'false',
		
        
    });
  });
</script>
<div id="container">
	<ul class="bxslider">
	<!-- load in images from image folder-->
  <li><img src="images/bxslider/auriga.jpg"title="auriga" /></li>
  <li><img src="images/bxslider/aurora_1.jpg"title="aurora" /></li>
  <li><img src="images/bxslider/aurora_5.jpg"title="aurora" /></li>
  <li><img src="images/bxslider/cassiopeia.jpg"title="cassiopeia" /></li>
  <li><img src="images/bxslider/gemini.jpg"title="gemini" /></li>
  <li><img src="images/bxslider/Lunar.jpg"title="Lunar" /></li>
  <li><img src="images/bxslider/lunar_closeup_2.jpg"title="lunar_closeup" /></li>
  <li><img src="images/bxslider/lunar_glow.jpg"title="lunar_glow" /></li>
  <li><img src="images/bxslider/night_trees1.jpg"title="night_trees" /></li>
  <li><img src="images/bxslider/orion_2.jpg"title="orion" /></li>
</ul>
	</div>
	
	</div>



<?php include_layout_template('footer.php'); ?>