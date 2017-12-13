<?php
date_default_timezone_set('Europe/Stockholm');

session_start();
use Controller\Controller;
use Model\User;

	if (Controller::getController()->seesionSet()){
		echo "<div id='box'>
					<input class='inputUser' type='hidden' name='u_uid' value='".Controller::getController()->getUser()->getUname()."'>
					<input class='inputFood' type='hidden' name='food' value='".$food."'>
					<input class='inputDate' type='hidden' name='food' value='".date('Y-m-d H:i:s')."'>
					<textarea class='message'></textarea><br/>
					<button class='postit' type='submit' name='commentSubmit'>Comment</button>
			</div>";
		} else {
			echo "<div id='box'>
					<input class='input' type='hidden' name='u_uid' value='null'>
					<input class='input' type='hidden' name='food' value='".$food."'>
					<input class='inputDate' type='hidden' name='food' value='".date('Y-m-d H:i:s')."'>
					<textarea class='message'></textarea><br/>
					<button class='postit' type='submit' name='commentSubmit'>Comment</button>
				</div>";
		}
	
