<!-- Page Info -->
<?php
		$title = "Campus Crush - Register";
		$createddate = "September 19 2017";
		$updateddate = "xxxx xx 2017";
		$filename = "user-register.php";
		$banner = "Campus Crush - Registration";
		$description = "Sign up quickly and easily - start meeting new people now!";
?>
<!--
	Creator:      Jeremy Power
	Filename:    <?php echo $filename; ?>
	Created:      <?php echo $createddate; ?>
	Updated:     <?php echo $updateddate; ?>
	Description: <?php echo $description; ?>
-->

<!-- Include Header PHP -->
<?php include 'header.php'; ?>

<!-- HTML -->
<p class="content"><?php echo $description; ?></p>

<br />
<hr />
<form name="input" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table class="size1">
		<tr>
			<td>Login ID</td>
			<td><input type="text" name="login" value="" size="20" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="pass" value="" size="20" /></td>
		</tr>
		<tr>
			<td>Confirm Password</td>
			<td><input type="password" name="pass2" value="" size="20" /></td>
		</tr>
		<tr>
			<td>First Name</td>
			<td><input type="text" name="first" value="" size="20" /></td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td><input type="text" name="last" value="" size="20" /></td>
		</tr>
		<tr>
			<td>Email Address</td>
			<td><input type="text" name="email" value="" size="20" /></td>
		</tr>
		<tr>
			<td><input type="submit" value="Register" /></td>
			<td><input type="reset" value="Reset" /></td>
		</tr>
	</table>
</form>
<br />



<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>