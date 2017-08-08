<?php
require_once('database.php');

class User{
	
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	
	// returns all users in user table
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM users");
  }
  
  public static function find_by_id($id=0) {
    global $db;
    $result_set = self::find_by_sql("SELECT * FROM users WHERE id={$id} LIMIT 1");
    $found = $db->fetch_array($result_set);
    return $found;
  }
  
  public static function find_by_sql($sql="") {
    global $db;
    $result_set = $db->query($sql);
		return $result_set;
  }
  
  

}

?>