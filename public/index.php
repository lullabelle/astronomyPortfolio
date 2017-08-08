<?php require_once("../includes/initialize.php"); ?>
<?php
require_once("../includes/database.php");
require_once("../includes/user.php");



$user = User::find_by_id(1);

echo $user->full_name();

echo "<hr />";

// uses scope resolution operator to access class methods of USER
/* $user_set = User::find_all();
while ($user = $db->fetch_array($user_set)) {
  echo "User: ". $user['username'] ."<br />";
  echo "Name: ". $user['first_name'] . " " . $user['last_name'] ."<br /><br />";
} */
?>