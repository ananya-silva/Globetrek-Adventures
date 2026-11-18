<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

$user_id = intval($_SESSION['user_id']);

$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_assoc($result);

//safety check (if user not found in db then stop running the page)
if(!$user){
    die("User not found in database.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    />

</head>
<body>
    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center bg-light">

    <div class="card shadow-lg border-0" style="width: 420px; border-radius: 18px; overflow:hidden;">

        <!-- header -->
        <div class="text-center text-white p-4"
             style="background: linear-gradient(135deg, #00c9a7, #92fe9d);">

            <div class="bg-white text-success d-flex align-items-center justify-content-center mx-auto"
                 style="width:90px;height:90px;border-radius:50%;font-size:40px;">
                 <i class="bi bi-person-fill"></i>
            </div>

            <h4 class="mt-3 mb-0 fw-bold text-dark">
                <?php echo $user['name']; ?>
            </h4>

            <small class="text-dark">
                <?php echo $user['role']; ?>
            </small>
        </div>

        <div class="p-4">

            <div class="mb-3 d-flex align-items-center">
                <i class="bi bi-envelope-fill text-success me-3"></i>
                <div>
                    <small class="text-muted">Email</small><br>
                    <strong><?php echo $user['email']; ?></strong>
                </div>
            </div>

            <div class="mb-4 d-flex align-items-center">
                <i class="bi bi-calendar-check-fill text-success me-3"></i>
                <div>
                    <small class="text-muted">Joined</small><br>
                    <strong><?php echo $user['created_at']; ?></strong>
                </div>
            </div>

            <div class="d-grid gap-2">

                <a href="logout.php" class="btn btn-outline-danger">
                    Logout
                </a>

            </div>

        </div>

    </div>

</div>

<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
</body>
</html>
