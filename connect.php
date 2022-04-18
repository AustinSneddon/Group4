<?php
$servername = "156.67.73.51";
$database = "u388454019_Customer";
$username = "u388454019_test";
$password = "UNC-Group4!";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
$email = $_POST['email'];
$fullName = $_POST['fullName'];
$password = $_POST['pass'];

$SELECT = "SELECT email From test Where email = ? Limit 1";
$INSERT = "INSERT Into test (email, fullName, pass) values(?, ?, ?)";

$stmt = $conn->prepare($SELECT);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($email);
$stmt->store_result();
$rnum = $stmt->num_rows;

if($rnum==0){
    $stmt->close();
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("sss", $email, $fullName, $password);
    $stmt->execute();
    echo "New account added successfully";
}
else{
    echo "Sorry, this email has already been taken.";
}
}
header ('Location: index.html');
$mysqli -> close();
exit;
?>