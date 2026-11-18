<?php $page = "services"; ?>

<?php session_start(); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GlobeTrek Adventures Services</title>
    <link rel="stylesheet" href="services.css" />
    <link rel="stylesheet" href="reviews.css" />
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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <!--navbar-->
    <?php include "navbar.php"; ?>

    <!--hero image-->
    <div class="hero-container">
      <div class="hero-image">
        <img src="images/services_hero.jpg" alt="" />
        <div class="hero-text">
          <h1>Explore Our Travel Services</h1>
          <p>
            From personalized travel planning to guided tours and seamless
            bookings, we take care of every detail so you can focus on enjoying
            your journey.
          </p>
        </div>
      </div>
    </div>

    <!--accommodation cards-->
    <div class="container mb-5 p-5 mt-5" style="background-color: #90d18e;">

        <div class="travel-intro w-100 text-center my-3">
        <h1 class="fw-bolder fs-1 mt-3">Comfortable Accommodation Options</h1>
        <p style="font-size: 15px" class="mb-5">
            Choose from a range of safe, comfortable, and affordable stays
            across Sri Lanka for a relaxing travel experience.
        </p>
        </div>

        <div class="row g-4">

        <?php
        include "config.php";

        $sql = "SELECT * FROM accommodation";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
        ?>

        <div class="col-md-4">

            <div class="card h-100 shadow">

                <img src="images/<?php echo $row['image']; ?>" 
                     class="card-img-top" 
                     style="height:200px; object-fit:cover;">

                <div class="card-body">

                    <h5 class="card-title text-success text-center fs-3 fw-bolder">
                        <?php echo $row['title']; ?>
                    </h5>

                    <p class="fw-bold fs-5 text-center my-3">
                        LKR <?php echo $row['price']; ?>
                    </p>

                    <p class="card-text text-center">
                        <?php echo $row['description']; ?>
                    </p>

                    <a href="packages_page.php" class="btn btn-success w-100">
                        Book Now
                    </a>

                </div>

            </div>

        </div>

        <?php } ?>

        </div>
        <p class="text-center mt-5">Please note: Accommodation services are 
          exclusively available with package bookings.</p>

    </div>



    <!-- travel cards (bootstrap cards) -->
    <div class="container mb-5 p-5 mt-5" style="background-color: lightgray;">
    <div class="travel-intro w-100 text-center my-3">
        <h1 class="fw-bolder fs-1 mt-3">Reliable Travel & Transport Services</h1>
        <p style="font-size: 15px" class="mb-5">
            Choose from a range of safe, comfortable, and affordable transport
            options designed to make your journey across Sri Lanka smooth and
            stress-free.
        </p>
    </div>

    <div class="row g-4">

        <?php
        include "config.php";

        $sql = "SELECT * FROM transport";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            
            $features = explode(",", $row['description']);
        ?>

        <div class="col-md-4">

            <div class="card h-100 shadow">

                <img src="images/<?php echo $row['image']; ?>" 
                     class="card-img-top" 
                     style="height:200px; object-fit:cover;">

                <div class="card-body">

                    <h5 class="card-title text-success text-center fs-3 fw-bolder">
                        <?php echo $row['title']; ?>
                    </h5>

                    <p class="fw-bold fs-5">
                        LKR <?php echo $row['price']; ?>
                    </p>

                    <p class="card-text">
                        <?php foreach($features as $f){ ?>
                            • <?php echo trim($f); ?><br>
                        <?php } ?>
                    </p>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>
    <p class="text-center mt-5">
        To include any of these transport services in your travel package,
        please make sure to request them during booking.
      </p>

    </div>



    <!--tour guides-->
    <div class="container mb-5 p-5 mt-5" style="background-color: #c7cc87;">

    <div class="travel-intro w-100 text-center my-3">
        <h1 class="fw-bolder fs-1 mt-3">Professional Tour Guides</h1>
        <p style="font-size: 15px" class="mb-5">
            Explore Sri Lanka with experienced and friendly local tour guides who will make your journey unforgettable.
        </p>
    </div>

    <div class="row g-4">

    <?php
    include "config.php";

    $sql = "SELECT * FROM tour_guides ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
    ?>

        <div class="col-md-4">

            <div class="card h-100 shadow">

                <img src="images/<?php echo $row['image']; ?>" 
                     class="card-img-top" 
                     style="height:200px; object-fit:cover;">

                <div class="card-body">

                    <h5 class="card-title text-success text-center fs-3 fw-bolder">
                        <?php echo $row['name']; ?>
                    </h5>

                    <p class="fw-bold fs-5 text-center my-2">
                        LKR <?php echo $row['price']; ?>/day
                    </p>

                    <p class="text-center mb-1">
                        <b>Experience:</b> <?php echo $row['experience']; ?>
                    </p>

                    <p class="text-center mb-3">
                        <b>Languages:</b> <?php echo $row['language']; ?>
                    </p>

                    <p class="card-text text-center">
                        <?php echo $row['description']; ?>
                    </p>

                    <a href="packages_page.php" class="btn btn-success w-100">
                        Book Guide
                    </a>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>
    <p class="text-center mt-5">Please note: Tour guide services are exclusively available with package bookings.</p>

</div>
 

     <!--page footer-->
    <?php include "footer.php"; ?>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
