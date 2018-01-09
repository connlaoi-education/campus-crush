<?php

  session_start();
  require('includes/constants.php');
  require('includes/functions.php');
  require('includes/db.php');

  if(!isset($_POST['interest_user']))
  {
    header("Location: dashboard.php");
  }
    $connection = db_connect();
    $results = pg_execute($connection, "remove_interest", array($_SESSION['username'], $_POST['interest_user']));

  header("Location: profile-display.php?user=" . $_POST['interest_user']);
?>