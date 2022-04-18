<?php

if (isset($_POST["submit"])) {

    $email = $_POST['email'];
    $fullName = $_POST['fullName'];
    $password = $_POST['pwd'];

    require_once 'dbh.inc.php';
    //require_once 'functions.inc.php';
    /*
    if (emptyInputSignup($email, $fullName, $password) !== false) {
        header("location: ../login.html?error=emptyinput");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../login.html?error=invalidemail");
        exit();
    }
    if (uidExists($conn, $fullName) !== false) {
        header("location: ../login.html?error=uidexists");
        exit();
    }
    if (emailExists($conn, $email)){
        $sql = "SELECT * From test Where email = ?;";
    }
    */
    $SELECT = "SELECT email From test Where email = ? Limit 1;";
    $INSERT = "INSERT Into test (email, fullName, pwd) values(?, ?, ?);";
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sss", $email, $fullName, $password);
        $stmt->execute();
        echo "New account added successfully";

    mysqli_stmt_close($stmt);
    header("location: ../index.html");
}