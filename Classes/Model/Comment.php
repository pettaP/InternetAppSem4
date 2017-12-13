<?php

namespace Model;

class Comment implements \JsonSerializable {

	private $userid;
	private $date;
	private $food;
	private $comment;

	/**
	*Constructor - construct an instance of a specific comment from the *database and stores the variables associated to it.
	*@userid - the users id who posted the comment
	*@date - timestamp of the comment
	*@food - th dish related to the comment
	*@comment - the comment posted by the user
	**/
	public function __construct($userid, $date, $food, $comment){

		$this->userid = $userid;
		$this->date = $date;
		$this->food = $food;
		$this->comment = $comment;
	}

	public function jsonSerialize () {
		$json_obj = new \stdClass;
		$json_obj->user = $this->userid;
		$json_obj->date = $this->date;
		$json_obj->food = $this->food;
		$json_obj->comment = $this->comment;

		return $json_obj;
	}

	public function getUserId(){

		return $this->userid;
	}

	public function getDate(){
		return $this->date;
	}

	public function getFood(){

		return $this->food;
	}

	public function getUserComment() {

		return $this->comment;
	}
}
?>