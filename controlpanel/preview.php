<?php
include "../redirect.php";
$pageTitle = $_GET['ptitle'];
if (empty($pageTitle)) $pageTitle = "Page Title Goes Here";
$html = $_GET['html'];
$h1 = "<h1 class='bigheader'>$pageTitle</h1>";
$title = "[PREVIEW]$pageTitle - Ollie's Website";
?>

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="/Styles/main.css">
        <link rel="shortcut icon" href="/Resources/Images/snowflake.png" type="image/x-icon" />
    </head>
    <body>
        <?php include "../topbar.php";
        include "../header.php"; ?>
        <div id="wrapper"> <!-- Wraps around the webpage, the "frame" of it. -->
            <div id="text"> <!-- Where text is displayed -->
                <?php
                echo $h1;
                echo $html;
                ?>
            </div> <!-- End of text div -->
        </div> <!-- End of wrapper -->
        <?php include "../footer.php"; ?>
    </body>
</html>
