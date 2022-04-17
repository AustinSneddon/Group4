<?php

function emptyInputSignup($email, $fullName, $password){
    $result = false;
    if (empty($fullName)||empty($email)||empty($password)){
        $result = true;
    }
    return $result;
}

function invalidEmail($email){
    $result = false;
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    return $result;
}
function uidExists($conn, $fullName){
    $sql = "SELECT * From test Where fullName = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login.html?error=stmtfailed");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $fullName);
        mysqli_stmt_execute($stmt);
        
        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $result = false;
            return $result;
        }
    }
    mysqli_stmt_close($stmt);
}
function emailExists($conn, $email){
    $sql = "SELECT * From test Where email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login.html?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){

    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}
function createUser($conn, $fullName, $email, $password){
    /*
    $email = $_POST['email'];
    $fullName = $_POST['fullName'];
    $password = $_POST['password'];
    */ 

    $SELECT = "SELECT email From test Where email = ? Limit 1";
    $INSERT = "INSERT Into test (email, fullName, pwd) values(?, ?, ?)";
    
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
    mysqli_stmt_close($stmt);
    header("location: ../index.html?error=stmtfailed");
}


/* OLD PHP FOR ADDING A USER
$email = $_POST['email'];
$fullName = $_POST['fullName'];
$password = $_POST['password'];

$SELECT = "SELECT email From test Where email = ? Limit 1";
$INSERT = "INSERT Into test (email, fullName, password) values(?, ?, ?)";

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

*/