<?php

session_start();
session_unset();
session_destroy();               //delete all session data from the server (session ended)
header("Location: index.php");   //after deleted user will redirect to the index.php page (login page)
exit();

?>