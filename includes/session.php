<?php

class Session {
	// session variables
	private $logged_in = false;
	private $user_id;
	
	function __construct(){
		session_start();
		//check person is logged in first 
		$this->check_login();
	}
	public function is_logged_in(){
		return $this->logged_in;
	}
	public function login($user){
	//log the user in
	// find the user in the database based on username and password
		if($user){
			//if there is a user, take the user id set it equal to session user id and store in object - mark log in as true
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->logged_in = true;
		}
	}
	public function message($msg="") {
	  if(!empty($msg)) {
	    // then this is "set message"
	    
	    $_SESSION['message'] = $msg;
	  } else {
	    // then this is "get message"
			return $this->message;
	  }
	}
	//logout
	public function logout() {
		unset($_SESSION['user_id']);
		unset($this->user_id);
		$this->logged_in = false;
	}
	//prevents this from being altered outside the session class
	private function check_login(){
		if(isset($_SESSION['user_id'])){
			$this->user_id = $_SESSION['user_id'];
			$this->logged_in = true;
		}
		else {
			unset($this->user_id);
			$this->logged_in = false;
		}
	}	
}
$session = new Session();
?>