<?php

session_start();
use Controller\Controller;
spl_autoload_register(function ($className) {
    require_once 'Classes/' . \str_replace('\\', '/', $className) . '.php';
});

$u_uid = $_POST['user'];
$food = $_POST['food'];
$date = $_POST['d'];

if(empty($_POST['msg'])){
	$message = "";
} else {
	$message = $_POST['msg'];
	if (!ctype_print($message)) {
		$contrl = Controller::getController();
		$contrl->killSession();
		//header("Location: View/test.php");
	} 
}


if ($u_uid == "null"){
	header("Location: /View/signup.php");
	exit();
} else {
	$contrl = Controller::getController();
	$contrl->postComment($u_uid, $food, $message, $date);
	/*
	if ($food == "meatballs") {
		header("Location: View/meatballs.php");
	}
	elseif ($food == "pancakes") {
		header("Location: View/pancake.php");
	} 
	*/
}




