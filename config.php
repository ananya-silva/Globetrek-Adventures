<?php

$host = "localhost";       //database server address
$user = "root";            //username with access to MySQL (default)
$password = "";            //since I'm using a local server password isn't required
$database = "users_db";    //database i created

$conn = new mysqli($host, $user, $password, $database);

//checks whether the database is connected
if($conn->connect_error) {          
    //if there's no errors the program proceeds without showing anything                       
    die("Connection failed: ". $conn->connect_error);      
}

?>