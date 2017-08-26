<?php
require_once(LIB_PATH.DS.'database.php');

class Photograph {
	
	//vars
	protected static $table ="photographs";
	public $id;
	public $filename;
	public $type;
	public $size;
	public $caption;
	// all uploads go to temp folder on server which will not be used outside this class
	private $temp_path;
    protected $upload_dir="images";// then move to upload directory - images
	public $errors=array();
  
	protected $upload_errors = array(
	// COMMON UPLOAD ERRORS AND MEANING. Provide more user friendly message
		UPLOAD_ERR_OK 			=> "No errors.",
		UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
		UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
		UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
		UPLOAD_ERR_NO_FILE 		=> "No file.",
		UPLOAD_ERR_NO_TMP_DIR 	=> "No temporary directory.",
		UPLOAD_ERR_CANT_WRITE	=> "Can't write to disk.",
		UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
	);
//upload files
	public function attach_file($file){
		//error checking
		if(!$file || empty($file) || !is_array($file)) {
		//error: not uploaded or no file
		  $this->errors[] = "No file was uploaded.";
		return false;
		} elseif($file['error'] != 0) {
		//return the error from PHP (0 = success)
		  $this->errors[] = $this->upload_errors[$file['error']];
		return false;
		} else {
		//set object vars based on file uploaded
		  $this->temp_path  = $file['tmp_name'];
		  $this->filename   = basename($file['name']);
		  $this->type       = $file['type'];
		  $this->size       = $file['size'];
		return true; //upload success

		}
	}

//class common database methods 
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
   
// allows photo object to build itself
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
//returns image size as KB or MB	
	public function image_size() {
		if($this->size < 1024) {
			return "{$this->size} bytes";
		} elseif($this->size < 1048576) {
			$size_kb = round($this->size/1024);
			return "{$size_kb} KB";
		} else {
			$size_mb = round($this->size/1048576, 1);
			return "{$size_mb} MB";
		}
	}
  
//CRUD
//database public instance methods
	public function save(){ //custom for photograph class
		// check if record exists
		if(isset($this->id)) {
		// update will update the photograph caption
			$this->update();
		} else {
		//error checking
		// prevent saving if there are errors
		if(!empty($this->errors)) { return false; }
		// Make sure the caption is not too long for the DB
		if(strlen($this->caption) > 255) {
				$this->errors[] = "The caption must be 255 characters or less.";
			return false;
		}
		// check that file name and temporary file path are set
		if(empty($this->filename) || empty($this->temp_path)) {
		    $this->errors[] = "File location was not available.";
		    return false;
		}
		// set target path
		$target_path = SITE_ROOT .DS. 'public' .DS. $this->upload_dir .DS. $this->filename;
		// check if file already exists in target location 
		if(file_exists($target_path)) {
		    $this->errors[] = "File {$this->filename} already exists.";
		    return false;
		}
		//moving file from temp to target location 
		if(move_uploaded_file($this->temp_path, $target_path)) {
		  	// if successful save file details to db
			if($this->create()) {
			// temp_path unset
				unset($this->temp_path);
				return true;
			}
			} else {
			// error as file was not moved
		    $this->errors[] = "The file upload failed, check permissions on upload folder.";
		    return false;
			}
		}
	}//end save
	
//delete photograph details from database, ensures it can be uploaded again
	public function delete_photo() {
//call the delete function remove db entry
		if($this->delete()) {
//then remove the file from the target path
		$target_path = SITE_ROOT.DS.'public'.DS.$this->image_path();
		return unlink($target_path) ? true : false;
		} else {
//failed: did not delete file			
		return false;
		}
	}	
// define path to image directory
	public function image_path() {
	  return $this->upload_dir.DS.$this->filename;
	}	
	public function create() {
		global $db;
	  $sql = "INSERT INTO ".self::$table." (";
	  $sql .= "filename, type, size, caption";
	  $sql .= ") VALUES ('";
	  //use method from db clas that escapes value and prevent sql injection
		$sql .= $db->mysql_prep($this->filename) ."', '";
		$sql .= $db->mysql_prep($this->type) ."', '";
		$sql .= $db->mysql_prep($this->size) ."', '";
		$sql .= $db->mysql_prep($this->caption) ."')";
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
		$sql .= "filename='". $db->mysql_prep($this->filename) ."', ";
		$sql .= "type='". $db->mysql_prep($this->type) ."', ";
		$sql .= "size='". $db->mysql_prep($this->size) ."', ";
		$sql .= "caption='". $db->mysql_prep($this->caption) ."' ";
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

	}
  
}//ends class
?>