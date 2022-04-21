<?php
function invalidEmail($email){
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    return $result;
}

function uidTaken($conn, $fullName){
    $sql = "SELECT * FROM test WHERE fullName = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login.html");
        exit();
    }

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
    mysqli_stmt_close($stmt);
}

function emailTaken($conn, $email){
    $sql = "SELECT * FROM test WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login.html");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $email, $fullName, $pass){
    $sql = "INSERT INTO test (email, fullName, password) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login.html");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $email, $fullName, $pass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.html?error=none");
}

function loginUser($conn, $logUserName, $logPassword){
$sql = "SELECT * FROM test WHERE fullName=? AND password=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("ss", $logUserName, $logPassword);
$stmt->execute();
$result = $stmt->get_result(); 
$row = $result->fetch_assoc();
if ($row['fullName'] === $logUserName && $row['password'] === $logPassword) {

    echo "Logged in!";
    exit();

}
else{
    echo "whoopsie doopsiessss";
}
}