<?php $page = "home"; ?>

<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GlobeTrek Adventures Homepage</title>
    <link rel="stylesheet" href="homepage.css" />
    <!--font awesome-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!--boostrap-->
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

     <!--navbar-->
    <?php include "navbar.php"; ?>

    <!--Hero Section-->
    <div class="hero-container">
      <div class="hero-image" role="image"></div>
      <div class="hero-text">
        <h1>Discover Sri Lanka's <br />Best Kept Secrets</h1>
        <br />
        <h3>
          GlobeTrek Adventures crafts unforgettable journeys. <br />
          From pristine beaches to ancient ruins, customize your perfect escape
          with our expert team.
        </h3>
      </div>
    </div>

    <!--cards (using boostrap 'cards' component)-->
    <div class="card-container p-5">
      <h1 class="text-center mt-5 mb-3 fw-bolder fs-1">
        All you need for a Perfect Journey
      </h1>
      <p class="text-center mb-5" style="font-size: 15px">
        Indulge in the journey while we handle every aspect from transport to
        exceptional stays.
      </p>

      <div class="row">
        <!--card no.1-->
        <div class="col-lg-3 col-sm-6 mb-5">
          <div
            class="card text-center border-0 shadow rounded-0 p-3 my-3 mx-auto h-100"
          >
            <div class="icon my-3">
              <i
                class="fa-solid fa-location-dot fa-lg"
                style="color: #14532d"
              ></i>
            </div>
            <div class="card-body">
              <a
                href="services_page.php"
                class="text-decoration-none text-dark"
              >
                <h4 class="card-title fw-bolder fs-2 mb-4">
                  Custom Travel Plans
                </h4></a
              >
              <p class="card-text">
                Custom travel experiences designed around what you love and what
                you spend.
              </p>
            </div>
          </div>
        </div>

        <!--card no.2-->
        <div class="col-lg-3 col-sm-6 mb-5">
          <div
            class="card text-center border-0 shadow rounded-3 p-3 my-3 mx-auto h-100"
          >
            <div class="icon my-3">
              <i class="fa-solid fa-bed fa-lg" style="color: #14532d"></i>
            </div>
            <div class="card-body">
              <a
                href="services_page.php"
                class="text-decoration-none text-dark"
              >
                <h4 class="card-title fw-bolder fs-2 mb-4">
                  Exclusive stays
                </h4></a
              >
              <p class="card-text">
                Handpicked stays, from charming boutique hotels to relaxing
                beach resorts.
              </p>
            </div>
          </div>
        </div>

        <!--card no.3-->
        <div class="col-lg-3 col-sm-6 mb-5">
          <div
            class="card text-center border-0 shadow rounded-0 p-3 my-3 mx-auto h-100"
          >
            <div class="icon my-3">
              <i class="fa-solid fa-car-side fa-lg" style="color: #14532d"></i>
            </div>
            <div class="card-body">
              <a
                href="services_page.php"
                class="text-decoration-none text-dark"
              >
                <h4 class="card-title fw-bolder fs-2 mb-4">
                  Secure Transport
                </h4></a
              >
              <p class="card-text">
                Premium airport transfers and private, comfortable transport
                throughout your journey.
              </p>
            </div>
          </div>
        </div>

        <!--card no.4-->
        <div class="col-lg-3 col-sm-6 mb-5">
          <div
            class="card text-center border-0 shadow rounded-0 p-3 my-3 mx-auto h-100"
          >
            <div class="icon my-3">
              <i class="fa-regular fa-compass fa-lg" style="color: #14532d"></i>
            </div>
            <div class="card-body">
              <a
                href="services_page.php"
                class="text-decoration-none text-dark"
              >
                <h4 class="card-title fw-bolder fs-2 mb-4">Expert Guides</h4></a
              >
              <p class="card-text fw-semibold">
                Expert local guides offering immersive cultural experiences.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--destination cards-->
    <div id="card-area" style="background-color: #dae6dd">
      <div class="wrapper">
        <div class="destination-intro">
          <h1 style="text-align: center; font-weight: bold">
            Popular Destinations
          </h1>
          <p style="font-size: 15px; text-align: center">
            Explore our most booked locations this season. Sri Lanka offers a
            diverse range of experiences packed into a beautiful island.
          </p>
        </div>
        <div class="box-area">
          <!--card 1-->
          <div class="box">
            <img alt="" src="images/sigiriya.jpg" />
            <div class="overlay">
              <h3 style="color: wheat">Sigiriya</h3>
              <p style="color: wheat">
                Sigiriya is a breathtaking ancient rock fortress in Sri Lanka
                and a UNESCO World Heritage Site. Rising dramatically above the
                landscape, it offers rich history, stunning frescoes, landscaped
                gardens, and panoramic views from the top, making it a
                must-visit destination for travellers.
              </p>
              <a href="packages_page.php">Book Now</a>
            </div>
          </div>

          <!--card 2-->
          <div class="box">
            <img alt="" src="images/ella.jpg" />
            <div class="overlay">
              <h3 style="color: wheat">Ella</h3>
              <p style="color: wheat">
                Ella is a scenic hill country destination in Sri Lanka, known
                for its cool climate, lush tea plantations, waterfalls, and
                stunning mountain views. Popular attractions like Nine Arches
                Bridge and Little Adam’s Peak make it a must visit spot for
                nature lovers and adventure seekers.
              </p>
              <a href="packages_page.php">Book Now</a>
            </div>
          </div>

          <!--card 3-->
          <div class="box">
            <img alt="" src="images/yala.jpg" />
            <div class="overlay">
              <h3 style="color: wheat">Yala</h3>
              <p style="color: wheat">
                Yala National Park is Sri Lanka’s most famous wildlife reserve,
                known for its high density of leopards and diverse ecosystems.
                It offers thrilling safari experiences with sightings of
                elephants, crocodiles, and exotic birds, making it a top
                destination for nature and wildlife enthusiasts.
              </p>
              <a href="packages_page.php">Book Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--booking cards-->
    <div class="book-container">
      <div class="book-intro w-100 text-center my-3">
        <h1 class="fw-bolder fs-1">Curated Tour Packages</h1>
        <p style="font-size: 15px">
          Discover expertly curated experiences, thoughtfully prepared by our
          local specialists and ready for you to book.
        </p>
      </div>

      <!--book card 1-->
      <div class="book-card h-100 my-3">
        <img class="book-img" src="images/beach (1).jpg" />
        <div class="book-content">
          <h3>Island Explorer</h3>
          <p>
            Discover Sri Lanka’s islands, coastal beauty, and hidden gems
            through unforgettable scenic journeys and adventures.
          </p>
        </div>
        <div class="row align-items-center text-center g-0">
          <div class="col-6">
            <h6>Starting from</h6>
            <h5 class="fw-bold">Rs. 10,000</h5>
          </div>
          <div class="col-6">
            <a
              href="packages_page.php"
              class="btn btn-success text-light fs-4 p-3 w-100 rounded-1"
              >Book Now</a
            >
          </div>
        </div>
      </div>

      <!--book card 2-->
      <div class="book-card h-100 my-3">
        <img class="book-img" src="images/lepeord.jpg" />
        <div class="book-content">
          <h3>Wildlife & Nature</h3>
          <p>
            Experience diverse wildlife, lush rainforests, and national parks
            showcasing Sri Lanka’s rich natural biodiversity and landscapes.
          </p>
        </div>
        <div class="row align-items-center text-center g-0">
          <div class="col-6">
            <h6>Starting from</h6>
            <h5 class="fw-bold">Rs. 17,000</h5>
          </div>
          <div class="col-6">
            <a
              href="packages_page.php"
              class="btn btn-success text-light fs-4 p-3 w-100 rounded-1"
              >Book Now</a
            >
          </div>
        </div>
      </div>

      <!--book card 3-->
      <div class="book-card h-100 my-3">
        <img class="book-img" src="images/ruwanwali seya.jpg" />
        <div class="book-content">
          <h3>Cultural Heritage</h3>
          <p>
            Explore ancient cities, sacred temples, and historic landmarks
            reflecting Sri Lanka’s deep cultural roots and traditions.
          </p>
        </div>
        <div class="row align-items-center text-center g-0">
          <div class="col-6">
            <h6>Starting from</h6>
            <h5 class="fw-bold">Rs. 10,000</h5>
          </div>
          <div class="col-6">
            <a
              href="packages_page.php"
              class="btn btn-success text-light fs-4 p-3 w-100 rounded-1"
              >Book Now</a
            >
          </div>
        </div>
      </div>

      <!--book card 4-->
      <div class="book-card h-100 my-3">
        <img class="book-img" src="images/tea.jpg" />
        <div class="book-content">
          <h3>Hill Country</h3>
          <p>
            Wander misty hills, green tea estates, and charming villages in Sri
            Lanka’s breathtaking central highlands.
          </p>
        </div>
        <div class="row align-items-center text-center g-0">
          <div class="col-6">
            <h6>Starting from</h6>
            <h5 class="fw-bold">Rs. 15,000</h5>
          </div>
          <div class="col-6">
            <a
              href="packages_page.php"
              class="btn btn-success text-light fs-4 p-3 w-100 rounded-1"
              >Book Now</a
            >
          </div>
        </div>
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
