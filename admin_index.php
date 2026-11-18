<?php
session_start();
include "config.php";

//login check
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){                
    header("Location: index.php");
    exit();
}

//users table --> cus_name , packages table --> package_title
$bookingSql = "SELECT b.*, u.name AS customer_name, p.title AS package_title       
               FROM bookings b
               LEFT JOIN users u ON b.user_id = u.id
               LEFT JOIN packages p ON b.package_id = p.id
               ORDER BY b.id DESC";

$bookingResult = mysqli_query($conn, $bookingSql);


//total income from accepted bookings
$totalIncomeQuery = mysqli_query($conn,
    "SELECT SUM(total_price) AS total_income 
     FROM bookings 
     WHERE status='accepted'");

$totalIncomeRow = mysqli_fetch_assoc($totalIncomeQuery);
$totalIncome = $totalIncomeRow['total_income'] ?? 0;


//pending income (when admin didn't accept the booking)
$pendingIncomeQuery = mysqli_query($conn,
    "SELECT SUM(total_price) AS pending_income 
     FROM bookings 
     WHERE status='pending'");

$pendingIncomeRow = mysqli_fetch_assoc($pendingIncomeQuery);
$pendingIncome = $pendingIncomeRow['pending_income'] ?? 0;


//sales report
$salesReport = mysqli_query($conn, "
    SELECT 
        DATE(created_at) as date,
        COUNT(*) as total_bookings,
        SUM(total_price) as total_sales
    FROM bookings
    WHERE status='accepted'
    GROUP BY DATE(created_at)
    ORDER BY date DESC");


//customer report
$customerReport = mysqli_query($conn, "
    SELECT 
        u.name,
        u.email,
        COUNT(b.id) as total_bookings,
        SUM(b.total_price) as total_spent
    FROM users u
    LEFT JOIN bookings b ON u.id = b.user_id AND b.status='accepted'
    GROUP BY u.id
    ORDER BY total_spent DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    
     
</head>
<body>

    <nav class="navbar navbar-light justify-content-center fs-1 mb-5 fw-bolder" 
    style="background-color: #00ff5573;">
        Admin Dashboard
    </nav>



    <div class="container mt-4 mb-4">
    <div class="card text-center shadow p-4">
        <h3 class="fw-bold">Total Income</h3>
        <h1 class="text-success">
            LKR <?php echo number_format($totalIncome); ?>
        </h1>
        <p class="text-muted">From all bookings</p>
    </div>
</div>


<hr class="my-5">



<div class="container mt-3">
    <div class="card text-center shadow p-4">
        <h3 class="fw-bold">Pending Income</h3>
        <h1 class="text-warning">
            LKR <?php echo number_format($pendingIncome); ?>
        </h1>
        <p class="text-muted">Bookings not yet accepted</p>
    </div>
</div>



<hr class="my-5">



    <!--insert admin and staff details (CRUD)-->
    <div class="container">
            <?php 
            if(isset($_GET['msg'])) {
                $msg = $_GET['msg'];
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                     '.$msg.'
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>';
            }
            ?>
            <h3 class="text-center">Admin & Staff details</h3>
        <a href="add_new.php" class="btn btn-dark mb-3">Add New</a>

        <table class="table table-hover text-center">
  <thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include "config.php";
    $sql = "SELECT * FROM admin_staff";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
           <tr>
               <td><?php echo $row['id'] ?></td>
               <td><?php echo $row['name'] ?></td>
               <td><?php echo $row['email'] ?></td>
               <td><?php echo $row['password'] ?></td>
               <td><?php echo $row['role'] ?></td>
               <td>
                   <a href="edit.php?id=<?php echo $row['id'] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
        
                   <a href="delete.php?id=<?php echo $row['id'] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
              </td>
          </tr>
     <?php
    }
    ?>

  </tbody>
</table>
    </div>



    <hr class="my-5">



    <!--customer details-->
    <div class="container mt-5">

    <h3 class="text-center mb-5">Customer Details</h3>

    <table class="table table-hover text-center">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        <?php

        $sql = "SELECT id, name, email, password, role, created_at FROM users ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
        ?>

            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td><?php echo $row['created_at']; ?></td>

                <td>
                    <a href="delete_user.php?id=<?php echo $row['id']; ?>" 
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Are you sure you want to delete this user?')">
                       Delete
                    </a>
                </td>
            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>



<hr class="my-5">


<!--manage bookings-->
<div class="container mt-5">

    <h3 class="text-center mb-5">Package Bookings</h3>

    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Package</th>
                <th>Transport</th>
                <th>Accommodation</th>
                <th>Guide</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        <?php while($row = mysqli_fetch_assoc($bookingResult)){ ?>

            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['customer_name']; ?></td>
                <td><?php echo $row['package_title']; ?></td>

                <td><?php echo $row['transport_id']; ?></td>
                <td><?php echo $row['accommodation_id']; ?></td>
                <td><?php echo $row['guide_id']; ?></td>

                <td>LKR <?php echo $row['total_price']; ?></td>

                <td>
                    <?php if($row['status'] == 'accepted'){ ?>
                        <span class="badge bg-success">Accepted</span>
                    <?php } else { ?>
                        <span class="badge bg-warning text-dark">Pending</span>
                    <?php } ?>
                </td>

                <td>
                    <?php if($row['status'] != 'accepted'){ ?>
                        <a href="accept_booking.php?id=<?php echo $row['id']; ?>"
                           class="btn btn-sm btn-success">
                           Accept
                        </a>
                    <?php } ?>

                    <a href="delete_booking.php?id=<?php echo $row['id']; ?>"
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Delete this booking?')">
                       Delete
                    </a>
                </td>
            </tr>

        <?php } ?>

        </tbody>
    </table>

</div>

<hr class="my-5">




<div class="container">
    <h3 class="text-center mb-4">Sales Report</h3>

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Total Bookings</th>
                <th>Total Sales (LKR)</th>
            </tr>
        </thead>

        <tbody>
        <?php while($row = mysqli_fetch_assoc($salesReport)){ ?>
            <tr>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['total_bookings']; ?></td>
                <td><?php echo number_format($row['total_sales']); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>




<hr class="my-5">

<div class="container">
    <h3 class="text-center mb-4">Customer Report</h3>

    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Total Bookings</th>
                <th>Total Spent (LKR)</th>
            </tr>
        </thead>

        <tbody>
        <?php while($row = mysqli_fetch_assoc($customerReport)){ ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['total_bookings']; ?></td>
                <td>
                    <?php echo number_format($row['total_spent'] ?? 0); ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>



    
<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
</body>
</html>