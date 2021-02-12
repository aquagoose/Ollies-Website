<?php
include "topbar.php";
$errorMessage = ""; // Displays any error message that may occur.
$redirectTo = $_GET['redirect_to']; // Does the user want to redirect to a page?
if (include "checkauth.php") $errorMessage = "You are already logged in. Do you want to log in again?"; // Simple reminder to remind the user they're logged in already.
else if (!empty($redirectTo)) $errorMessage = "Please login to access that page.";
if (isset($_POST['username'])) { // Only runs if a username value exists.
    $conn = include "database.php";
    $username = $conn -> real_escape_string(stripslashes($_REQUEST['username']));
    $password = $conn -> real_escape_string(stripslashes($_REQUEST['password']));
    $stmt = $conn -> prepare("SELECT * FROM `users` WHERE username=? and password=PASSWORD(?)"); // Attempt to find the user.
    $stmt -> bind_param("ss", $username, $password);
    $stmt -> execute();
    $result = $stmt -> get_result();
    if ($result -> num_rows == 1) { // We're in!
        $row = $result -> fetch_assoc();
        session_start();
        $_SESSION["username"] = $_REQUEST['username']; // Create a session cookie with the stored username
        $_SESSION["first-name"] = $row['first-name'];
        $_SESSION["privledge-level"] = $row['privledge-level'];
        if (empty($redirectTo)) header("Location: /"); // Redirect to either the home page or the redirect location, whichever is set.
        else header("Location: $redirectTo");
    }
    else $errorMessage = "Incorrect username or password. Try again."; // Oops... Nah, not today friend.
    $stmt -> close();
    $conn -> close();
}
?>
<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title>Ollie's Website</title>
        <link rel="stylesheet" type="text/css" href="/Styles/main.css">
        <link rel="shortcut icon" href="/Resources/Images/snowflake.png" type="image/x-icon" />
    </head>
    <body>
        <?php include "header.php"; ?>
        <div id="wrapper">
            <form method="POST" action="">
                <input type="text" name="username" placeholder="Username" maxlength="20"><br />
                <input type="password" name="password" placeholder="Password" maxlength="20"> <br />
                <input type="submit" name="submit" value="Login">
            </form>
            <div id="errortext"><?php echo $errorMessage; ?></div>
        </div>
        <?php include "footer.php"; ?>
    </body>
</html>