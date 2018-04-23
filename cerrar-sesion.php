<?php

session_start();
unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_access_token']);
unset($_SESSION['loggedin']);
session_destroy();

header('Location: https://mashup-ytm.herokuapp.com/index.php');

?>
