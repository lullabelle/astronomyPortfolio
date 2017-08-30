    </div>
    <div id="footer">Copyright <?php echo date("Y", time()); ?>, astrogallery.com</div>
	 <script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
  </body>
</html>
<?php if(isset($db)) { $db->close_connection(); } ?>