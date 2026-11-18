<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
</head>
<body>
        <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand d-lg-none" href="#">
          <img src="Group 2.png" alt="" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a
                class="nav-link <?php if($page == 'home') echo 'active'; ?>"
                aria-current="page"
                href="home_page.php"
                >Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($page == 'services') echo 'active'; ?>" href="services_page.php">Services </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($page == 'packages') echo 'active'; ?>" href="packages_page.php">Packages</a>
            </li>
            <a class="navbar-brand d-none d-lg-block" href="home_page.php">
              <img src="Group 2.png" alt="" />
            </a>
            <li class="nav-item">
              <a class="nav-link <?php if($page == 'contact') echo 'active'; ?>" href="contact_page.php">Contact </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($page == 'about') echo 'active'; ?>" href="about_page.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($page == 'reviews') echo 'active'; ?>" href="reviews_page.php">Reviews</a>
            </li>
          </ul>
          <div class="d-flex justify-content-center justify-content-lg-end mt-3 mt-lg-0">

            <?php if(isset($_SESSION['user_id'])) { ?>

    <div class="dropdown ms-lg-3">

        <a class="text-white fs-4 dropdown-toggle text-decoration-none"
           href="#"
           role="button"
           data-bs-toggle="dropdown">

            <i class="bi bi-person-circle"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-end">

            <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
            <li><a class="dropdown-item" href="bookings.php">My Bookings</a></li>
            <li><a class="dropdown-item" href="messages.php">My Messages</a></li>

            <li><hr class="dropdown-divider"></li>

            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>

        </ul>

    </div>

      <?php } else { ?>

          <a href="index.php" class="btn btn-outline-light fw-bold ms-lg-3">
              Login
          </a>

      <?php } ?>

        </div>
        </div>
      </div>
    </nav>
</body>
</html>