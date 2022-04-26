<?php
function checkEmail($conn, $email){
    $check = true;
    $sql = "SELECT * FROM test WHERE email=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result(); 
    $row = $result->fetch_assoc();
    
    if ($row['email'] === $email){
            $check = false;
            return $check;
        }
    else{
        return $check;
    }
    }
function checkUID($conn, $fullName){
$check = true;
$sql = "SELECT * FROM test WHERE fullName=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $fullName);
$stmt->execute();
$result = $stmt->get_result(); 
$row = $result->fetch_assoc();

if ($row['fullName'] === $fullName){
        $check = false;
        return $check;
    }
else{
    return $check;
}
}

function createUser($conn, $email, $fullName, $pass){
    $sql = "INSERT INTO test (email, fullName, password) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn, $sql);

    $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $email, $fullName, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.html?error=none");
}

function loginUser($conn, $logUserName, $logPassword){
$sql = "SELECT * FROM test WHERE fullName=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $logUserName);
$stmt->execute();
$result = $stmt->get_result(); 
$row = $result->fetch_assoc();

if ($row['fullName'] === $logUserName && password_verify($logPassword, $row['password'])) {
    echo "Logged in!";
    exit();
}
else{
    echo "Incorrect Username or Password";
}
}