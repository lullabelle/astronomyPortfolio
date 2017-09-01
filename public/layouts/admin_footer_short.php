
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
		<div class="footer-distributed-short">

			<div class="footer-left-short">

				<p class="footer-links-short">
					<a href="../home.php">Home</a>
					·
					<a href="../photo_gallery.php">Gallery</a>
					·
					<a href="../about.php">About</a>
					·
					<a href="../legal.php">Copyright</a>
					·
					<a href="admin/index.php">Admin</a>
					·
				</p>

				<p>Copyright <?php echo date("Y", time()); ?>, astrogallery.com</p>
			</div><!-- end footer- left-->
	
		</div><!-- end of footer distributed div-->
		
</body>

</html>
<?php if(isset($db)) { $db->close_connection(); } ?>	