<!-- Page Info -->
<?php
  $title = "CC - Password Change";
  $createddate = "December 4 2017";
  $updateddate = "xxxx xx 2017";
  $filename = "user-password-change.php";
  $banner = "Campus Crush";
  $description = "Change your Password";
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
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
$sql = "SELECT * FROM users WHERE id = '" . $_SESSION['username'] . "'";
$results = pg_query($connection, $sql);
$userInfoArray = pg_fetch_array($results);

// user data
$username = $userInfoArray["id"];

	}
	elseif($_SERVER["REQUEST_METHOD"] == "POST")
	{
$sql = "SELECT * FROM users WHERE id = '" . $_SESSION['username'] . "'";
$results = pg_query($connection, $sql);
$userInfoArray = pg_fetch_array($results);
$checkPass = $userInfoArray["password"];
$username = $userInfoArray["id"];

$password = trim($_POST["pass"]);

$password2 = trim($_POST["pass2"]);


if(!isset($password) || $password == "")
		{
			$error .= "You did not enter a password. <br/>";
			$password = "";
			$password2 = "";
		}
		else if (strlen($password) < MINIMUM_PASSWORD_LENGTH)
		{
			$error .= "Your password must be at least 6 characters. <br/>";
			$password = "";
			$password2 = "";
		}
		else if (strlen($password) > MAXIMUM_PASSWORD_LENGTH)
		{
			$error .= "Your password must be less than 20 characters. <br/>";
			$password = "";
			$password2 = "";
		}
		else if (strcmp(md5($password), $checkPass) !== 0) 
		{
			$error .= "Your old passwords do not match <br/>";
			$password = "";
			$password2 = "";
		}

if($error == "")
		{	
$connection = db_connect();
$results1 = pg_execute($connection, "update_password", array(md5($password2), $firstName, $lastName, $email, $_SESSION['username']));
$_SESSION['password_change'] = "Password is changed successful";
header("Location: dashboard.php");
ob_flush();
				
	}
	}
?>

<!-- HTML -->

<h3>Update your Account Information</h3>
<p class="content"><?php echo $description; ?></p>
	<p style="color:red;">
		<?php echo $error; ?>
	</p>
	<p style="color:red;">
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
			<td><input type="text" name="newUsername" maxlength="20" placeholder="<?php echo $username;  ?>" size="20" /readonly></td>
		</tr>
		<tr>
			<td>Old Password</td>
			<td><input type="password" name="pass" maxlength="32" placeholder="Enter old password..." size="20" /></td>
		</tr>
		<tr>
			<td>New Password  </td>
			<td><input type="password" name="pass2" maxlength="32" placeholder="Confirm new password..." size="20" /></td>
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