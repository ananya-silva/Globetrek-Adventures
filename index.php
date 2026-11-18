<!--set the active staus for login or register form-->

<?php

session_start();          //to access the session data stored

$error = [            //error array to store login/register form error messages
    'login' => $_SESSION['login_error'] ?? '',        // ??'' null coalescing - values exist then use it 
    'register' => $_SESSION['register_error'] ?? ''   // otherwise use an empty string
];

$activeForm = $_SESSION['active_form'] ?? 'login';   //to check which form is active , login or register

session_unset();                   //to remove all exsting sessions

function showError($error) {                              //to display error msg on the form
    return !empty($error) ? "<p class='error_message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm) {          //checks what form should be active
    return $formName === $activeForm ? 'active' : '';    //form name matches then return active, if not return an empty string
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    
    <!--Login Form-->
    <div class="container">                      <!--Main wrapper-->
        <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form">   <!--Login wrapper-->
            <form action="login_register.php" method="post">         <!--to get data from the login form to server-->
                <h2>Login</h2>
                <?= showError($error['login']); ?>   <!--if there's error an error msg will display -->
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account? <a href="#" onclick="showForm('register-form')">Register</a></p>  <!--onclick -> to display the register form-->
            </form>
        </div>

        <!--Register Form-->
        <div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-form">   <!--Register wrapper-->
            <form action="login_register.php" method="post">          <!--to get data from the register form to server-->
                <h2>Register</h2>
                <?= showError($error['register']); ?>    <!--if there's an error msg will display -->
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" id="registerEmail" name="email" placeholder="Email" required>
                <input type="password" id="registerPassword" name="password" placeholder="Password" required>
                <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm Password" required>
                
                <button type="submit" name="register">Register</button>
                <p>Already have an account? <a href="#" onclick="showForm('login-form')">Login</a></p>   <!--onclick -> to display the login form-->
            </form>
        </div>

    </div>

    <script src="script.js"></script>
</body>
</html>