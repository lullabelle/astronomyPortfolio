    </div>
    <div id="footer">Copyright <?php echo date("Y", time()); ?>, astrogallery.com</div>
  </body>
</html>
<?php if(isset($db)) { $db->close_connection(); } ?>