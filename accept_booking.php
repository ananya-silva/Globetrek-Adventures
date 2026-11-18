<?php
include "config.php";


//this edit function is only accessible to admin and staff to manage the customer bookings by accepting them
$id = $_GET['id'];

$sql = "UPDATE bookings SET status='accepted' WHERE id=$id";

mysqli_query($conn, $sql);

header("Location: staff_index.php");
exit();
?>