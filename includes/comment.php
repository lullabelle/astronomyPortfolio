<?php
require_once(LIB_PATH.DS.'database.php');

class Comment {
//vars
protected static $table = "comments";

public $id;
public $photograph_id;
public $created;
public $author;
public $body;

// create a new comment with error checking - author passed in as anonymous in case name not provided
	public static function create_comment($photo_id, $author="Anonymous", $body="") {
    if(!empty($photo_id) && !empty($author) && !empty($body)) {
		$comment = new Comment();
	    $comment->photograph_id = (int)$photo_id;
	    $comment->created = strftime("%Y-%m-%d %H:%M:%S", time());
	    $comment->author = $author;
	    $comment->body = $body;
	    return $comment;
		} else {
//comment was not successful			
	return false;
		}
	}
// find comments with foreign key of photo id provided	
	public static function find_comments($photo_id=0) {
    global $db;
		$sql = "SELECT * FROM " . self::$table;
		$sql .= " WHERE photograph_id=" .$db->mysql_prep($photo_id);
		$sql .= " ORDER BY created ASC";
    return self::find_by_sql($sql);
	}

//re-use class common database methods 
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table);
  }
  
	public static function find_by_id($id=0) {
    global $db;
	
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table." WHERE id=".$db->mysql_prep($id)." LIMIT 1");
	//checks to see if array empty returns false if not array_shift returns first element
	return !empty($result_array) ? array_shift($result_array) : false;
   }
// universal find by sql method to accept any sql passed to it - used in above methods
//returns back rows from database and instantiates as comment objects
	public static function find_by_sql($sql="") {
    global $db;
    $result_set = $db->query($sql);
    $object_array = array();
    while ($row = $db->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;		
  }	
    public static function count_all() {
	 global $db;
		$sql = "SELECT COUNT(*) FROM ".self::$table_name;
		$result_set = $db->query($sql);
		$row = $db->fetch_array($result_set);
    return array_shift($row);
	} 
// allows comment object to build itself
 	private static function instantiate($record) {
		// checks that the object is an array and exists in db using the has_fields method
    $object = new self;
		foreach($record as $fields=>$value){
		  if($object->has_fields($fields)) {
		    $object->$fields = $value;
		  }
		}
		return $object;
	}
	
	private function has_fields($fields) {
	  $object_vars = get_object_vars($this);
	 return array_key_exists($fields, $object_vars);
	}	
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	public function create() {
		global $db;
	  $sql = "INSERT INTO ".self::$table." (";
	  $sql .= "photograph_id, created, author, body";
	  $sql .= ") VALUES ('";
	  //use method from db clas that escapes value and prevent sql injection
		$sql .= $db->mysql_prep($this->photograph_id) ."', '";
		$sql .= $db->mysql_prep($this->created) ."', '";
		$sql .= $db->mysql_prep($this->author) ."', '";
		$sql .= $db->mysql_prep($this->body) ."')";
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
		$sql .= "photograph_id='". $db->mysql_prep($this->photograph_id) ."', ";
		$sql .= "created='". $db->mysql_prep($this->created) ."', ";
		$sql .= "author='". $db->mysql_prep($this->author) ."', ";
		$sql .= "body='". $db->mysql_prep($this->body) ."' ";
		$sql .= "WHERE id=". $db->mysql_prep($this->id);
		$db->query($sql);
		//checks to see if the number of affected rows is = 1
	return ($db->affected_rows() == 1) ? true : false;
	
}
	public function delete() {
	global $database;
	
	  $sql = "DELETE FROM ".self::$table_name;
	  $sql .= " WHERE id=". $database->escape_value($this->id);
	  $sql .= " LIMIT 1";
	  $database->query($sql);
	 return ($database->affected_rows() == 1) ? true : false;
	
	}
	
}//end comment class
?>