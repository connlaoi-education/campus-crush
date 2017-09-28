<!-- Lab Info Variables -->
<?php
		$title = "Campus Crush - Login";
		$createddate = "September 19 2017";
		$updateddate = "xxxx xx 2017";
		$filename = "user-login.php";
		$banner = "Campus Crush - Welcome back!";
		$description = "There is no easier way to meet new people on campus!";
?>
<!--
		Creator:      Connlaoi Smith
        Filename:    <?php echo $filename; ?>
        Created:      <?php echo $createddate; ?>
        Updated:     <?php echo $updateddate; ?>
        Description: <?php echo $description; ?>
-->

<!-- Include Header PHP -->
<?php include 'header.php'; ?>

<!-- HTML -->
<span class="titleh3">No need for nonsense...</span>
<p class="content"><?php echo $description; ?></p>
<p class="content"><?php echo "Example account: csmith , cats123" ?></p>
<br />
<hr />
<br />

<?php
//initializes page variables
	$error = "";
	$output = "";
	$results = "";
	$connecting = "";

//empties variables on first opening
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$username = "";
		$password = "";
	}
	//sets variables to form values
	elseif($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = trim($_POST["login"]);
		$password = trim($_POST["pass"]);
		
		//gives error if no username given
		if(!isset($username) || $username == "")
		{
			$error .= "You must enter a username to continue... <br/>";
		}
		
		//gives error if no pass given
		if(!isset($password) || $password == "")
		{
			$error .= "You must enter a password to continue... <br/>";
		}
		
		//if both user and pass are given, checks DB for matching user with this
		//password
		if($error == "")
		{
			$connecting = "Please be patient, we are retrieving your account. <br/> This may takes a few moments...";
			$connection = db_connect();
			$results = pg_prepare($connection, "select_id_pass", 'SELECT id, password, first_name, last_name, email_address, enroll_date, last_access
			FROM users
			WHERE id = $1 AND password = $2');
			$results = pg_execute($connection, "select_id_pass", array($username, md5($password)));
			$records = pg_num_rows($results);
			
			//if a user is found
			if($records >= 1)
			{
				$connection = db_connect();
				$results = pg_prepare($connection, "date_update", 'UPDATE users SET last_access = current_date WHERE id = $1');
				$results = pg_execute($connection, "date_update", array($username));
				//adds that user to the current session for profile purposes
				$_SESSION['username'] = $username;
				//redirects to the dashboard
				header("Location:user-dashboard.php");
    		ob_flush();
			}
			//if no users found
			elseif($records < 1)
			{		
				//check DB for if username exists
				$connection = db_connect();
				$results = pg_prepare($connection, "find_user", "SELECT id, password, first_name, last_name, email_address, enroll_date, last_access FROM users WHERE id = $1");
				$results = pg_execute($connection, "find_user", array($username));
				$records = pg_num_rows($results);
				
				//if person is found, then password is wrong
				if($records >=1)
				{
					$password = "";
					$output = "The password you entered does not match your account name, please try again!";
				}

				//otherwise, that user is not in database
				elseif($records < 1)
				{
					$username = "";
					$password = "";
					$output = "Login/Password Not Found - Please try again!";
				}
			}
		}
	}

?>
	<br />
	<h2 class="highlight">
		<?php echo $error ?>
	</h2>
	<h2 class="highlight">
		<?php echo $output ?>
	</h2>
	<br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table>
		<tr>
			<td class="tt1">Login ID</td>
			<td><input type="text" name="login" value="<?php echo $username; ?>" size="20" /></td>
		</tr>
		<tr>
			<td class="tt1">Password</td>
			<td><input type="password" name="pass" value="<?php echo $password; ?>" size="20" /></td>
		</tr>
		<tr>
			<td><br /><input type="submit" value="Log In" /></td>
			<td><br /><input type="reset" value="Reset" /></td>
		</tr>
	</table>
</form>

<p class="content">
	<?php echo $connecting ?>
</p>
<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>