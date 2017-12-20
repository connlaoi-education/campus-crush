<!-- Page Info -->
<?php
	$title = "CC - Update";
	$createddate = "September 19 2017";
	$updateddate = "xxxx xx 2017";
	$filename = "user-update.php";
	$banner = "Campus Crush";
	$description = "Change your Password, First or Last Name, and Email";
?>
<!--
	Creator:      Connlaoi Smith
	Filename:    <?php echo $filename; ?>
	Created:      <?php echo $createddate; ?>
	Updated:     <?php echo $updateddate; ?>
	Description: <?php echo $description; ?>
-->

<!-- Include Header PHP -->
<?php include 'header.php';
	if(!isLoggedIn())
	{ 
		header("Location:user-login.php");
		ob_flush();
	}
	
    $error = "";
	$error_2 = "";
	$results = "";
	$results2 = "";
	$completed = "";
	$ready = 1;
	
	$sql = "SELECT * FROM users WHERE id = '" . $_SESSION['username'] . "'";
	$results = pg_query($connection, $sql);
	$userInfoArray = pg_fetch_array($results);
	
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$sql = "SELECT * FROM users WHERE id = '" . $_SESSION['username'] . "'";
		$results = pg_query($connection, $sql);
		$userInfoArray = pg_fetch_array($results);

		// user data
		$username = $userInfoArray["id"];

		$firstName = ucwords($userInfoArray['first_name']);

		$lastName = ucwords($userInfoArray['last_name']);

		$checkEmail = $userInfoArray['email_address'];
	}
	elseif($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$sql = "SELECT * FROM users WHERE id = '" . $_SESSION['username'] . "'";
		$results = pg_query($connection, $sql);
		$userInfoArray = pg_fetch_array($results);
		
		$checkPass = $userInfoArray["password"];
		$checkEmail = $userInfoArray["email_address"];
		$username = $userInfoArray["id"];
		
		$password = trim($_POST["pass"]); // old password
		$password1 = trim($_POST["pass1"]); // new password
		$password2 = trim($_POST["pass2"]); // confirm new password
			
		$firstName = trim($_POST["newFirst"]);
		$lastName = trim($_POST["newLast"]);
		
		$email = trim($_POST["email"]);
		$email1 = trim($_POST["email1"]);
		$email2 = trim($_POST["email2"]);
		
		if(isset($_POST['pass']) || isset($_POST['pass1']) || isset($_POST['pass2']))
		{
			if(!isset($password) || $password == "" || !isset($password1) || $password1 == "" || !isset($password2) || $password2 == "" )
			{
				$error .= "You forgot to enter a password. <br/>";
				$password = "";
				$password1 = "";
				$password2 = "";
			}
			else if(strlen($password1) < MINIMUM_PASSWORD_LENGTH || strlen($password2) < MINIMUM_PASSWORD_LENGTH)
			{
				$error .= "Your new password must be at least 6 characters. <br/>";
				$password1 = "";
				$password2 = "";
			}
			else if(strlen($password1) > MAXIMUM_PASSWORD_LENGTH || strlen($password2) > MAXIMUM_PASSWORD_LENGTH)
			{
				$error .= "Your new password must be less than 20 characters. <br/>";
				$password1 = "";
				$password2 = "";
			}
			else if(strcmp($password1, $password2) !== 0)
			{
				$error .= "Your new password's do not match!<br/>";
				$password1 = "";
				$password2 = "";
			}
			else if(strcmp(md5($password), $checkPass) !== 0)
			{
				$error .= "Your old password does not match your account!<br/>";
				$password = "";
				$password1 = "";
				$password2 = "";
			}
			else
			{
				$ready = $ready + 1;
			}
		}
			
		if(isset($_POST['email']) || isset($_POST['email1']) || isset($_POST['email2']))
		{
			if(!isset($email) || $email == "" || !isset($email1) || $email1 == "" || !isset($email2) || $email2 == "")
			{
				$error .= "You forgot to enter an email address! <br/>";
				$email = "";
			}
			else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
			{
				$error .= "The old email address you entered is not valid! <br/>";
				$email = "";
			}
			else if(filter_var($email1, FILTER_VALIDATE_EMAIL) == false || filter_var($email2, FILTER_VALIDATE_EMAIL) == false)
			{
				$error .= "The new email address you entered is not a valid address! <br/>";
				$email = "";
			}
			else if(strcmp($email1, $email2) !== 0)
			{
				$error .= "Your new email's do not match!<br/>";
				$email1 = "";
				$email2 = "";
			}
			else if(strcmp($email, $checkEmail) !== 0)
			{
				$error .= "Your old email does not match your account!<br/>";
				$email = "";
				$email1 = "";
				$email2 = "";
			}
			else
			{
				$ready = $ready + 2;
			}
		}
		
		// If there are no errors, update user email
		if($error == "")
		{	
			if($ready == 3)
			{
				$connection = db_connect();
				$completed = pg_execute($connection, "update_email", array($email2, $_SESSION['username']));
				$_SESSION['redirected'] .= "\nEmail changed successfully!";
				header("Location: dashboard.php");
				ob_flush();
			}
			elseif($ready == 2)
			{
				$connection = db_connect();
				$completed = pg_execute($connection, "update_password", array(md5($password2), $_SESSION['username']));
				$_SESSION['redirected'] .= "\nPassword changed successfully!";
				header("Location: dashboard.php");
				ob_flush();
			}
			elseif($ready == 4)
			{
				$connection = db_connect();
				$completed = pg_execute($connection, "update_email", array($email2, $_SESSION['username']));
				$_SESSION['redirected'] .= "\nEmail changed successfully!";
				$completed .= pg_execute($connection, "update_password", array(md5($password2), $_SESSION['username']));
				$_SESSION['redirected'] .= "\nPassword changed successfully!";
				header("Location: dashboard.php");
				ob_flush();
			}
		}
	}
?>

<!-- HTML -->

<h3>Update your Account Information</h3>
<p class="content"><?php echo $description; ?></p>
	<p style="color:red;">
		<?php echo $error; ?>
		<br />
		<?php echo $error_2; ?>
	</p>
<?php
// create and call prepared SQL statements to update the current accounts values

// UPDATE users SET first_name = newFirst, email = newEmail WHERE id = currentID;

// use INSERT to clone the existing account with new values 
// **add username to form if this is the case**
// INSERT INTO users (id = $newUsername, password = $newPassword, first_name = $newFirst, last_name = $newLast, email = $newEmail)

// build an array for the prior-to-change user ID's profile information, and use it to rebuild their profile. (same as in profile update)
// INSERT INTO profiles (user_id = $profileArray['username'], gender = $profileArray['gender'])
// DELETE all the previous username's info in the profiles table, and then users table
?>

<hr />

<br />

<form name="input" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table class="size1">
		<tr>
			<td>Username</td>
			<td><input type="text" name="newUsername" maxlength="20" placeholder="<?php echo $username;  ?>" size="30" /readonly></td>
		</tr>
		<tr>
			<td>First Name</td>
			<td><input type="text" name="newFirst" maxlength="20" placeholder="<?php echo $firstName;  ?>" size="30" /readonly></td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td><input type="text" name="newLast" maxlength="30" placeholder="<?php echo $lastName;  ?>" size="30" /readonly></td>
		</tr>
		<tr>
			<td><br /></td>
		</tr>
		<tr>
			<td>Old Email</td>
			<td><input type="text" name="email" maxlength="255" placeholder="<?php echo htmlspecialchars($checkEmail);  ?> Enter old Email..." size="30" /></td>
		</tr>
		<tr>
			<td>New Email</td>
			<td><input type="text" name="email1" maxlength="32" placeholder="Enter new Email..." size="30" /></td>
		</tr>
		<tr>
			<td>Confirm Email</td>
			<td><input type="text" name="email2" maxlength="32" placeholder="Confirm new Email..." size="30" /></td>
		</tr>
		
		</br >
		
		<tr>
			<td>Old Password</td>
			<td><input type="password" name="pass" maxlength="32" placeholder="Enter old password..." size="30" /></td>
		</tr>
		<tr>
			<td>New Password</td>
			<td><input type="password" name="pass1" maxlength="32" placeholder="Enter new password..." size="30" /></td>
		</tr>
		<tr>
			<td>Confirm Password</td>
			<td><input type="password" name="pass2" maxlength="32" placeholder="Confirm new password..." size="30" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input style="display:inline;" class="btn" type="submit" value="Update" />
					<input style="display:inline;" class="btn" type="reset" value="Reset" /></td>
		</tr>
	</table>
</form>

<!-- Include Footer PHP -->
<?php include 'footer.php'; ?>