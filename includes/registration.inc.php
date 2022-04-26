<?php 

if(isset($_POST["submit"])){

    $email = $_POST['email'];
    $fullName = $_POST['fullName'];
    $password = $_POST['pass'];
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location: ../login.html?error=invalidEmail"); 
      }
      else if (!checkUID($conn, $fullName)){
        header("location: ../login.html?error=UIDtaken");
    }
    else if(!checkEmail($conn, $email)){
        header("location: ../login.html?error=emailTaken");
    }
    else{
            createUser($conn, $email, $fullName, $password);
    }
}
else{
    header ('Location: ../login.html?error=somethingFailed');
}