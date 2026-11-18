<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

//get current user id
$user_id = $_SESSION['user_id'];

//to get a full booking details in one table
$sql = "SELECT 
            b.*,
            p.title AS package_name,
            p.price AS package_price,
            t.title AS transport_name,
            t.price AS transport_price,
            a.title AS accommodation_name,
            a.price AS accommodation_price,
            g.name AS guide_name,
            g.price AS guide_price

        FROM bookings b
        LEFT JOIN packages p ON b.package_id = p.id
        LEFT JOIN transport t ON b.transport_id = t.id
        LEFT JOIN accommodation a ON b.accommodation_id = a.id
        LEFT JOIN tour_guides g ON b.guide_id = g.id

        WHERE b.user_id = $user_id
        ORDER BY b.id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
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
         <h3 class="text-center mb-4 text-success fw-bold">My Bookings</h3>

         <table class="table table-bordered text-center">
             <thead class="table-dark">
                 <tr>
                    <th>Package</th>
                    <th>Total</th>
                    <th>Status</th>
                 </tr>
             </thead>

             <tbody>

           <?php while($row = mysqli_fetch_assoc($result)){ ?>

                <tr>
                    <td>
                        <strong><?php echo $row['package_name']; ?></strong><br>

                        <small class="text-muted">
                            Transport: <?php echo $row['transport_name'] ?? 'None'; ?> (LKR <?php echo $row['transport_price'] ?? 0; ?>)<br>

                            Accommodation: <?php echo $row['accommodation_name'] ?? 'None'; ?> (LKR <?php echo $row['accommodation_price'] ?? 0; ?>)<br>

                            Guide: <?php echo $row['guide_name'] ?? 'None'; ?> (LKR <?php echo $row['guide_price'] ?? 0; ?>)
                        </small>
                    </td>

                    <td>
                        <span class="fw-bold text-success">
                            LKR <?php echo $row['total_price']; ?>
                        </span>
                    </td>

                    <td>
                        <?php if($row['status'] == 'accepted'){ ?>
                             <span class="badge bg-success">Accepted</span>
                        <?php } else { ?>
                              <span class="badge bg-warning text-dark">Pending</span>
                        <?php } ?>
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