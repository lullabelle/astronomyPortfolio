<?php
class Session {
	// session variables
	private $logged_in = false;
	private $user_id;
	public $message;
	
	function __construct(){
		session_start();
		$this->check_message();
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
	public function message($message="") {
	  if(!empty($message)) {
	  // if it is not empty (string sent) then need to set the message
	  //this must be stored in session or else just an attribute of class Session
	    $_SESSION['message'] = $message;
	  } else {
	  // get message and return what was already there
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

	private function check_message() {
	//check to see if a message has already been stored in the session
		if(isset($_SESSION['message'])) {
	// reset message and unset the stored message
      $this->message = $_SESSION['message'];
      unset($_SESSION['message']);
    } else {
      $this->message = "";
		}
	}	
}//end class

//create new instance of session object
$session = new Session();
$message = $session->message();
?>