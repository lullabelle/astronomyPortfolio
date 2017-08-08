<?php

class Session {
	// session variables
	private $logged_in = false;
	private $user_id;
	
	function __constructSession(){
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
	//logout
	public function logout(){
		unset($_SESSION['user_id']); //unsets session id
		unset(this->user_id); //unset user_id 
		$this->logged_in = false; //set logged in as false
	}
	//prevents this from being altered outside the session class
	private function check_login(){
		if(isset($_SESSION['user_id'])){
			$this->user_id = $_Session['user_id'];
			$this->logged_in = true;
		}
		else {
			unset($this->user_id);
			$this->logged_in = false;
		}
	}	
}
?>