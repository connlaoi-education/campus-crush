<!-- Page Info -->
<?php
	$title = "Campus Crush - Register";
	$createddate = "September 19 2017";
	$updateddate = "xxxx xx 2017";
	$filename = "user-register.php";
	$banner = "Campus Crush";
	$description = "Forgot your Password? Reset it here!";
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
	if(!isLoggedIn())
	{ 
		header("Location:user-login.php");
		ob_flush();
	}
?>

<!-- HTML -->

<h3>Reset your Password</h3>
<p class="content"><?php echo $description; ?></p>

<?php

?>

<hr />

<br />

<!-- Include Footer PHP -->
<?php include 'footer.php'; ?>