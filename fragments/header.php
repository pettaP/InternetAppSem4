<?php
	session_start();
	use Controller\Controller;
	use Model\User;
	spl_autoload_register(function ($className) {
   		require_once '../Classes/' . \str_replace('\\', '/', $className) . '.php';
	});
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/recepies.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet">
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1,maxium-scale=1">
	<title>
		Tasty Recepies
	</title>
</head>

<body>
	<div class="body">
		<div class="wrapper">
			<div class = "login">
				<?php
					if (Controller::getController()->getUser() != null) {	//kolla om user är inloggad i contrl
						echo "<div class='logout'><p>You are logged in as</p><p id=username>".Controller::getController()->getUser()->getUname()."</p><form action='../endsession.php' method='POST'>
							<button type='submit' name='submit'>Log Out</button>
							</form></div>";
					} else {
						echo 
							"<form action='../userlogin.php' method='POST'>
							<input type='text' name='uid' placeholder='Username'>
							<input type='password' name='pwd' placeholder='Password'>
							<button type='submit' name='submit'>Login</button>
							<a href='signup.php'>Sign Up</a>
							</form>";
					}
				?>
			</div>
			<div class="h1">
				<div id="pot">
					<a href = "test.php"><img src="../images/pot.png" alt="CookingPot"></a>
				</div>
				<div id="title">
					<h1>
						Tasty Recipes
					</h1>
				</div>
			</div>
			<div class="headers">
				<ul>
					<li><a href = "test.php">Start</a></li>
					<li><a href = "meatballs.php">Meatballs</a></li>
					<li><a href = "pancake.php">Pancakes</a></li>
					<li><a href = "planner.php">Monthy Planner</a></li>
				</ul>
			</div>
		</div>