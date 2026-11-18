<?php
include "config.php";

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id=$id";

mysqli_query($conn, $sql);

header("Location: admin_index.php?msg=User deleted successfully");
exit();
?>