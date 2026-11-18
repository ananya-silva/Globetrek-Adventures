<?php
session_start();
include "config.php";

// allow only admin or staff
if(!isset($_SESSION['role']) || 
   ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'staff')){
    header("Location: index.php");
    exit();
}

// check ID 
if(isset($_GET['id'])){
    //get booking id as a integer
    $id = intval($_GET['id']);

    $sql = "DELETE FROM bookings WHERE id=$id";

    if(mysqli_query($conn, $sql)){
        // redirect back to previous page
        if($_SESSION['role'] == 'admin'){
            header("Location: admin_index.php?msg=booking_deleted");
        } else {
            header("Location: staff_index.php?msg=booking_deleted");
        }
        exit();
    } else {
        echo "Error deleting booking";
    }

} else {
    header("Location: index.php");
    exit();
}
?>