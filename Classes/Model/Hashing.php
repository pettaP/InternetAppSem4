<?php
namespace Model;

class Hashing {

	/**
	*Return a hashed password
	**/
	public function pwdHash($pwd) {
		$hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
		return $hashedpwd;
	}

	/**
	*Checks if the provided password matched the hashed password in database
	**/
	public function checkPwd($pwd, $user_pwd) {
		$result = password_verify($pwd, $user_pwd);
		return $result;
	}
}