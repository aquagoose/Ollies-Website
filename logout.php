<?php
$redirectTo = $_GET['redirect_to'];
session_start();
if (session_destroy()) {
    if (isset($redirectTo)) header("Location: $redirectTo");
    else header("Location ./");
}