<?php
$servername = "156.67.73.51";
$database = "u388454019_Customer";
$username = "u388454019_test";
$password = "UNC-Group4!";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if ($conn == false) {
    die("Connection failed: " . mysqli_connect_error());
}