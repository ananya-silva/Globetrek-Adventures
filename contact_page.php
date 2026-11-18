<?php $page = "contact"; ?>

<?php
include "config.php";
session_start();

$success = "";
$error = "";

if (isset($_POST['send'])) {

    // Get user ID safely
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Get form data securely
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['contact']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Validation
    if (empty($name) || empty($email) || empty($number) || empty($message)) {
        $error = "Please fill all required fields!";
    } else {

        // Build query depending on login status
        if ($user_id === null) {
           //guest user
            $sql = "INSERT INTO messages (user_id, name, email, number, message)
                    VALUES (NULL, '$name', '$email', '$number', '$message')";

        } else {
            //logged in user
            $sql = "INSERT INTO messages (user_id, name, email, number, message)
                    VALUES ($user_id, '$name', '$email', '$number', '$message')";
        }

        // Execute query
        $result = mysqli_query($conn, $sql);

        if ($result) {
              echo "<script>alert('Message sent successfully!');</script>";      //alert message (js)
        } else {
            $error = "Database error: " . mysqli_error($conn);
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GlobeTrek Adventures Contact</title>
    <link rel="stylesheet" href="contact.css" />
    <link rel="stylesheet" href="reviews.css" />
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
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    />
  </head>
  <!--contact form styles-->
  <style>
    body {
      background-color: lightgray;
      color: black;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .contact-container {
      border-radius: 10px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
      margin: 60px auto;
      margin-bottom: 60px;
      padding: 30px;
      max-width: 900px;
    }

    .form-control {
      border: 1px solid #ced4da;
      padding: 12px 15px;
      margin-bottom: 25px;
      transition: all 0.3s;
    }

    .form-control:focus {
      border-color: #000;
      box-shadow: 0 0 0 0.25rem rgba(0, 0, 0, 0.25);
    }

    .btn-submit {
      background-color: #9dde97;
      font-weight: 600;
      transition: all 0.3s;
    }

    .btn-submit:hover {
      background-color: #79cb66;
      color: #333;
      transform: translateY(-2px);
    }

    .contact-info {
      background-color: lightgreen;
      color: black;
    }

    .contact-info h3 {
      position: relative;
    }

    .contact-info h3:after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 50px;
      height: 2px;
      background: #fff;
    }

    .social-icons a {
      display: inline-block;
      width: 40px;
      height: 40px;
      background-color: #000000;
      color: #ffffff;
      border-radius: 50%;
      text-align: center;
      line-height: 40px;
      margin-right: 10px;
      transition: all 0.3s;
    }

    .social-icons a:hover {
      background-color: #ffffff;
      color: #000000;
      transform: translateY(-3px);
    }

    @media (max-width: 991px) {
      .contact-info {
        margin-top: 30px;
      }
    }

    @media (max-width: 450px) {
      .social-icons a {
        margin-right: 5px;
      }
    }
  </style>
  <body>
    <!--navbar-->
    <?php include "navbar.php"; ?>

    <!--hero image-->
    <div class="hero-container">
      <div class="hero-image">
        <img src="images/contact_img.jpg" alt="" />
        <div class="hero-text">
          <h1>Get in Touch With Us</h1>
          <p>
            Whether it’s a dream getaway or a quick escape, we’re here to make
            it happen.
          </p>
        </div>
      </div>
    </div>

    <!--contact page-->
    <div class="container">
      <div class="contact-container bg-white">
        <h1 class="contact-header text-center text-dark pb-2 fw-bolder">
          Let's Plan Your Journey
        </h1>
        <p class="text-center mb-5 fs-5">
          Reach out to us and we’ll get back to you
        </p>
        <div class="row">
          <div class="col-lg-8">
            <?php if($success != ""){ ?>
               <div class="alert alert-success text-center">
                   <?php echo $success; ?>
               </div>
           <?php } ?>

           <?php if($error != ""){ ?>
               <div class="alert alert-danger text-center">
                   <?php echo $error; ?>
               </div>
           <?php } ?>
           <div id="errorBox" class="alert alert-danger d-none"></div>
            <form action="" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input
                      type="text"
                      name="name"
                      class="form-control"
                      placeholder="Your Name"
                      id=""
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input
                      type="email"
                      name="email"
                      class="form-control"
                      required
                      placeholder="Your Email"
                      required
                    />
                  </div>
                </div>
              </div>

              <div class="form-group">
                <input
                  type="tel"
                  name="contact"
                  placeholder="Contact Number"
                  class="form-control"
                  required
                  id=""
                />
              </div>
              <div class="form-group">
                <textarea
                  name="message"
                  class="form-control"
                  placeholder="Your Message"
                  rows="6"
                  id=""
                ></textarea>
              </div>
              <button
                type="submit"
                name="send"
                class="btn w-100 btn-submit py-2 text-dark border-0"
              >
                Send Message
              </button>
            </form>
          </div>
          <div class="col-lg-4">
            <div class="contact-info rounded p-4">
              <h3 class="mb-3 pb-2">Contact Info</h3>
              <div class="contact-info-item d-flex mb-2">
                <div class="contact-info-icon text-dark me-3 fs-5">
                  <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                  <h5>Location</h5>
                  <p>Negombo, Sri Lanka</p>
                </div>
              </div>
              <div class="contact-info-item d-flex mb-2">
                <div class="contact-info-icon text-dark me-3 fs-5">
                  <i class="fas fa-phone"></i>
                </div>
                <div>
                  <h5>Phone</h5>
                  <p>+94 71 234 56789</p>
                </div>
              </div>
              <div class="contact-info-item d-flex mb-2">
                <div class="contact-info-icon text-dark me-3 fs-5">
                  <i class="fas fa-envelope"></i>
                </div>
                <div>
                  <h5>Email</h5>
                  <p>globetrek@gmail.com</p>
                </div>
              </div>
              <div class="social-icons mt-4">
                <a href="https://facebook.com" target="_blank"
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a href="https://tiktok.com" target="_blank"
                  ><i class="fab fa-tiktok"></i
                ></a>
                <a href="https://youtube.com" target="_blank"
                  ><i class="fab fa-youtube"></i
                ></a>
                <a href="https://instagram.com" target="_blank"
                  ><i class="fab fa-instagram" target="_blank"></i
                ></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

     <!--page footer-->
    <?php include "footer.php"; ?>
    

    <script src="script.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
