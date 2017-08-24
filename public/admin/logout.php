<?php require_once("../../includes/initialize.php"); ?>
<?php	
    $session->logout();//method from session class logout
    redirect_to("login.php");//redirect to login page
?>
