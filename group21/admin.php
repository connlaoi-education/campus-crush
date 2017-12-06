<!-- Page Info -->
<?php
  $title = "CC - Admin";
  $createddate = "December 4 2017";
  $updateddate = "xxxx xx 2017";
  $filename = "admin.php";
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
<?php include 'header.php';?>
<p class="content"><?php 
if($_SESSION['account_type'] != ADMIN)
{
	header("Location:dashboard.php");
}
if(isset($_SESSION["admin_message"])) 
{
   echo($_SESSION["admin_message"]);
}

   echo("<p style=\"color: red\">"  .$_SESSION['output'] . "</p>");
  ?></p>
<?php include 'footer.php';?>