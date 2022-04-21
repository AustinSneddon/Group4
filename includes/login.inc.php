<?php

//Get values from login.html form
$logUserName = $_POST['name'];
$logPassword = $_POST['pwd'];

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

loginUser($conn, $logUserName, $logPassword);
