<?php
include "config.php";

$id = $_GET['id'];

//fetch existing data
$sql = "SELECT * FROM tour_guides WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){                     //runs when 'update' button was clicked

    //collect updated values
    $name = $_POST['name'];
    $experience = $_POST['experience'];
    $language = $_POST['language'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if(!empty($_FILES['image']['name'])){          //if image is updated then update it or keeps the old image
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "images/".$image);

        //update all fields (including image)
        $sql = "UPDATE tour_guides SET  
                name='$name',
                experience='$experience',
                language='$language',
                price='$price',
                description='$description',
                image='$image'
                WHERE id=$id";
    } else {   //update all fields (except image)
        $sql = "UPDATE tour_guides SET 
                name='$name',
                experience='$experience',
                language='$language',
                price='$price',
                description='$description'
                WHERE id=$id";
    }

    mysqli_query($conn, $sql);

    header("Location: staff_index.php?msg=guide_updated");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tour Guide</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
    <h2 class="text-center mb-4 fw-bold">Edit Tour Guide</h2>
    <form method="POST" enctype="multipart/form-data" class="w-50 mx-auto">

        <label>Name</label>
        <input type="text" name="name" class="form-control mb-3"
               value="<?php echo $row['name']; ?>">

        <label>Experience</label>
        <input type="text" name="experience" class="form-control mb-3"
               value="<?php echo $row['experience']; ?>">

        <label>Language</label>
        <input type="text" name="language" class="form-control mb-3"
               value="<?php echo $row['language']; ?>">

        <label>Price</label>
        <input type="number" name="price" class="form-control mb-3"
               value="<?php echo $row['price']; ?>">

        <label>Description</label>
        <textarea name="description" class="form-control mb-3"><?php echo $row['description']; ?></textarea>

        <label>Change Image (optional)</label>
        <input type="file" name="image" class="form-control mb-3">

        <button type="submit" name="update" class="btn btn-success w-100">
            Update Guide
        </button>

        <a href="staff_index.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
    </form>
</div>

</body>
</html>