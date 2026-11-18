<?php
include "config.php";
$id = $_GET['id'];

if(isset($_POST['submit'])) {

    //get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // check if password field is NOT empty
    if(!empty($_POST['password'])){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "UPDATE admin_staff 
                SET name='$name', email='$email', password='$password', role='$role' 
                WHERE id=$id";
    } else {
        // don't update password
        $sql = "UPDATE admin_staff 
                SET name='$name', email='$email', role='$role' 
                WHERE id=$id";
    }

    $result = mysqli_query($conn, $sql);

    if($result) {
        header("Location: admin_index.php?msg=Data updated successfully!");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
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
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" 
    style="background-color: #00ff5573;">
        Admin Dashboard
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit User Information</h3>
            <p class="text-muted">Click update after changing any information.</p>
        </div>

        <?php 
        $sql = "SELECT * FROM admin_staff WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width: 50vw; min-width: 300px;">
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
                </div>
                <div class="form-group ">
                    <label>Role: </label> &nbsp;   <!--non-breaking space-->
                    <input type="radio" class="form-check-input" name="role" 
                    id="admin" value="admin" <?php echo ($row['role']=='admin')? "checked":""; ?>>
                    <label for="admin" class="form-input-label">Admin</label>
                    &nbsp;
                     <input type="radio" class="form-check-input" name="role" 
                    id="staff" value="staff" <?php echo ($row['role']=='staff')? "checked":""; ?>>
                    <label for="staff" class="form-input-label">Staff</label>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="admin_index.php" class="btn  btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
</body>
</html>