<?php
namespace Model;
date_default_timezone_set('Europe/Stockholm');

class Date {

	/**
	*Rturns the current date and time
	**/
	public static function getDate() {
		return date('Y-m-d H:i:s');
	}
}