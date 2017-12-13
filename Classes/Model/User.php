<?php
namespace Model;

class User {

	private $first;
	private $last;
	private $email;
	private $uname;
	private $pwd;

	public function __construct ($first, $last, $email, $uname, $pwd) {
		$this->first = $first ;
		$this->last = $last;
		$this->email = $email;
		$this->uname = $uname;
		$this->pwd = $pwd;
	}

	public function getFirst () {
		return $this->first;
	}

	public function getLast () {
		return $this->last;
	}

	public function getEmail () {
		return $this->email;
	}

	public function getUname () {
		return $this->uname;
	}

	public function getPwd () {
		return $this->pwd;
	}
}