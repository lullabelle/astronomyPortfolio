<?php require_once("../includes/initialize.php"); 

 include_layout_template('home_header.php'); 
 include_layout_template('nav.php'); 
 
?>

<!-- link to Google websafe fonts -->
<link href="https://fonts.googleapis.com/css?family=Josefin+Slab|Lobster" rel="stylesheet">
<!-- jQuery library (served from Google) -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

<!-- bxSlider Javascript file from website not stored on server-->
<script src="javascripts/jquery.bxslider.js"></script>
<!-- bxSlider CSS file stored with stylesheets -->

<link href="stylesheets/jquery.bxslider.css" rel="stylesheet" />
<!-- main site js -->
<script type="text/javascript" src="javascripts/main_js.js"></script>

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
  <li><img src="images/auriga.jpg"title="auriga" /></li>
  <li><img src="images/"title="aurora_1" /></li>
  <li><img src="images/"title="aurora_5" /></li>
  <li><img src="images/"title="cassiopeia" /></li>
  <li><img src="images/"title="gemini" /></li>
  <li><img src="images/"title="Lunar" /></li>
  <li><img src="images/"title="lunar_closeup_2" /></li>
  <li><img src="images/"title="lunar_glow" /></li>
  <li><img src="images/"title="night_trees1" /></li>
  <li><img src="images/"title="orion_2" /></li>
</ul>
	</div>
	
	</div>



<?php include_layout_template('footer.php'); ?>