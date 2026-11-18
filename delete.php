<?php 
include "config.php";
$id = $_GET['id'];
$sql = "DELETE FROM admin_staff WHERE id = $id";
$result = mysqli_query($conn, $sql);
if($result) {
    header("Location: admin_index.php?msg=Record deleted successfully!");
}
else {
    echo "Failed: " . mysqli_error($conn);
}
?>