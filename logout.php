<?php
$redirectTo = $_GET['redirect_to'];
session_start();
if (session_destroy()) { // Tries to destroy the session.
    if (isset($redirectTo)) header("Location: $redirectTo"); // Similar to the login page, redirect the user or navigate back home.
    else header("Location ./");
}