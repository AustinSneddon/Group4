<?php 

if(isset($_POST["submit"])){

    $email = $_POST['email'];
    $fullName = $_POST['fullName'];
    $password = $_POST['pass'];
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    createUser($conn, $email, $fullName, $password);
    /*
    if(invalidEmail($email) == false) {
        header("location: ../login.html");
        exit();
    }
    else if(uidTaken($conn, $fullName) == false) {
        header("location: ../login.html");
        exit();
    }
    else if(emailTaken($conn, $email) == false) {
        header("location: ../login.html");
        exit();
    }
    else{
        createUser($conn, $email, $fullName, $password);
    }
    */
}
else{
    header ('Location: ../login.html?error=somethingFailed');
}