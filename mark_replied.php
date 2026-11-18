<?php
session_start();
include "config.php";

if(!isset($_SESSION['role'])){
    header("Location: index.php");
    exit();
}

//checks if id is provided
if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    $sql = "UPDATE messages 
            SET status='replied', replied_at=NOW()
            WHERE id=$id";

    mysqli_query($conn, $sql);

    header("Location: staff_index.php");
    exit();
}
?>