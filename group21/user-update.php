<!-- Page Info -->
<?php
	$title = "CC - Update";
	$createddate = "September 19 2017";
	$updateddate = "xxxx xx 2017";
	$filename = "user-update.php";
	$banner = "Campus Crush";
	$description = "Change your Username, Password, First or Last Name, and Email";
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
	
$sql = "SELECT * FROM users WHERE id = '" . $_SESSION['username'] . "'";
$results = pg_query($connection, $sql);
$userInfoArray = pg_fetch_array($results);

// user data
$username = $userInfoArray["id"];
$birthday = $userInfoArray["birthday"];
$strBday = date_create($birthday,"Month-Day-Y");

$firstName = ucwords($userInfoArray['first_name']);

$lastName = ucwords($userInfoArray['last_name']);
	
$userName = strtoupper($userInfoArray['id']);

$email = $userInfoArray['email_address'];

?>

<!-- HTML -->

<h3>Update your Account Information</h3>
<p class="content"><?php echo $description; ?></p>

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
			<td>Username / Login ID</td>
			<td><input type="text" name="newUsername" placeholder="<?php echo $userName;  ?>" size="20" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="pass" placeholder="Enter new password..." size="20" /></td>
		</tr>
		<tr>
			<td>Confirm Password  </td>
			<td><input type="password" name="pass2" placeholder="Confirm new password..." size="20" /></td>
		</tr>
		<tr>
			<td>First Name</td>
			<td><input type="text" name="newFirst" placeholder="<?php echo $firstName;  ?>" size="20" /></td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td><input type="text" name="newLast" placeholder="<?php echo $lastName;  ?>" size="20" /></td>
		</tr>
		<tr>
			<td>Email Address</td>
			<td><input type="text" name="newEmail" placeholder="<?php echo $email;  ?>" size="20" /></td>
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