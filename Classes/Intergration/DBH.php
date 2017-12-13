<?php
 
 namespace Intergration;

 use Model\Comment;
 use Model\Date;
 use Model\Hashing;
 use Model\User;

class DBH {

	private $conn;
	private $dbUsername = "root";
	private $dbPassword = "root";

	/**
	*Constucts an instance of DBH and calls the function to set up connection to database
	**/
	private function __construct(){
		$this->createConnection();
	}

	/**
	*Returns an instance of the DBH if it exists, if not it calls the constructor an sets the connection.
	**/
	static function getDBH(){
		return new DBH();
	}

	/**
	*Method to get comments stored in the database 
	*
	*@food 	- the comments associated to a specific recipe 
	**/
	public function getComments($food, $conn){
		$sql = "SELECT * FROM comments WHERE food = '".$food."'";
		$result = $conn->query($sql);
		$comments = array();
		while($row = $result->fetch_assoc()){
			$comments[] = new Comment($row['user_uid'], $row['date'], $row['food'], $row['message']);
		}

		return $comments;
	}

	/**
	*Saves the comment made by a logged in user in the database.
	*@u_uid - the users username
	*@food - the tag of the comment depending on the dish
	*@message - the maessage posted by user
	*@conn - the connection to the database
	**/
	public function saveComment($u_uid, $food, $message, $d, $conn){
		$date = $d;
		$sql = $conn->prepare ("INSERT INTO comments (user_uid, date, message, food) VALUES (?, ?, ?, ?)");
		$sql->bind_param ("ssss", $sql_u_uid, $sql_date, $sql_message, $sql_food);
		$sql_u_uid = $u_uid;
		$sql_date = $date;
		$sql_message = $message;
		$sql_food = $food;
		$result = $sql->execute();
	}

	/**
	*Creates a connection to the database for the website and returns it to the controller
	**/
	public function createConnection() {
		$dbServername = "localhost";
		$dbName = "loginsystem";

		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

		$this->conn = mysqli_connect($dbServername, $this->dbUsername, $this->dbPassword, $dbName);
		return $this->conn;
	}

	/**
	*Fetches all the users with a certain username from the database to for check at login
	*@uid - the username of the logged in user 
	**/
	public function getUser($uid, $pwd) {

		$safeuid = mysqli_real_escape_string($this->conn, $uid);
		$safepwd = mysqli_real_escape_string($this->conn, $pwd);
		$sql = "SELECT * FROM users WHERE user_uid = '".$safeuid."'";
		$results = mysqli_query($this->conn, $sql);
		$resultCheck = mysqli_num_rows($results);

		if ($resultCheck < 1) {
			return null;
		} else {
			$row = mysqli_fetch_assoc($results);
			$hashing = new Hashing();
			$hashedPwdCheck = $hashing->checkPwd($safepwd, $row['user_pwd']);

			if (!$hashedPwdCheck) {
				 return null;
			} else {
				$user = new User($row['user_first'], $row['user_last'], $row['user_email'], $row['user_uid'], $row['user_pwd']);
				return $user;
			}
		}
		
	}

	public function newUser($newuser) {
		$first = mysqli_real_escape_string($this->conn, $newuser->getFirst());
		$last = mysqli_real_escape_string($this->conn, $newuser->getLast());
		$email = mysqli_real_escape_string($this->conn, $newuser->getEmail());
		$uname = mysqli_real_escape_string($this->conn, $newuser->getUname());
		$pwd = mysqli_real_escape_string($this->conn, $newuser->getPwd());
		
		if (!preg_match("/^[a-zA-Z]*$/", $this->first) || !preg_match("/^[a-zA-Z]*$/", $this->last)) {	
			return "invalid";

		} else {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return "email";

			} else {
				$reultcheck = $this->checkUser($uname);

				if (!$reultcheck) {
					return "usertaken";

				} else {
					$queryresult = $this->storeUser($first, $last, $email, $uname, $pwd);

					if (!$queryresult) {
						return "error";
					} else {
						return "success";
					}
				}
			}
		}
	}

	private function checkUser($uname) {
		$sql = "SELECT * FROM users WHERE user_uid = '".$uname."'";
		$results = mysqli_query($this->conn, $sql);
		$resultCheck = mysqli_num_rows($results);

		if ($resultCheck < 1) {
			return true;
		} else {
			return false;
		}
	}

	/**
	*Adds a new user profile to the website database
	*@first - first name entered by user
	*@last - last name entered by user
	*@email - email entered by user
	*@uname - choosen username name entered by user
	*@pwd - choosen password name entered by user
	**/
	public function storeUser($first, $last, $email, $uname, $pwd) {
		$sql = $this->conn->prepare ("INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES (?, ?, ?, ?, ?);");
		$sql->bind_param ("sssss", $sql_first, $sql_last, $sql_email, $sql_uname, $sql_pwd);
		$sql_first = $first;
		$sql_last = $last;
		$sql_email = $email;
		$sql_uname = $uname;
		$sql_pwd = $pwd;
		return $sql->execute();
	}

	/**
	*Contacts the data base and removes a specific comment from the comment table.
	*@date - date stamp associated to the comment to be removed
	*@user - name of the user who posted the comment to be removed
	**/
	public function deleteComment ($date, $user) {
		$sql = $this->conn->prepare ("DELETE FROM comments WHERE user_uid = ? AND date = ?");
		$sql->bind_param ("ss", $sql_user, $sql_date);
		$sql_user = $user;
		$sql_date = $date;
 		$sql->execute();
	}
}