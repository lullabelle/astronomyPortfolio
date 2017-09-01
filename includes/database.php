<?php
require_once(LIB_PATH.DS."initialize.php");

class Database {
	// db connection is accessible from any class
	private $conn;
	//opens database connection ready for use
	function __construct(){
		$this ->open_dbconnection();
	}
	// sets up connection using db constants
	public function open_dbconnection(){
		$this ->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(mysqli_connect_errno()){
			die("Database connection has failed: ". mysqli_connect_errno() . "(" . mysqli_connect_errno() . ")");
		}
	}
	// closes db connection when done
	public function close_dbconnection(){
		if(isset($this ->conn)) {
			mysqli_close($this->conn);
			unset($this->conn);
		}
	}
	
	//pass in query string using current database connection to return result
	public function query($sql){
		$result = mysqli_query($this ->conn, $sql);
		//call confirm query function to check if query worked
		$this->confirm_query($result);
		return $result;
	}
	
	//confirms that query works as expected. Called within the class by query function so prvate
	private function confirm_query($result){
		if (!$result){
			die("Database query failed");
		}
	}
	
	// check sql query for escape characters
	public function mysql_prep($string){
		$escaped_string = mysqli_real_escape_string($this->conn, $string);
		return $escaped_string;
	}
	  public function fetch_array($result_set) {
		return mysqli_fetch_array($result_set);
	}
	
	// returns number of rows affected by the last sql statement run
	public function num_rows($result_set){
		return mysqli_num_rows ($result_set);
	}
	//returns last id inserted to db over current connection
	public function insert_id(){
		return mysqli_insert_id($this->conn);
	}
	//returns number of rows affected by the last sql statement run in this connection
	public function affected_rows(){
		return mysqli_affected_rows($this->conn);
	}
}//end class
$db = new Database();

?>