<!-- Page Info -->
<?php
    $title = "Campus Crush - Logout";
    $createddate = "October 6 2017";
    $updateddate = "xxxx xx 2017";
    $filename = "user-logout.php";
    $banner = "Campus Crush - Welcome back!";
    $description = "Backend page to destroy session";
?>
<!--
  Creator:      Jeremy Power
  Filename:    <?php echo $filename; ?>
  Created:      <?php echo $createddate; ?>
  Updated:     <?php echo $updateddate; ?>
  Description: <?php echo $description; ?>
-->

<?php
session_start();

if ($_SESSION) {
  session_unset();
  session_destroy();

  session_start();
  $message = "Logout Successful, Have a Great Day!";

  $_SESSION['message'] = $message;
  header("Location:user-login.php");
  ob_flush();
} else {
  $message = "Logout Unsuccessful, Please Try Again";

  $_SESSION['message'] = $message;
  header("Location:user-dashboard.php");
  ob_flush();
}
?>