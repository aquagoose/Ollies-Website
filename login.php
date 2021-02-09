<?php
include "topbar.php";
$errorMessage = "";
$redirectTo = $_GET['redirect_to'];
if (include "checkauth.php") $errorMessage = "You are already logged in. Do you want to log in again?";
else if (!empty($redirectTo)) $errorMessage = "Please login to access that page.";
if (isset($_POST['username'])) {
    $conn = include "database.php";
    $username = $conn -> real_escape_string(stripslashes($_REQUEST['username']));
    $password = $conn -> real_escape_string(stripslashes($_REQUEST['password']));
    $result = $conn -> query("SELECT * FROM `users` WHERE username='$username' and password=PASSWORD('$password')");
    if ($result -> num_rows == 1) {
        session_start();
        $_SESSION["username"] = $_REQUEST['username'];
        if (empty($redirectTo)) header("Location: ./");
        else header("Location: ./$redirectTo");
    }
    else $errorMessage = "Incorrect username or password. Try again.";
}
?>
<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title>Ollie's Website</title>
        <link rel="stylesheet" type="text/css" href="Styles/main.css">
    </head>
    <body>
        <div id="wrapper">
            <?php include "header.php" ?>
            <form method="POST" action="">
                <input type="text" name="username" placeholder="Username" maxlength="20"><br />
                <input type="password" name="password" placeholder="Password" maxlength="20"> <br />
                <input type="submit" name="submit" value="Login">
            </form>
            <div id="errortext"><?php echo $errorMessage; ?></div>
        </div>
    </body>
</html>