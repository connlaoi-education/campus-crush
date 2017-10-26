<!-- Page Info -->
<?php
		$title = "Campus Crush - Register";
		$createddate = "September 19 2017";
		$updateddate = "xxxx xx 2017";
		$filename = "user-register.php";
		$banner = "Campus Crush";
		$description = "Sign up is Quick, Easy, and Secure - Your Crush is Waiting!";
?>
<!--
	Creator:      Jeremy Power, Minh Tri Ly
	Filename:    <?php echo $filename; ?>
	Created:      <?php echo $createddate; ?>
	Updated:     <?php echo $updateddate; ?>
	Description: <?php echo $description; ?>
-->

<!-- Include Header PHP -->
<?php include 'header.php';

if(isLoggedIn()) { 
	header("Location:dashboard.php");
	ob_flush();
}
	?>

<!-- HTML -->

<h3>Register Now to Start Chatting!</h3>
<p class="content"><?php echo $description; ?></p>

<?php 
	if(isset($_SESSION["message"])) {
		echo("<p style=\"color: red\">" . $_SESSION["message"] . "</p>");
		unset($_SESSION["message"]);
	}
?>
	
<?php

	$error = "";
	$error_2 = "";
	$results1 = "";
	$results2 = "";
    $years = array();
    for ($i=date("Y"); $i >= 1935; $i--) { 
         array_push($years, $i);
       }


	define("MAX_LAST_NAME_LENGTH", 30);
	define("MAX_FIRST_NAME_LENGTH", 20);
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$username = "";
		$password = "";
		$password2 = "";
		$first_name = "";
		$last_name = "";
		$email = "";
		$day = "";
		$month = "";
		$year = "";
		$account_type = INCOMPLETE;
	}
	
	elseif($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = trim($_POST["login"]);
		$password = trim($_POST["pass"]);
		$password2 = trim($_POST["pass2"]);
		$first_name = trim($_POST["first"]);
		$last_name = trim($_POST["last"]);
		$email = trim($_POST["email"]);
		$day = trim($_POST["day"]);
		$month = trim($_POST["month"]);
		$year = trim($_POST["year"]);
		$account_type = INCOMPLETE;
		
		if(!isset($username) || $username == "")
		{
			$error .= "You did not enter a user id <br/>";
			$username = "";
		}
		else if (strlen($username) < MINIMUM_ID_LENGTH)
		{
			$error .= "A user id must be at least 5 characters <br/>";
			$username = "";
		}
		else if (strlen($username) > MAXIMUM_ID_LENGTH)
		{
			$error .= "Your Login ID must be less than 20 characters. <br/>";
			$username = "";
		}
		
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
			$error .= "Your Login ID must be less than 20 characters. <br/>";
			$password = "";
			$password2 = "";
		}
		else if (strcmp($password, $password2) !== 0) 
		{
			$error .= "Your confirm passwords do not match <br/>";
			$password = "";
			$password2 = "";
		}
		
		if (!isset($first_name) || $first_name == "")
		{
			$error .= "You did not enter your first name <br/>";
			$first_name = "";
		}
		else if (is_numeric($first_name))
		{
			$error .= "Your first name can not contain any numeric values. <br/>";
			$first_name = "";
		}
		else if (strlen($first_name) > MAX_FIRST_NAME_LENGTH)
		{
			$error .= "Your first name must be less than 20 characters. <br/>";
			$first_name = "";
		}
		
		if (!isset($last_name) || $last_name == "")
		{
			$error .= "You did not enter your last name <br/>";
			$last_name = "";
		}
		else if (is_numeric($last_name))
		{
			$error .= "Your first name may not contain any numeric values. <br/>";
			$last_name = "";
		}
		else if (strlen($last_name) > MAX_LAST_NAME_LENGTH)
		{
			$error .= "Your first name must be less than 30 characters. <br/>";
			$last_name = "";
		}

		if(!is_numeric($day) || !is_numeric($year))
		{
			$error .= "Invalid Birthdate. <br/>";
			$day = "";
			$year = "";
			$month = "";
		} else if(!checkdate(($month+1), $day, $year)) {
			$error .= "Invalid Birthdate. <br/>";
			$day = "";
			$year = "";
			$month = "";
		} else if(calculate_Age($year . "-" . $month . "-" . $day) < 18) {
			$error .= "Must be over 18 to use the site. <br/>";
			$day = "";
			$year = "";
			$month = "";
		}
		
		if (!isset($email) || $email == "")
		{
			$error .= "You did not enter an email address <br/>";
			$email = "";
		}
			else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false)
		{
			$error .= "The email address is not valid <br/>";
		}
		
		if($error == "")
		{
			
			$connection = db_connect();
			$results = pg_prepare($connection, "select_id_pass", "SELECT users.id, users.password, users.first_name, users.last_name, users.email_address, users.account_type, users.enroll_date, users.last_access FROM users WHERE id = $1 AND password = $2");
			$results = pg_execute($connection, "select_id_pass", array($username, md5($password)));
			$records = pg_num_rows($results);
			
			if($records >= 1)
			{
				$error_2 = "Error: Your login info already exists in the database.";
			}
			else
			{	
				$today = date("Y-m-d", time());
				$connection = db_connect();
				$birthdate = date("Y-m-d", ($year . "-" . $month . "-" . $day));
				$results = pg_prepare($connection, "insert_user", 'INSERT INTO users (id, password, first_name, last_name, email_address, account_type, birthday, enroll_date, last_access) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)');
				$results = pg_execute($connection, "insert_user", array($username, md5($password), $first_name,
				$last_name, $email, $account_type, $birthdate, $today, $today));
	      $_SESSION['register'] = "Registration successful, please try login";
				header("Location:user-login.php");
				ob_flush();
			}
		}
	}

?>

<hr />

	<h2 class="highlight">
		<?php echo $error; ?>
	</h2>
	<h2 class="highlight">
		<?php echo $error_2; ?>
	</h2>

<br />

<form name="input" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table class="size1">
		<tr>
			<td>Login ID</td>
			<td><input type="text" name="login" value="<?php echo $username; ?>" size="20" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="pass" value="<?php echo $password; ?>" size="20" /></td>
		</tr>
		<tr>
			<td>Confirm Password  </td>
			<td><input type="password" name="pass2" value="<?php echo $password2; ?>" size="20" /></td>
		</tr>
		<tr>
			<td>First Name</td>
			<td><input type="text" name="first" value="<?php echo $first_name; ?>" size="20" /></td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td><input type="text" name="last" value="<?php echo $last_name; ?>" size="20" /></td>
		</tr>
		<tr>
			<td>Email Address</td>
			<td><input type="text" name="email" value="<?php echo $email; ?>" size="20" /></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td>Birthday</td>
			<td style="text-align:left;">
				Day<br /> 
				<input type="text" name="day" value="<?php echo $day ?>" size="5"/>
				<br />
				Month<br />
				  <?php buildDropDown("month", "months", "month_name", $month); ?>
				<br />
				Year<br />
				<select name="year">
					<?php
					for ($i=0; $i < count($years); $i++) {
						echo "<option>" . $years[$i] . "</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
		<td></td>
			<td>
				<input class="btn" type="submit" value="Register" />
				<input class="btn" type="reset" value="Reset" />
			</td>
		</tr>
	</table>
</form>
<br />



<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>