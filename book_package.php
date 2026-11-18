<?php
session_start();
include "config.php";

// check login
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

// get package
$package_id = $_GET['id'];

$package = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM packages WHERE id=$package_id")
);

//initial values (starts calculation from 0)
$total = 0;

// calculate 
if(isset($_POST['calculate'])){

    //collects user selections
    $package_id = $_POST['package_id'];
    $transport = $_POST['transport'];
    $accommodation = $_POST['accommodation'];
    $guide = $_POST['guide'];

    // package price (fetch from db table 'packages')
    $p = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT price FROM packages WHERE id=$package_id")
    );
    $total += $p['price'];

    // transport price (fetch from db table 'transport')
    if(!empty($transport)){
        $t = mysqli_fetch_assoc(
            mysqli_query($conn, "SELECT price FROM transport WHERE id=$transport")
        );
        $total += $t['price'];
    }

    // accommodation price (fetch from db table 'accommodation')
    if(!empty($accommodation)){
        $a = mysqli_fetch_assoc(
            mysqli_query($conn, "SELECT price FROM accommodation WHERE id=$accommodation")
        );
        $total += $a['price'];
    }

    // tour guide price (fetch from db table 'tour_guides')
    if(!empty($guide)){
        $g = mysqli_fetch_assoc(
            mysqli_query($conn, "SELECT price FROM tour_guides WHERE id=$guide")
        );
        $total += $g['price'];
    }

    //store data temporary in a session until booking confirms
    $_SESSION['calculated_total'] = $total;
    $_SESSION['booking_data'] = $_POST;
}

// confirm booking
if(isset($_POST['confirm'])){

    $user_id = $_SESSION['user_id'];
    $data = $_SESSION['booking_data'];                                                       //get previously saved data
    $total = $_SESSION['calculated_total'];

    mysqli_query($conn, "INSERT INTO bookings 
    (user_id, package_id, transport_id, accommodation_id, guide_id, total_price, status)    
    VALUES  
    ('$user_id',
     '{$data['package_id']}',
     '{$data['transport']}',
     '{$data['accommodation']}',
     '{$data['guide']}',
     '$total',
     'pending')");                       //pending until admin/staff accept booking

    // session clear (temporary data)
    unset($_SESSION['booking_data']);
    unset($_SESSION['calculated_total']);

    //validation (confirm alert)
    echo "
        <script>
           alert('Booking Successful, Please wait for Approvals');
           window.location.href='bookings.php';
        </script>
        ";
        exit();
}
?>


<!doctype html>
<html>
<head>
    <title>Book Package</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="text-center mb-4 fw-bolder">Book Your Package</h2>

    <!-- displaying package details -->
    <div class="card mb-4 p-3 text-center" style="background-color: wheat;">
        <h2><?php echo $package['title']; ?></h2>
        <p><?php echo $package['description']; ?></p>
        <h4 class="text-success">
            Base Price: LKR <?php echo $package['price']; ?>
        </h4>
    </div>

    <!-- package booking form -->
    <form method="POST" class="w-50 mx-auto">
        <input type="hidden" name="package_id" value="<?php echo $package_id; ?>">

        <!-- transport selection-->
        <label>Transport:</label>
        <select name="transport" class="form-control mb-3">
            <option value="">None</option>
            <?php
            $t = mysqli_query($conn, "SELECT * FROM transport");
            while($row = mysqli_fetch_assoc($t)){
                echo "<option value='{$row['id']}'>{$row['title']} - LKR {$row['price']}</option>";
            }
            ?>
        </select>

        <!-- accommodation selection -->
        <label>Accommodation:</label>
        <select name="accommodation" class="form-control mb-3">
            <option value="">None</option>
            <?php
            $a = mysqli_query($conn, "SELECT * FROM accommodation");
            while($row = mysqli_fetch_assoc($a)){
                echo "<option value='{$row['id']}'>{$row['title']} - LKR {$row['price']}</option>";
            }
            ?>
        </select>

        <!-- tour guide selection -->
        <label>Tour Guide:</label>
        <select name="guide" class="form-control mb-3">
            <option value="">None</option>
            <?php
            $g = mysqli_query($conn, "SELECT * FROM tour_guides");
            while($row = mysqli_fetch_assoc($g)){
                echo "<option value='{$row['id']}'>{$row['name']} - LKR {$row['price']}</option>";
            }
            ?>
        </select>
        <!--button to calculate the total amount-->
        <button type="submit" name="calculate" class="btn btn-success w-100">
            Calculate Total
        </button>

    </form>

    <!--display total calculation-->
    <?php if(isset($_SESSION['calculated_total'])) { ?>
        <div class="text-center mt-4">
            <h4 class="text-primary">
                Total Price: LKR <?php echo $_SESSION['calculated_total']; ?>
            </h4>
            <!-- confirm booking (after clicking admin and staff will get the request to accept) -->
            <form method="POST">
                <button type="submit" name="confirm" class="btn btn-primary w-50 mt-2">
                    Confirm Booking
                </button>
            </form>
        </div>
    <?php } ?>

</div>
</body>
</html>