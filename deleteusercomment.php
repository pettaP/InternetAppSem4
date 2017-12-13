<?php

session_start();
use Controller\Controller;

spl_autoload_register(function ($className) {
    require_once 'Classes/' . \str_replace('\\', '/', $className) . '.php';
});

$contrl = Controller::getController();
$contrl->deleteComment($_POST['d'], $_POST['user']);