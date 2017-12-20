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

if(isLoggedIn()) {
  header("Location:dashboard.php");
  ob_flush();
}
  ?>

<p class="content" style="color:green;">
    <?php 
            if(isset($_SESSION["success"]))
           {
             echo($_SESSION['success']);
             unset($_SESSION["success"]);
           }
          ?>
</p>
<p class="content" style="color:red;">
          <?php
         if(isset($_SESSION["redirected"]))
          {
            echo($_SESSION["redirected"]);
            unset($_SESSION["redirected"]);
          }
      ?>
</p>

<?php

  if($_SERVER["REQUEST_METHOD"] == "GET")
  {
    $username = "";
    $email = "";
    $error = "";
  }
  elseif($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $error = "";
    $username = trim(htmlspecialchars(strtolower($_POST["username"])));
    $email = trim($_POST["email"]);

    if(!isset($username) || $username == "")
    {
      $error .= "You must enter a username to continue... <br/>";
    }
    if(!isset($email) || $email == "")
    {
      $error .= "You must enter an email to continue... <br/>";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $error .= "Invalid email, try again.";
      $email = "";
    }

    if($error == "")
    {
      $connection = db_connect();
      $results = pg_execute($connection, "find_user", array($username));
      $dataArray = pg_fetch_assoc($results);
      if(pg_num_rows($results) == 0)
      {
        $error = "No account with the username " . $username . " exists.";
        $username = "";
      }
      elseif($dataArray["email_address"] != $email)
      {
        var_dump($dataArray);
        echo($dataArray["email_address"]);
        echo($email);
        $error = "Email does not match username.";
        $email = "";
      }
      else
      {
        $newPass = generateRandomString();
        pg_execute($connection, "update_password", array(md5($newPass), $username));
        $headers = "From: group21@opentech2.durhamcollege.org\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $subject = 'Campus Crush - Password Changed';

        $message = "<html><body>";
        $message .= "<img src=http://opentech2.durhamcollege.org/webd3201/group21/images/cc_logo.png alt='Campus Crush' />";
        $message .= "<h2>Greetings, " . ucwords($dataArray["first_name"]) . "!</h2>";
        $message .= "<h3>Your password on Campus Crush has been changed to: " . $newPass . "</h3><br/>";
        $message .= "<h3>This change occured on: " . date('Y-m-d H:i:s') . "</h3>";
        $message .= "<h3>If you have any problems contact us at: group21@opentech2.durhamcollege.org</h3>";
        $message .= "</body></html>";

        //mail($email, $subject, $message, $headers);
      }
    }
  }

?>

  <p style="color:red;">
    <?php echo $error; ?>
    <?php 
    if(isset($newPass)) {echo "New Password: " . $newPass;} ?>
  </p>

<hr />

<br />

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table>
    <tr>
      <td class="tt1">Confirm Username</td>
      <td><input type="text" name="username" value="<?php echo $username; ?>" size="50" /></td>
    </tr>
    <tr>
      <td class="tt1">Confirm Email</td>
      <td><input type="text" name="email" value="<?php echo $email; ?>" size="50" /></td>
    </tr>
    <tr>
      <td></td>
      <td><input  style="display:inline; width:180px;" class="btn" type="submit" value="Send My Password" /></td>
    </tr>
  </table>
</form>

<!-- Include Footer PHP -->
<?php include 'footer.php'; ?>