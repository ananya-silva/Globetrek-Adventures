<?php
include "config.php";

$id = $_GET['id'];

//fetch existing data
$sql = "SELECT * FROM accommodation WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){    //runs when 'update' button was clicked

    //get updated form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if($_FILES['image']['name'] != ""){      //check if new image is uploaded

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "images/".$image);

        $sql = "UPDATE accommodation 
                SET title='$title', description='$description', price='$price', image='$image'
                WHERE id=$id";

    } else {               //if image not updated, keeps the old image

        $sql = "UPDATE accommodation 
                SET title='$title', description='$description', price='$price'
                WHERE id=$id";
    }

    mysqli_query($conn, $sql);
    header("Location: staff_index.php?msg=accom_updated");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Accommodation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
    <h2 class="text-center mb-4 fw-bold">Edit Accommodation</h2>
    <form method="POST" enctype="multipart/form-data" class="w-50 mx-auto">
        <label>Title</label>
        <input type="text" name="title" class="form-control mb-3"
               value="<?php echo $row['title']; ?>" required>

        <label>Description</label>
        <textarea name="description" class="form-control mb-3" required><?php echo $row['description']; ?></textarea>

        <label>Price</label>
        <input type="number" name="price" class="form-control mb-3"
               value="<?php echo $row['price']; ?>" required>

        <label>Change Image (optional)</label>
        <input type="file" name="image" class="form-control mb-3">

        <button type="submit" name="update" class="btn btn-success w-100">
            Update Accommodation
        </button>
        <a href="staff_index.php" class="btn btn-secondary w-100 mt-2">Cancel</a>   <!--goes back without changing anything-->
    </form>
</div>
</body>
</html>