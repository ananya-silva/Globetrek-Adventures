<!--logic to receive the data from login and register forms-->

<!--condition for handle the registration process-->

<?php

session_start();                   //to start a php session
require_once 'config.php';         //configuration for connecting to the MySQL database

if (isset($_POST['register'])) {           //isset -> checks the existence of data from the register button through $_POST

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password_plain = $_POST['password'];             //the password user enters
    $confirm_password = $_POST['confirm_password'];   //the same password to confirm

    //checking if the two passwords match
    if ($password_plain !== $confirm_password) {
        $_SESSION['register_error'] = "Passwords do not match!";
        $_SESSION['active_form'] = "register";
        header("Location: index.php");
        exit();
    }

    //hashing the password after the validation
    $password = password_hash($password_plain, PASSWORD_DEFAULT);
    $role = "customer";

    // check if the entered email exists in db
    $checkEmail = $conn->query("SELECT email FROM users WHERE email ='$email'");

    if ($checkEmail->num_rows > 0) {                                        //if the number row is greater than 0 = email is registered already
        $_SESSION['register_error'] = "Email is already registered!";       //shows the error msg if the email is already registered
        $_SESSION['active_form'] = "register";                              //register form keeps active after errors
    } else {
        $conn->query("INSERT INTO users (name, email, password, role) 
                      VALUES ('$name', '$email', '$password', '$role')");
    }

    header("Location: index.php");         //after register form is done user will redirect to login form
    exit();
}

//login process

if (isset($_POST['login'])) {        //checks if the login button has clicked 

    $email = $_POST['email'];        //collect the values user enetered
    $password = $_POST['password'];

    //checking admin_staff table 
    $result = $conn->query("SELECT * FROM admin_staff WHERE email = '$email'");

    if($result && $result->num_rows > 0){      //checking if the entered email exist in db
        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){     //comapares the password user entered with the hashed password in db

            $_SESSION['name'] = $user['name'];      //stores logged in user details in session, keep user logged in across pages
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == 'admin'){             //checks whether the user is a admin
                header("Location: admin_index.php");  //direct to admin dashboard
                exit();
            }

            if($user['role'] == 'staff'){            //else checks whether the user is a admin
                header("Location: staff_index.php"); ////direct to staff dashboard
                exit();
            }
        }
    }

    //checking from users table (from customers)
    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");

    if($result && $result->num_rows > 0){
        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){   //comapares the password user entered with the hashed password in db
            $_SESSION['user_id'] = $user['id'];              //stores logged in user's id, keep user logged in across pages
            $_SESSION['role'] = 'customer';                  //store the user as a customer (default)

            header("Location: home_page.php");
            exit();
        }
    }

    //if there's error such as username or password mismatched
    $_SESSION['login_error'] = "Incorrect email or password";  //displaying error message
    header("Location: index.php");                             //and again redirect to login/register
    exit();
}