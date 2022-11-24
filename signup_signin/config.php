<?php

$server = "localhost";
$dbuser= "root";
$password = "";
$database = "test1";

try{

    $con1 = new \PDO("mysql:host=$server;dbname=$database;charset=utf8mb4", "$dbuser", "$password", [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,  // make sure the error reporting is enabled!
        \PDO::ATTR_EMULATE_PREPARES => false
    ]);

   // $con1 = new PDO("mysql:hosts=$server; dbname=$database; charset=UTF8","$dbuser","$password");
    //$con1 -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die("Error in connection");
}

/*$host = "localhost";
$dbname = "test1";
$username = "root";
$password = "";

$mysqli = new mysqli($host,
                     $username,
                     $password,
                     $dbname );
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;*/

?>