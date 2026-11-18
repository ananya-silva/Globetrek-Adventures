<?php $page = "about"; ?>

<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GlobeTrek Adventures About</title>
    <link rel="stylesheet" href="about.css" />
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
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    />
  </head>

  <body>
    <!--navbar-->
    <?php include "navbar.php"; ?>

    <!--hero image-->
    <div class="hero-container">
      <div class="hero-image">
        <img src="images/about_img.jpg" alt="" />
        <div class="hero-text">
          <h1>Discover Who We Are</h1>
          <p>
            Learn more about our passion for travel and how we create
            unforgettable journeys for every traveler.
          </p>
        </div>
      </div>
    </div>

    <!--about us section-->
    <div class="about-container">
      <div class="about-us-container">
        <h1 class="about-header text-center fw-bolder">About Us</h1>
        <p class="text-center fs-5">
          GlobeTrek Adventures was born from a simple idea to make travel
          easier, more meaningful, and accessible to everyone. Located in the
          heart of Negombo, our journey began with a passion for showcasing the
          beauty, culture, and diversity of Sri Lanka to the world. We saw how
          planning a trip could often feel overwhelming, with scattered
          information, complicated bookings, and limited personalization. That’s
          when we decided to create a platform where travelers can explore
          destinations, customize their journeys, and book everything in one
          place with ease. From relaxing beach escapes to thrilling wildlife
          adventures and cultural experiences, our goal is to connect travelers
          with unforgettable moments. Behind every trip we plan is a dedicated
          team working closely with hotels, transport providers, and local
          guides to ensure every journey is smooth and memorable. Today,
          GlobeTrek Adventures continues to grow as a trusted travel partner,
          helping people turn their travel dreams into reality one journey at a
          time.
        </p>
      </div>
    </div>

    <!--mission-->
    <div class="mission-container">
      <div class="mission-text-container">
        <h1 class="mission-header text-center fw-bolder">Mission</h1>
        <p class="text-center fs-5">
          To provide seamless, personalized, and memorable travel experiences by
          combining local expertise, reliable services, and user-friendly
          technology.
        </p>
      </div>
    </div>

    <!--vision-->
    <div class="vision-container">
      <div class="vision-text-container">
        <h1 class="vision-header text-center fw-bolder">Vision</h1>
        <p class="text-center fs-5">
          To provide seamless, personalized, and memorable travel experiences by
          combining local expertise, reliable services, and user-friendly
          technology.
        </p>
      </div>
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
