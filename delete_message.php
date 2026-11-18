<?php
session_start();
include "config.php";

// allow only staff or admin view or delete messages
if(!isset($_SESSION['role']) || ($_SESSION['role'] != 'staff' && $_SESSION['role'] != 'admin')){
    header("Location: index.php");
    exit();
}

if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    $sql = "DELETE FROM messages WHERE id=$id";

    if(mysqli_query($conn, $sql)){
        header("Location: staff_index.php?msg=deleted");
    } else {
        header("Location: staff_index.php?msg=error");
    }
    exit();
}
?>