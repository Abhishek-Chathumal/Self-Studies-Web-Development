<?php

include "config.php";

if(empty($_POST["name"])){
    die("Username is required!");
}

if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one lower case letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["conform_password"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

try {
    
    $sql = "INSERT INTO user (username, email, password_hash) VALUES (?, ?, ?)";
    $stmnt = $con1->prepare($sql);
    if ($stmnt->execute([$_POST["name"],$_POST["email"],$password_hash])) {
        //header("");
        $login = 'http://localhost/WAD/selfstudy/signup_signin/signin.php';
        $count = $stmnt->rowCount();
        echo nl2br("Signup successful! \n affected $count rows.\n");
        echo "<a href='$login'>Login</a> to your account here";
        exit;
    }
    
} 
catch (\PDOException $e) {
    if ($e->errorInfo[1] === 1062) {
        die("The email or username is already taken!");
    } 
    else {
        echo "An unknown error occured";
        throw $e; // let the exception to be processed further 
    }

}