<?php
include "config.php";
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'staff'){
    header("Location: index.php");
    exit();
}



//to calculate the total income from bookings (accepted bookings)
$totalIncomeQuery = mysqli_query($conn,
    "SELECT SUM(total_price) AS total_income 
     FROM bookings 
     WHERE status='accepted'"
);

$totalIncomeRow = mysqli_fetch_assoc($totalIncomeQuery);
$totalIncome = $totalIncomeRow['total_income'] ?? 0;      //if no data = 0



//pending income (not accepted bookings)
$pendingIncomeQuery = mysqli_query($conn,
    "SELECT SUM(total_price) AS pending_income 
     FROM bookings 
     WHERE status='pending'"
);

$pendingIncomeRow = mysqli_fetch_assoc($pendingIncomeQuery);
$pendingIncome = $pendingIncomeRow['pending_income'] ?? 0;


//add transport
if(isset($_POST['add_transport'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $image = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($temp, "images/".$image);

    $sql = "INSERT INTO transport (title, image, description, price)
            VALUES ('$title', '$image', '$description', '$price')";

    mysqli_query($conn, $sql);

     $_SESSION['msg'] = "Transport added successfully";
    header("Location: staff_index.php");
    exit();
}

//add accommodation
if(isset($_POST['add_accommodation'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "images/".$image);

    $sql = "INSERT INTO accommodation (title, description, price, image)
            VALUES ('$title', '$description', '$price', '$image')";

    mysqli_query($conn, $sql);

    $_SESSION['msg'] = "Accommodation added successfully";
    header("Location: staff_index.php");
    exit();
}

//add guide
if(isset($_POST['add_guide'])){

    $name = $_POST['name'];
    $experience = $_POST['experience'];
    $language = $_POST['language'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "images/".$image);

    $sql = "INSERT INTO tour_guides 
            (name, experience, language, price, image, description)
            VALUES 
            ('$name', '$experience', '$language', '$price', '$image', '$description')";

    mysqli_query($conn, $sql);

    header("Location: staff_index.php?msg=guide_added");
    exit();
}

//add packages
if(isset($_POST['add_package'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "images/".$image);

    $sql = "INSERT INTO packages (title, description, price, image, duration)
            VALUES ('$title', '$description', '$price', '$image', '$duration')";

    mysqli_query($conn, $sql);

    $_SESSION['msg'] = "Package added successfully";
    header("Location: staff_index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body>

<!---------- navbar ------------>
<nav class="navbar navbar-light justify-content-center fs-1 mb-5 fw-bolder" style="background-color: #00ff5573;">
    Staff Dashboard
</nav>


<!--display income-->
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


<!--display pending price (from not accepted bookings)-->
<div class="container my-5">
    <div class="card text-center shadow p-4">
        <h3 class="fw-bold">Pending Income</h3>
        <h1 class="text-warning">
            LKR <?php echo number_format($pendingIncome); ?>
        </h1>
        <p class="text-muted">Bookings not yet accepted</p>
    </div>
</div>


<hr class="my-5"> 



<!----------- messages ----------->
<div class="container">

    <h3 class="text-center mb-5">Messages</h3>

    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $sql = "SELECT * FROM messages ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
        ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['number']; ?></td>
                <td><?php echo $row['message']; ?></td>

                <td>
                    <?php if($row['status'] == 'replied'){ ?>
                        <span class="badge bg-success">
                            Replied<br>
                            <small><?php echo $row['replied_at']; ?></small>
                        </span>
                    <?php } else { ?>
                        <span class="badge bg-warning text-dark">Pending</span>
                    <?php } ?>
                </td>

                <td>
                    <?php if($row['status'] != 'replied'){ ?>
                        <a href="mark_replied.php?id=<?php echo $row['id']; ?>">
                            <i class="fa-solid fa-check"></i>
                        </a>
                    <?php } ?>

                    <a href="delete_message.php?id=<?php echo $row['id']; ?>"
                       onclick="return confirm('Delete this message?')">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>


<hr class="my-5">



<!----------- add transport ----------->
<div class="container mt-5">
<h3 class="text-center mb-5">Add Transport Options</h3>

<?php
if(isset($_GET['msg']) && $_GET['msg'] == "added"){
    echo "<div class='alert alert-success text-center'>Transport added successfully</div>";
}
?>

<form method="POST" enctype="multipart/form-data" class="w-50 mx-auto">
    <input type="text" name="title" class="form-control mb-2" placeholder="Transport Title" required>
    <textarea name="description" class="form-control mb-2" placeholder="Features (comma separated)" required></textarea>
    <input type="number" name="price" class="form-control mb-2" placeholder="Price (LKR)" required>
    <input type="file" name="image" class="form-control mb-2" required>
    <button type="submit" name="add_transport" class="btn btn-success w-100">
        Add Transport
    </button>
</form>
</div>



<!--------manage transport--------->
<div class="container mt-5">
<h3 class="text-center mb-5">Manage Transport</h3>
<table class="table table-bordered table-hover text-center mt-3">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Price</th>
            <th>Features</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php
    $sql = "SELECT * FROM transport ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
    ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
                <img src="images/<?php echo $row['image']; ?>" width="80" height="60" style="object-fit:cover;">
            </td>
            <td><?php echo $row['title']; ?></td>
            <td>LKR <?php echo $row['price']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>
                <a class="btn btn-primary btn-sm" href="edit_transport.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a class="btn btn-danger btn-sm" href="delete_transport.php?id=<?php echo $row['id']; ?>"
                   onclick="return confirm('Are you sure?')">
                   Delete
                </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>



<!--Add accommodation-->

<hr class="text-dark mt-5">
<h3 class="text-center mt-5 mb-5">Add Accommodation</h3>

<?php
if(isset($_SESSION['msg'])){
    echo "<div class='alert alert-success text-center'>".$_SESSION['msg']."</div>";
    unset($_SESSION['msg']);
}
?>

<form method="POST" enctype="multipart/form-data" class="w-50 mx-auto">       
    <input type="text" name="title" class="form-control mb-2" placeholder="Accommodation Title">
    <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>
    <input type="number" name="price" class="form-control mb-2" placeholder="Price">
    <input type="file" name="image" class="form-control mb-2">
    <button type="submit" name="add_accommodation" class="btn btn-success w-100">
        Add Accommodation
    </button>
</form>


<!--manage accommodation-->
<div class="container mt-5">

<h3 class="text-center mb-5">Manage Accommodation</h3>

<?php
if(isset($_GET['msg']) && $_GET['msg'] == "accom_deleted"){
    echo "<div class='alert alert-success text-center'>Accommodation deleted successfully</div>";
}
?>

<table class="table table-bordered table-hover text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Price</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php
    $sql = "SELECT * FROM accommodation ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
    ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
                <img src="images/<?php echo $row['image']; ?>" width="80" height="60" style="object-fit:cover;">
            </td>
            <td><?php echo $row['title']; ?></td>
            <td>LKR <?php echo $row['price']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>
                <a href="edit_accommodation.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>

                <a href="delete_accommodation.php?id=<?php echo $row['id']; ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Delete this item?')">
                   Delete
                </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>


<!--add tour guides-->
<hr class="mt-5">
<div class="container mt-5">
<h3 class="text-center mb-4">Add Tour Guide</h3>
<form method="POST" enctype="multipart/form-data" class="w-50 mx-auto">
    <input type="text" name="name" class="form-control mb-2" placeholder="Guide Name" required>
    <input type="text" name="experience" class="form-control mb-2" placeholder="Experience (e.g 5 years)" required>
    <input type="text" name="language" class="form-control mb-2" placeholder="Languages (English, French)" required>
    <input type="number" name="price" class="form-control mb-2" placeholder="Price per day" required>
    <textarea name="description" class="form-control mb-2" placeholder="Description" required></textarea>
    <input type="file" name="image" class="form-control mb-2" required>
    <button type="submit" name="add_guide" class="btn btn-success w-100">
        Add Tour Guide
    </button>
</form>
</div>

<!--manage tour guides-->
<div class="container mt-5">
<h3 class="text-center mb-4">Manage Tour Guides</h3>
<table class="table table-bordered table-hover text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Experience</th>
            <th>Language</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php
    include "config.php";

    $sql = "SELECT * FROM tour_guides ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
    ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
                <img src="images/<?php echo $row['image']; ?>" 
                     width="80" height="60" 
                     style="object-fit:cover;">
            </td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['experience']; ?></td>
            <td><?php echo $row['language']; ?></td>
            <td>LKR <?php echo $row['price']; ?></td>
            <td>
                <a href="edit_guide.php?id=<?php echo $row['id']; ?>" 
                   class="btn btn-primary btn-sm">
                   Edit
                </a>
                <a href="delete_guide.php?id=<?php echo $row['id']; ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Are you sure you want to delete this guide?')">
                   Delete
                </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>


<!--add packages-->
<hr class="mt-5">
<div class="container mt-5">
<h3 class="text-center mb-5">Add Travel Packages</h3>
<form method="POST" enctype="multipart/form-data" class="w-50 mx-auto">
    <input type="text" name="title" class="form-control mb-2" placeholder="Package Title" required>
    <textarea name="description" class="form-control mb-2" placeholder="Package Description" required></textarea>
    <input type="text" name="duration" class="form-control mb-2" placeholder="Duration (e.g. 3 Days 2 Nights)" required>
    <input type="number" name="price" class="form-control mb-2" placeholder="Price (LKR)" required>
    <input type="file" name="image" class="form-control mb-2" required>
    <button type="submit" name="add_package" class="btn btn-success w-100">
        Add Package
    </button>
</form>
</div>


<!--manage packages-->
<div class="container mt-5">
<h3 class="text-center mb-5">Manage Packages</h3>
<table class="table table-bordered table-hover text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Duration</th>
            <th>Price</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php
    $sql = "SELECT * FROM packages ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
    ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
                <img src="images/<?php echo $row['image']; ?>" width="80" height="60" style="object-fit:cover;">
            </td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['duration']; ?></td>
            <td>LKR <?php echo $row['price']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>
                <a href="edit_package.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                <a href="delete_package.php?id=<?php echo $row['id']; ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Delete this package?')">
                   Delete
                </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>


<!--view & manage bookings-->
<hr class="mt-5">
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
                <th>Total (LKR)</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        <?php
        include "config.php";

        $sql = "SELECT b.*, u.name AS customer_name, p.title AS package_title
                FROM bookings b
                LEFT JOIN users u ON b.user_id = u.id
                LEFT JOIN packages p ON b.package_id = p.id
                ORDER BY b.id DESC";

        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        ?>

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
                        <a href="delete_booking.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this booking?')">
                           Delete
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>