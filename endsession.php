<?php
session_start();
use Controller\Controller;

spl_autoload_register(function ($className) {
    require_once 'Classes/' . \str_replace('\\', '/', $className) . '.php';
});

if (isset($_POST['submit'])) {
	$contrl = Controller::getController();
	$contrl->killSession();
	header("Location: View/test.php");
} else {
	header("Location: View/test.php");
}
