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
		<html>
		  <head>
			<title>astrogallery: Admin</title>
			<link href="../stylesheets/main.css" media="all" rel="stylesheet" type="text/css" />
		  </head>
		  <body>
			<div id="header">
			  <h1>astrogallery: Admin</h1>
			</div>
			<div id="main">
		
			<form action="login.php" method="post">
		  <table>
		    <tr>
		      <td>Username:</td>
		      <td>
		        <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
				<!-- HTML entities escape any values that may be dangerous-->
		      </td>
		    </tr>
		    <tr>
		      <td>Password:</td>
		      <td>
		        <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td colspan="2">
		        <input type="submit" name="submit" value="Login" />
		      </td>
		    </tr>
		  </table>
		</form>
		</div>
</html>
<?php if(isset($db)) { $db->close_dbconnection(); } ?>