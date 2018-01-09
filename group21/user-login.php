<!-- Page Info -->
<?php
		$title = "Campus Crush - Login";
		$createddate = "September 19 2017";
		$updateddate = "xxxx xx 2017";
		$filename = "user-login.php";
		$banner = "Campus Crush";
		$description = "There is No Easier Way to Meet New People on Campus!";
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

if(isLoggedIn()) {
	header("Location:dashboard.php");
	ob_flush();
}
	?>
<!-- HTML -->

<h3>No Need for Nonsense...</h3>
<p class="content"><?php echo $description; ?></p>

<p class="content" style="color:green;">
	<?php 
		if(isset($_SESSION["register"]))
		{
			echo($_SESSION['register']);
			unset($_SESSION["register"]);
		}
	?>
</p>
<p class="content" style="color:red;">
	<?php
		if(isset($_SESSION["message"]))
		{
			echo($_SESSION["message"]);
			unset($_SESSION["message"]);
		}
		if(isset($_SESSION["redirected"]))
		{
			echo($_SESSION["redirected"]);
			unset($_SESSION["redirected"]);
		}
		if(isset($output))
		{
			echo($output);
			unset($output);
		}
		if(isset($error))
		{
			echo($error);
			unset($error);
		}
	?>
</p>

<?php

	$error = "";
	$output = "";
	$results = "";
	$connecting = "";

	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if(isset($_COOKIE["UserCookie"])) {
			$username = trim(htmlspecialchars($_COOKIE["UserCookie"]));
		}
		else {
			$username = "";
		}
		$password = "";
	}
	
	elseif($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = trim(htmlspecialchars(strtolower($_POST["login"])));
		$password = trim(htmlspecialchars($_POST["pass"]));
		
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
			$results = pg_execute($connection, "select_id_pass", array($username, md5($password)));
			$records = pg_num_rows($results);
			
			
			if($records >= 1)
			{
				$output = pg_fetch_result($results, 0, "last_access");
				$_SESSION['output'] = $output;
				$connection = db_connect();

				$results = pg_execute($connection, "date_update", array($username, date("Y-m-d h:i:s", time())));

				$results = pg_execute($connection, "find_user", array($username));
				$dataArray = pg_fetch_assoc($results);

				$_SESSION['username'] = $dataArray['id'];
				$_SESSION['account_type'] = $dataArray['account_type'];
				$_SESSION['first_name'] = $dataArray['first_name'];
				$_SESSION['last_name'] = $dataArray['last_name'];

    			setcookie("UserCookie", $_SESSION['username'], time() + COOKIE_DURATION);

				if($_SESSION['account_type'] == INCOMPLETE)
				{
					header("Location:profile-create.php");
				} 
				elseif($_SESSION['account_type'] == ADMIN)
				{
					$_SESSION["admin_message"] = "ADMINISTRATOR DASHBOARD";
					header("Location:admin.php");
				}
				else
				{
					header("Location:dashboard.php");
				}
    			ob_flush();
			}
			elseif($records < 1)
			{		
				$connection = db_connect();
				$results = pg_execute($connection, "find_user", array($username));
				$records = pg_num_rows($results);
				
				if($records >=1)
				{
					$password = "";
					$output = "Invalid Password - Please try again!";
				}
				elseif($records < 1)
				{
					$username = "";
					$password = "";
					$output = "Username Not Found - Please try again!";
				}
			}
		}
	}

?>

<hr />
	
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table>
		<tr>
			<td>Username</td>
			<td><input type="text" name="login" value="<?php echo $username; ?>" size="20" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="pass" value="<?php echo $password; ?>" size="20" /></td>
		</tr>
		<tr>
			<td>
					<a href="./user-password-request.php" style="font-style:italic; font-size:10pt;" class="w3-bar-item ">Forgot your password?</a></td>
			<td>
				<input  style="display:inline;" class="btn" type="submit" value="Log In" />
				<input style="display:inline;" class="btn" type="reset" value="Reset" />
			</td>
		</tr>
	</table>
</form>

<p class="content">
	<?php 
		if(isset($connecting))
		{
			echo($connecting);
			unset($connecting);
		}
	?>
</p>
<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>