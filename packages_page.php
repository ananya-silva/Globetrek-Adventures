<?php $page = "packages"; ?>

<?php session_start(); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GlobeTrek Adventures Packages</title>
    <link rel="stylesheet" href="reviews.css">
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
        <img src="images/packages_img.jpg" alt="" />
        <div class="hero-text">
          <h1>Your Perfect Sri Lankan Adventure Awaits</h1>
          <p>
            Choose from a range of thoughtfully designed packages made for 
            comfort, adventure, and unforgettable memories.
          </p>
        </div>
      </div>
    </div>



<!-- Search Bar -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="input-group shadow">
                
                <span class="input-group-text bg-success text-white">
                    <i class="bi bi-search"></i>
                </span>

                <input 
                    type="text" 
                    id="packageSearch" 
                    class="form-control"
                    placeholder="Search packages..."
                >

            </div>

        </div>
    </div>
</div>

<!-- No Results Message -->
      <div id="noResults" class="text-center mt-4" style="display:none;">
          <h4 class="text-danger">No packages found</h4>
          <p>Try searching with another keyword.</p>
      </div>



    <!--packages-->
    <div class="container mb-5 p-5 mt-5" style="background-color: #90d18e;">

    <div class="text-center my-3">
        <h1 class="fw-bolder fs-1 mt-3">Travel Packages</h1>
        <p class="mb-5">
            Explore our carefully designed packages for the best travel experience in Sri Lanka.
        </p>
    </div>

    <div class="row g-4">

    <?php
    include "config.php";

    $sql = "SELECT * FROM packages";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
    ?>

        <div class="col-md-4 package-card">

            <div class="card h-100 shadow">

                <img src="images/<?php echo $row['image']; ?>" 
                     class="card-img-top"
                     style="height:200px; object-fit:cover;">

                <div class="card-body text-center">

                    <h5 class="card-title fw-bold fs-4">
                        <?php echo $row['title']; ?>
                    </h5>

                    <p class="text-muted">
                        <?php echo $row['duration']; ?>
                    </p>

                    <p class="fw-bold fs-5">
                        LKR <?php echo $row['price']; ?>
                    </p>

                    <!--description as a list-->
                    <ul class="list-group list-group-flush text-start mb-3">

                        <?php 
                            $features = explode(",", $row['description']);

                            foreach($features as $f){ 
                        ?>

                            <li class="list-group-item">
                                • <?php echo trim($f); ?>
                            </li>

                        <?php } ?>

                    </ul>

                   <a href="book_package.php?id=<?php echo $row['id']; ?>" class="btn btn-success w-100">
                      Book Now
                  </a>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>



     <!--page footer-->
    <?php include "footer.php"; ?>


    <script>
    document.getElementById("packageSearch").addEventListener("keyup", function () {

    let searchValue = this.value.toLowerCase();

    let packages = document.querySelectorAll(".package-card");

    let visibleCount = 0;       //count how many packages are displayed after search ... default = 0

    packages.forEach(function(packageCard){  //loops through each package card

        let title = packageCard.querySelector(".card-title").innerText.toLowerCase();   //get package titles from cards

        if(title.includes(searchValue)){      //checks if the searched title = package title

            packageCard.style.display = "block";     //if matches, display the card
            visibleCount++;                          //adds 1 to the package counter

        } else {

            packageCard.style.display = "none";      //or hides the cards

        }

    });

    // Show or hide no results message
    let noResults = document.getElementById("noResults");

    if(visibleCount === 0){
        noResults.style.display = "block";
    } else {
        noResults.style.display = "none";
    }

});
</script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
