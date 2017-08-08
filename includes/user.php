<?php
require_once('database.php');

class User{
	
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	
	// created class methods so that user object does not have t be instantiated to query user table in db
	// returns all users in user table
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM users");
  }
  
  public static function find_by_id($id=0) {
    global $db;
	
    $result_array = self::find_by_sql("SELECT * FROM users WHERE id={$id} LIMIT 1");
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
	  // get_object_vars returns an associative array with all attributes 
	 //as keys and values
	  $object_vars = get_object_vars($this);
	  //returns true or false is key exists
	  return array_key_exists($attribute, $object_vars);
	}
  

}//end user class

?>