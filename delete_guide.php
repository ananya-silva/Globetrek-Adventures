<?php
include "config.php";

$id = $_GET['id'];

$sql = "DELETE FROM tour_guides WHERE id=$id";
mysqli_query($conn, $sql);

header("Location: staff_index.php?msg=guide_deleted");
exit();
?>