<?php $page = "reviews"; ?>

<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GlobeTrek Adventures Reviews</title>
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
        <img src="images/review_img.jpg" alt="" />
        <div class="hero-text">
          <h1>Experiences That Speak</h1>
          <p>Real experiences from people who explored Sri Lanka with us</p>
        </div>
      </div>
    </div>

    <!--review cards-->
    <div class="card-container p-5">
      <h1 class="text-center mt-1 mb-3 fw-bolder fs-1">
        What Our Travelers Say...
      </h1>
      <p class="text-center mb-5" style="font-size: 15px">
        Hear from travelers who explored Sri Lanka with us and created
        unforgettable memories.
      </p>

      <div class="row">
        <!--review card no.1-->
        <div class="col-lg-3 col-sm-6 mb-5">
          <div
            class="card text-center border-0 shadow rounded-0 p-3 my-3 mx-auto h-100"
            style="background-color: rgb(64, 129, 74)"
          >
            <div class="icon my-3">
              <img
                class="rounded-circle w-25"
                src="images/review1.jpg"
                alt=""
              />
            </div>
            <div class="card-body">
              <h4 class="card-title fw-bolder fs-2 mb-4 text-light">
                Daniel Carter
              </h4>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <p class="card-text mt-4 text-light fs-5">
                "Absolutely loved it! Well organized and super friendly guides."
              </p>
              <hr class="text-light" />
              <p class="text-light">United Kingdom</p>
            </div>
          </div>
        </div>

        <!--review card no.2-->
        <div class="col-lg-3 col-sm-6 mb-5">
          <div
            class="card text-center border-0 shadow rounded-3 p-3 my-3 mx-auto h-100"
            style="background-color: rgb(64, 129, 74)"
          >
            <div class="icon my-3">
              <img
                class="rounded-circle w-25"
                src="images/review2.jpg"
                alt=""
              />
            </div>
            <div class="card-body">
              <h4 class="card-title fw-bolder fs-2 mb-4 text-light">
                Liam Fernando
              </h4>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <p class="card-text mt-4 text-light fs-5">
                "Great service and smooth travel plans. A few minor delays, but
                overall very enjoyable."
              </p>
              <hr class="text-light" />
              <p class="text-light">Sri Lanka</p>
            </div>
          </div>
        </div>

        <!--review card no.3-->
        <div class="col-lg-3 col-sm-6 mb-5">
          <div
            class="card text-center border-0 shadow rounded-0 p-3 my-3 mx-auto h-100"
            style="background-color: rgb(64, 129, 74)"
          >
            <div class="icon my-3">
              <img
                class="rounded-circle w-25"
                src="images/review3.jpg"
                alt=""
              />
            </div>
            <div class="card-body">
              <h4 class="card-title fw-bolder fs-2 mb-4 text-light">
                Sofia Rossi
              </h4>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <p class="card-text mt-4 text-light fs-5">
                "Amazing destinations and comfortable stays. Highly recommend
                this tour company."
              </p>
              <hr class="text-light" />
              <p class="text-light">Italy</p>
            </div>
          </div>
        </div>

        <!--review card no.4-->
        <div class="col-lg-3 col-sm-6 mb-5">
          <div
            class="card text-center border-0 shadow rounded-0 p-3 my-3 mx-auto h-100"
            style="background-color: rgb(64, 129, 74)"
          >
            <div class="icon my-3">
              <img
                class="rounded-circle w-25"
                src="images/review4.jpg"
                alt=""
              />
            </div>
            <div class="card-body">
              <h4 class="card-title fw-bolder fs-2 mb-4 text-light">
                Ethan Müller
              </h4>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <p class="card-text mt-4 text-light fs-5">
                "Beautiful locations and helpful staff. Would definitely book
                again for my next trip."
              </p>
              <hr class="text-light" />
              <p class="text-light">German</p>
            </div>
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
