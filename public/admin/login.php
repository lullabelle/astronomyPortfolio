<?php
require_once('../../includes/initialize.php');

if($session->is_logged_in()) {
	redirect_to("index.php");
	}
	
	if (isset($_POST['submit'])) { // Form has been submitted.

	  $username = trim($_POST['username']);//trim clean the data of white spaces prevents errors
	  $password = trim($_POST['password']);
	  
	  // Check database to see if username/password exist.
		$found_user = User::authenticate($username, $password);//method contained in user class
	
		  if ($found_user) {
			$session->login($found_user);//from session class
			//log_action('Login', "{$found_user->username} logged in. ");// sucess redirect to index page
			redirect_to("index.php");
		  } else {
			// username/password combo was not found in the database
			$message = "Username/password combination incorrect.";
		  }
  
	} else { // Form has not been submitted.
		  $username = "";
		  $password = "";
	}  
?>
<?php include_layout_template('admin_header.php');?>

<div id ="login-container">
	<div id="comment_form">
		
		<form action="login.php" method="post">

		<div><input type="text" name="username" placeholder="username" maxlength="30" value="<?php echo htmlentities($username); ?>" /></div>
		</br>
		<!-- HTML entities escape any values that may be dangerous-->
		<div> <input type="password" name="password" placeholder="password"  maxlength="30" value="<?php echo htmlentities($password); ?>" /></div>
		</br>

		     <div><input type="submit" name="submit" value="Login" /></div>
	
		</form>
		</div>
</div>		
<?php if(isset($db)) { $db->close_dbconnection(); } ?>
<?php include_layout_template('admin_footer_short.php'); ?>