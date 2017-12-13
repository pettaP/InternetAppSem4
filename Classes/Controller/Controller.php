<?php

namespace Controller;

use Intergration\DBH;
use Model\Comments;
use Model\User;
use Model\Hashing;
use Model\SignUpUser;

class Controller {

	private $DBH;
	private $conn;
	private $user;
	
	/**
	*Constuctor - creates an instance of the controller and set the *attributes required for the session
	**/
	private function __construct(){
		$this->DBH = DBH::getDBH();
		$this->conn = $this->DBH->createConnection();
	}

	/**
	*Returns an unserialized instance of the controller if initiated, otherwise it calls the constructor
	**/
	public static function getController() {
		session_start();
		if(!isset($_SESSION['controller'])){
			return new Controller();
		}
	
		$contrl = unserialize($_SESSION['controller']);
		$contrl->DBH = DBH::getDBH();
		$contrl->conn = $contrl->DBH->createConnection();
		return $contrl;
		
	}

	/**
	*Get the comments related to a section of the Tasty Recpies website
	*@food - the dish/tag the current comment section is related to
	**/
	public function getComments($food) {

		$results = $this->DBH->getComments($food, $this->conn);
		return $results;
	}

	/**
	*Takes the input of user and contacts the DBH to post the comment in the database
	*@u_uid - username of the logged in user
	*@food - the current dish commented on
	*@message - the textmessage posted by user
	**/
	public function postComment($u_uid, $food, $message, $date){
		$this->DBH->saveComment($u_uid, $food, $message, $date, $this->conn);
	}

	/**
	*This function logs in an existing user. If the user dosen't excist it generates an error message that i handeled in the view
	*@ uid - user name enterd by user
	*@pwd - password entered by user
	**/
	public function logIn ($uid, $pwd) {
		$this->user = $this->DBH->getUser($uid, $pwd);
		
		if($this->user == null){
			return "error";
		} else {
			return "succsess";
		}
	}

	/**
	*Creates a new instance of Signupuser to add a new user to the database
	*@first - first name entered by user
	*@last - last name entered by user
	*@email - email entered by user
	*@uname - choosen username name entered by user
	*@pwd - choosen password name entered by user
	**/
	public function signUpNewUser($first, $last, $email, $uname, $pwd) {
		$hash = new Hashing();
		$hashedpwd = $hash->pwdHash($pwd);
		$newuser = new User($first, $last, $email, $uname, $hashedpwd);
		$result = $this->DBH->newUser($newuser);
		return $result;
	}

	public function getUser() {
		return $this->user;
	}

	/**
	*Removes a selected comment posted by the logged in user
	*@date - the date tag associated to the comment to be removed
	*@user - the user name tag for the comment to be deleted
	**/
	public function deleteComment ($date, $user) {
		$this->DBH->deleteComment($date, $user);
	}

	/**
	*This function ends the current session and unsets the SESSION variables
	**/
	public function killSession(){
		$this->user = null;
	}

	public function seesionSet() {
		if ($this->user == null){
			return false;
		} else {
			return true;
		}
	}

	/**
	*Destructor - saves an instance of the current Controller in the $_SESSION array for use in the next view
	**/
	public function __destruct() {
		session_start();
        $_SESSION['controller'] = serialize($this);
    }
}

?>