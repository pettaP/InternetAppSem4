<?php
	include_once '../fragments/header.php'
?>
<div class="reciwrapper">
	<h2>Sign Up Page</h2>
	<div id="signupinfo">
		<p>
			Fill out all the information in the boxes below and then click on the "Sign Up" button to create an account on this website.
		</p>
		<p>
			<?php
				if (isset($_GET['signup'])) {
					switch ($_GET['signup']) {
						case 'empty':
							echo "<div class='errormsg'>Oops! Something went wrong while signing in!<br>It seems like some fields in the form were left empty. Please fill all the boxes out to sign up!</div>";
							break;
						case 'invalid':
							echo "<div class='errormsg'>Oops! Something went wrong while signing in!<br>The first and last name may only contain characters A-Z, no numbers and no symbols</div>";
							break;
						case 'email':
							echo "<div class='errormsg'>Oops! Something went wrong while signing in!<br>Please enter the email adress in the right format</div>";
							break;
						case 'usertaken':
							echo "<div class='errormsg'>Oops! Something went wrong while signing in!<br>The username seems to already be taken. Please try a unique username!</div>";
							break;
						case 'error':
							echo "div class='errormsg'>Oops! Something went wrong while signing in!<br>Unknown error. Please try again!</div>";
							break;
						case 'success':
							echo "<div class='errormsg'>You have successfully created a user profile for this website.<br>Please procceed to login!</div>";
							break;
					}
				} else {
					echo "You have to have an account and be logged in to post comments on this site!";
				}
			?>
		</p>
	</div>	
	<form class="signupform" action="../signupuser.php" method="POST">
		<input type="text" name="uname" placeholder="Choose User Name">
		<input type="text" name="fname" placeholder="Enter First Name">
		<input type="text" name="lname" placeholder="Enter Last Name">
		<input type="text" name="email" placeholder="Enter E-mail Adress">
		<input type="password" name="pwd" placeholder="Choose Password">
		<button type="submit" name="submit">Sign Up</button>
	</form>
</div>
<?php
	include_once '../fragments/footer.php'
?>

