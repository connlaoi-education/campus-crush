<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
    Group 21
	Name: Jeremy Power
    File: <?php echo "$fileName \n"; ?>
    Date: <?php echo "$date \n"; ?>
    <?php echo "$description \n"; ?>
-->
    <?php 
	require('includes/constants.php');
	require('includes/db.php');
	require('includes/functions.php');
	?>
    <?php ob_start();
    session_start() ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' />
    <link rel="stylesheet" href="./css/crush.css" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo "$title";?></title>
    <link rel="shortcut icon" type="image/x-icon" href="./images/cc_logo.png" />
</head>

<body>
    <div id="container">
        <div id="header">
            <a href="./index.php"><img src="./images/cc_logo.png" alt="Campus Crush" /></a>
            <?php echo "<h1>$banner</h1>";?>
        </div>
        <div id="sites">
                <ul>
                    <?php
                    if(!isset($_SESSION['username'])) {
                    echo('<li><a href="./user-login.php">Login</a></li>
                    <li><a href="./user-register.php">Register</a></li>');
                } else {
                    echo('
                    <li><a href="./user-dashboard.php">Dashboard</a></li>
                    <li><a href="./profile-create.php">Profile Create</a></li>
                    <li><a href="./profile-search.php">Profile Search</a></li>                  
                    <li><a href="./profile-search-results.php">Search Results</a></li>
                    <li><a href="./profile-display.php">Profile Display</a></li>
                    <li style="float: right;"><a href="./user-logout.php">Logout</a></li> ');
                }
                    ?>
                </ul>
        </div>
        <div id="content-container">
            <div id="content">