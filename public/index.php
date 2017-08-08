<?php require_once("../includes/initialize.php"); ?>
<?php
require_once('../includes/functions.php');
require_once("../includes/database.php");




$user = User::find_by_id(1);

echo $user->full_name();

echo "<hr />";

$users = User::find_all();
foreach($users as $user){
	echo "User: " . $user->username . "<br/>";
	echo "Name: " . $user->full_name() . "<br/>";
}

?>