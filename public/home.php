<?php require_once("../includes/initialize.php"); ?>

<?php include_layout_template('home_header.php'); ?>
<?php include_layout_template('nav.php'); ?>

	<!-- jQuery library (served from Google) -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

<!-- bxSlider Javascript file from website not stored on server-->
<script src="http://localhost/astro_gallery/astronomyPortfolio/public/javascripts/jquery.bxslider.js"></script>
<!-- bxSlider CSS file stored with stylesheets -->

<link href="http://localhost/astro_gallery/astronomyPortfolio/public/stylesheets/jquery.bxslider.css" rel="stylesheet" />

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
  <li><img src="http://localhost/"title="barbed heart" /></li>
  <li><img src="http://localhost/"title="mario" /></li>
  <li><img src="http://localhost/"title="building" /></li>
  <li><img src="http://localhost/"title="black on white" /></li>
  <li><img src="http://localhost/"title="church bell" /></li>
  <li><img src="http://localhost/"title="cow" /></li>
  <li><img src="http://localhost/"title="daffodils" /></li>
  <li><img src="http://localhost/"title="frost" /></li>
  <li><img src="http://localhost/"title="leaf" /></li>
  <li><img src="http://localhost/"title="red" /></li>
</ul>
	</div>
	
	</div>



<?php include_layout_template('footer.php'); ?>