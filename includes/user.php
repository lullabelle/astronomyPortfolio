<?php

require_once(LIB_PATH.DS.'database.php');

class User{
	
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	
	// created class methods so that user object does not have to be instantiated to query user table in db
	// returns all users in user table
	protected static $table="users";
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table);
  }
  
  public static function find_by_id($id=0) {
    global $db;
	
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
	//checks to see if array empty returns false if not array_shift returns first element
	return !empty($result_array) ? array_shift($result_array) : false;
   }
  // universal find by sql method to accept any sql passed to it - used in above methods
  //returns back rows from database and instantiates as user objects
  public static function find_by_sql($sql="") {
    global $db;
    $result_set = $db->query($sql);
    $object_array = array();
    while ($row = $db->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;		
  }
  
  //concatenates the first and last name together to display users full name
  public function full_name(){
	  if(isset($this->first_name)&& isset($this->last_name)){
		  return $this->first_name . " " . $this->last_name;
	  } else {
		  return "";
	  }
  }
  
  // allows user object to build itself
 	private static function instantiate($record) {
		// checks that the object is an array and exists in db sing the attribute method
    $object = new self;
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  $object_vars = get_object_vars($this);
	//returns associative array	
	  return array_key_exists($attribute, $object_vars);
	}
  
  //checks to see if user is in the database
  public static function authenticate($username="", $password=""){
	  global $db;
		  //escape special chars in password and username
		  $username = $db->mysql_prep($username);
		  $password = $db->mysql_prep($password);
		  // select from database and pass into find by sql db method
		  $sql = "SELECT * FROM users " ;
		  $sql .= "WHERE username = '{$username}'";
		  $sql .= "AND password = '{$password}'";
		  $sql .= "LIMIT 1";
		  $result_array = self::find_by_sql($sql);
		//checks to see if array empty returns false if not array_shift returns first element
		return !empty($result_array) ? array_shift($result_array) : false; 
  }
//CRUD
//database public instance methods
	public function save(){
		//will either create or update a record in one function. 
		//Checks to see if an id is present then updates if not creates
		return isset($this->id) ? $this->update() : $this->create(); 
		
	}

	public function create() {
		global $db;
	  $sql = "INSERT INTO ".self::$table." (";
	  $sql .= "username, password, first_name, last_name";
	  $sql .= ") VALUES ('";
	  //use method from db clas that escapes value and prevent sql injection
		$sql .= $db->mysql_prep($this->username) ."', '";
		$sql .= $db->mysql_prep($this->password) ."', '";
		$sql .= $db->mysql_prep($this->first_name) ."', '";
		$sql .= $db->mysql_prep($this->last_name) ."')";
	  if($db->query($sql)) {
	    $this->id = $db->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}
	public function update(){
	global $db;

		$sql = "UPDATE ".self::$table." SET ";
		$sql .= "username='". $db->mysql_prep($this->username) ."', ";
		$sql .= "password='". $db->mysql_prep($this->password) ."', ";
		$sql .= "first_name='". $db->mysql_prep($this->first_name) ."', ";
		$sql .= "last_name='". $db->mysql_prep($this->last_name) ."' ";
		$sql .= "WHERE id=". $db->mysql_prep($this->id);
		$db->query($sql);
		//checks to see if the number of affected rows is = 1
		return ($db->affected_rows() == 1) ? true : false;
	
}

public function delete(){
		global $db;
	  $sql = "DELETE FROM ".self::$table." ";
	  $sql .= "WHERE id=". $db->mysql_prep($this->id);
	  $sql .= " LIMIT 1";
	  $db->query($sql);
	  // 
	  return ($db->affected_rows() == 1) ? true : false;
//after delete execute the user is deleted from the database but the instance of the 
//user still exists at a class level. 
	}


}//end user class
?>