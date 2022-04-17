
<?php

$dBServername = "156.67.73.51";
$dBDatabase = "u388454019_Customer";
$dBUsername = "u388454019_test";
$dBPassword = "UNC-Group4!";

// Create connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBDatabase);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
    echo "it worked!";
}
?>