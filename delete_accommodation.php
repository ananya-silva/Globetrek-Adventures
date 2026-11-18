<?php
include "config.php";

$id = $_GET['id'];

$sql = "DELETE FROM accommodation WHERE id=$id";

if(mysqli_query($conn, $sql)){
    header("Location: staff_index.php?msg=accom_deleted");
    exit();
} else {
    header("Location: staff_index.php?msg=error");
    exit();
}
?>