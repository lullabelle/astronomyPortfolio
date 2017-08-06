<?php
require_once("../includes/database.php");
require_once("../includes/user.php");



$record = User::find_by_id(1);
echo $user->'username';

echo "<hr />";

$user_set = User::find_all();
while ($user = $db->fetch_array($user_set)) {
  echo "User: ". $user['username'] ."<br />";
  echo "Name: ". $user['first_name'] . " " . $user['last_name'] ."<br /><br />";
}
?>