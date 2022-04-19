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
else{

    $sql = "INSERT INTO test (email, fullName, password) VALUES (?, ?, ?)";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "sss", $email, $fullName, $password);
        
        $email = $_POST['email'];
        $fullName = $_POST['fullName'];
        $password = $_POST['pass'];
        
        mysqli_stmt_execute($stmt);
        
        echo "New account added successfully";
    }
    else{
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
    }
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
header ('Location: index.html');
?>