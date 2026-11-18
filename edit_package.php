<?php
session_start();
include "config.php";

// only staff/admin can access
if(!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin','staff'])){
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// get existing data
$result = mysqli_query($conn, "SELECT * FROM packages WHERE id=$id");
$package = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];

    // image handling (optional update)
    if(!empty($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "images/".$image);

        $sql = "UPDATE packages 
                SET title='$title',
                    description='$description',
                    price='$price',
                    duration='$duration',
                    image='$image'
                WHERE id=$id";
    } else {
        $sql = "UPDATE packages 
                SET title='$title',
                    description='$description',
                    price='$price',
                    duration='$duration'
                WHERE id=$id";
    }

    if(mysqli_query($conn, $sql)){
        header("Location: staff_index.php?msg=package_updated");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Package</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Package</h2>
    <form method="POST" enctype="multipart/form-data" class="w-50 mx-auto">

        <label>Title</label>
        <input type="text" name="title" class="form-control mb-3"
               value="<?php echo $package['title']; ?>" required>

        <label>Description</label>
        <textarea name="description" class="form-control mb-3" required><?php echo $package['description']; ?></textarea>

        <label>Duration</label>
        <input type="text" name="duration" class="form-control mb-3"
               value="<?php echo $package['duration']; ?>" required>

        <label>Price</label>
        <input type="number" name="price" class="form-control mb-3"
               value="<?php echo $package['price']; ?>" required>

        <label>Change Image (optional)</label>
        <input type="file" name="image" class="form-control mb-3">

        <button type="submit" name="update" class="btn btn-success w-100">
            Update Package
        </button>

        <a href="staff_index.php" class="btn btn-secondary w-100 mt-2">
            Cancel
        </a>

    </form>

</div>

</body>
</html>