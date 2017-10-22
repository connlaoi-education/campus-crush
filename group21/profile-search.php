<!-- Page Info -->
<?php
		$title = "Campus Crush - Search";
		$createddate = "September 19 2017";
		$updateddate = "xxxx xx 2017";
		$filename = "profile-search.php";
		$banner = "Campus Crush";
		$page = "Search for Users";
		$description = "Find your Friends - Or your Crush";
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

if(!isLoggedIn()) { 
  header("Location:user-login.php");
  ob_flush();
}
  ?>

<!-- HTML -->
<p class="content"><?php echo $description; ?></p>

<br />
<hr />

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table>
    <tr>
      <td class="tt1">Search:</td>
      <td><input type="text" name="searchbar" value="" size="20" /></td>
      <td><input type="submit" value="Search" /></td>
    </tr>
  </table>
</form>

<br />



<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>