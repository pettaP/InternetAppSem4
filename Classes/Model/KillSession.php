<?php
namespace Model;

class KillSession {

	/**
	*Kills the current session and unsets SESSION variables
	**/
	public function __construct() {
		session_start();
		session_unset();
		session_destroy();
	}
}