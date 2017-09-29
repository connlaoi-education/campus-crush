<!-- Page Info -->
<?php
		$title = "Campus Crush - Create";
		$createddate = "September 19 2017";
		$updateddate = "xxxx xx 2017";
		$filename = "profile-create.php";
		$banner = "Campus Crush - Profile Creation";
		$description = "Define who you are - What makes you, you?";
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
<p class="content"><?php echo $description; ?></p>

<br />
<hr />
<form name="input" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table class="size1">
    <tr>
      <td>First Name:</td>
      <td><input type="text" name="fname" value="" size="20" /></td>
    </tr>
    <tr>
      <td>Last Name:</td>
      <td><input type="text" name="lname" value="" size="20" /></td>
    </tr>
    <tr>
      <td>Email Address:</td>
      <td><input type="text" name="email" value="" size="20" /></td>
    </tr>
    <tr>
      <td valign="top">Gender:</td>
      <td>
        <input type="radio" name="gender" value="male" checked> Male<br>
        <input type="radio" name="gender" value="female"> Female<br>
        <input type="radio" name="gender" value="other"> Other  </td>
    </tr>
    <tr>
      <td valign="top">Looking for:</td>
      <td>
        <input type="radio" name="lf" value="male" checked> Male<br>
        <input type="radio" name="lf" value="female"> Female<br>
        <input type="radio" name="lf" value="other"> Other  </td>
    </tr>
    <tr>
      <td valign="top">Likes:</td>
      <td><textarea rows="4" cols="50" name="likes">Enter text here...</textarea></td>
    </tr>
    <tr>
      <td valign="top">Dislikes:</td>
      <td><textarea rows="4" cols="50" name="dislikes">Enter text here...</textarea></td>
    </tr>
    <tr>
      <td><input type="submit" value="Save" /></td>
    </tr>
  </table>
</form>

<br />
<br />
<br />



<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>