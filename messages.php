<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){    //chechs whether a logged in user or not
    header("Location: index.php");   //if not redirect to login page
    exit();
}

$user_id = intval($_SESSION['user_id']);

$sql = "SELECT * FROM messages 
        WHERE user_id = $user_id
        ORDER BY created_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Messages</title>
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
    <div class="container mt-5">

    <h3 class="text-center mb-4 fw-bold text-success">My Messages</h3>

    <div class="card shadow border-0">
        <div class="card-body p-0">

            <table class="table table-hover text-center mb-0">

                <thead class="table-dark">
                    <tr>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Sent At</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($row = mysqli_fetch_assoc($result)){ ?>

                    <tr>

                        <td style="max-width:300px;">
                            <?php echo $row['message']; ?>
                        </td>

                        <td>
                            <?php if($row['status'] == 'replied'){ ?>
                                <span class="badge bg-success px-3 py-2">
                                    Replied
                                    <br>
                                    <small><?php echo $row['replied_at']; ?></small>
                                </span>
                            <?php } else { ?>
                                <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                            <?php } ?>
                        </td>

                        <td class="text-muted">
                            <?php echo $row['created_at']; ?>
                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

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

