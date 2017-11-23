<!-- Page Info -->
<?php
	$title = "CC - Password";
	$createddate = "September 19 2017";
	$updateddate = "xxxx xx 2017";
	$filename = "user-register.php";
	$banner = "Campus Crush";
	$description = "Forget your Password? Request it here!";
?>
<!--
	Creator:      Jeremy Power, Minh Tri Ly
	Filename:    <?php echo $filename; ?>
	Created:      <?php echo $createddate; ?>
	Updated:     <?php echo $updateddate; ?>
	Description: <?php echo $description; ?>
-->

<!-- Include Header PHP -->
<?php include 'header.php';?>

<!-- HTML -->

<h3>Request your Password</h3>
<p class="content"><?php echo $description; ?></p>

<?php

?>

<hr />

<br />

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table>
		<tr>
			<td class="tt1">Confirm Email</td>
			<td><input type="text" name="cemail" size="50" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input  style="display:inline; width:180px;" class="btn" type="submit" value="Send My Password" /></td>
		</tr>
	</table>
</form>

<!-- Include Footer PHP -->
<?php include 'footer.php'; ?>