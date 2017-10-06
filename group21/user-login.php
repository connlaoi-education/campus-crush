<!-- Page Info -->
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
<?php 
  if(isset($_SESSION["message"])) {
    echo("<p style=\"color: red\">" . $_SESSION["message"] . "</p>");
    unset($_SESSION["message"]);
  }
  ?>
<!-- HTML -->
<span class="titleh3">No need for nonsense...</span>
<p class="content"><?php echo $description; ?></p>
<p class="content"><?php echo "Example account: csmith , cats123" ?></p>
<br />
<hr />
<br />

<?php

	$error = "";
	$output = "";
	$results = "";
	$connecting = "";

	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$username = "";
		$password = "";
	}
	
	elseif($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = trim($_POST["login"]);
		$password = trim($_POST["pass"]);
		
		if(!isset($username) || $username == "")
		{
			$error .= "You must enter a username to continue... <br/>";
		}
		
		if(!isset($password) || $password == "")
		{
			$error .= "You must enter a password to continue... <br/>";
		}
		
		if($error == "")
		{
			$connecting = "Please be patient, we are retrieving your account. <br/> This may takes a few moments...";
			$connection = db_connect();
			$results = pg_prepare($connection, "select_id_pass", 'SELECT id, password, first_name, last_name, email_address, enroll_date, last_access
			FROM users
			WHERE id = $1 AND password = $2');
			$results = pg_execute($connection, "select_id_pass", array($username, md5($password)));
			$records = pg_num_rows($results);
			
			
			if($records >= 1)
			{
				$output = "Welcome, " . pg_fetch_result($results, 0, "first_name") . " " . pg_fetch_result($results, 0, "last_name") . "<br/>Your current email address is " . pg_fetch_result($results, 0, "email_address") . "<br/> Last Login: " . pg_fetch_result($results, 0, "last_access");
				$_SESSION['output'] = $output;
				$connection = db_connect();

				$results = pg_prepare($connection, "date_update", 'UPDATE users SET last_access = current_date WHERE id = $1');
				$results = pg_execute($connection, "date_update", array($username));
				$_SESSION['username'] = $username;
				header("Location:user-dashboard.php");
    		ob_flush();
			}
			elseif($records < 1)
			{		
				$connection = db_connect();
				$results = pg_prepare($connection, "find_user", "SELECT id, password, first_name, last_name, email_address, enroll_date, last_access FROM users WHERE id = $1");
				$results = pg_execute($connection, "find_user", array($username));
				$records = pg_num_rows($results);
				
				if($records >=1)
				{
					$password = "";
					$output = "The password you entered does not match your account name, please try again!";
				}
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