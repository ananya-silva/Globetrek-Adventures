<?php
include "config.php";

$id = $_GET['id'];

$sql = "SELECT * FROM transport WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "UPDATE transport 
            SET title='$title',
                price='$price',
                description='$description'
            WHERE id=$id";

    mysqli_query($conn, $sql);

    header("Location: staff_index.php?msg=transport_updated");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Transport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h2 class="text-center mb-4 fw-bold">Edit Transport</h2>

    <form method="POST" class="w-50 mx-auto">

        <label>Title</label>
        <input type="text" name="title" class="form-control mb-3"
               value="<?php echo $row['title']; ?>" required>

        <label>Price</label>
        <input type="number" name="price" class="form-control mb-3"
               value="<?php echo $row['price']; ?>" required>

        <label>Description</label>
        <textarea name="description" class="form-control mb-3" required><?php echo $row['description']; ?></textarea>

        <button type="submit" name="update" class="btn btn-success w-100">
            Update Transport
        </button>

        <a href="staff_index.php" class="btn btn-secondary w-100 mt-2">Cancel</a>

    </form>

</div>

</body>
</html>