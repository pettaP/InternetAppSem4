<?php
session_start();

use Controller\Controller;
use Intergration\DBH;
use Model\Comment;
	
	spl_autoload_register(function ($className) {
            require_once 'Classes/' . \str_replace('\\', '/', $className) . '.php';
        });

	$contr = Controller::getController();
	
	$noCom = $_GET['noCom'];
	$food = $_GET['food'];
	$comments = $contr->getComments($food);
	\set_time_limit(0);

	while(count($comments) == $noCom){
		\session_write_close();
		\sleep(1);
		\session_start();
		$contr = Controller::getController();
		$comments = $contr->getComments($food);
	}

	echo json_encode($comments);

	/**
	foreach ($comments as $value) {
		echo "<div class='commentbox'>";
			echo "<p>".$value->getUserId()."</p>";
			echo "<p>".$value->getDate()."</p><br>";
			echo "<p>".$value->getUserComment()."<p>";

			$date = $value->getDate();

			if (Controller::getController()->seesionSet()){
				if (Controller::getController()->getUser()->getUname() == $value->getUserId()) {
					echo "<div class='deletebutton'>";
							echo "<button class='delete' type='submit' name='commentDelete'>Delete</button>";
					echo "</div>";
					echo "</div>";
				} else {
					echo "</div>";
				}
			} else {
				echo "</div>";
		}	
	
	}	
	**/	

