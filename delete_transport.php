<?php
include "config.php";

$id = $_GET['id'];

$sql = "DELETE FROM transport WHERE id=$id";

mysqli_query($conn, $sql);

header("Location: staff_index.php");
exit();
?>