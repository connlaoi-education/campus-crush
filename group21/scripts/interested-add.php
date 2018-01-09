<?php

  session_start();
  require('../includes/constants.php');
  require('../includes/functions.php');
  require('../includes/db.php');

  if(!isset($_POST['interest_user']))
  {
    header("Location: ../dashboard.php");
  }
    $connection = db_connect();
    $results = pg_execute($connection, "insert_interest", array($_SESSION['username'], $_POST['interest_user'], date("Y-m-d h:i:s", time())));

  header("Location: ../profile-display.php?user=" . $_POST['interest_user']);
?>