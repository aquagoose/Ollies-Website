<?php
$imageID = $_GET['image'];
$image = "";
$photoFound = false;
if (isset($imageID)) {
    if ($handle = opendir("./images/photos/")) {
        while (false !== ($entry = readdir($handle))) {
            if (substr($entry, 0, 1) !== ".")
                if ($entry == $imageID) {
                    $image = "<img class='photo' src='images/photos/$entry' width='770'/>";
                    $photoFound = true;
                    break;
                }
        }
        closedir($handle);
        if (!$photoFound) header("Location: ./photo.php");
    }
}
else {
    header("Location: ./photo.php");
}
?>

<!--    Ollie's Website 2012 RECREATION
        PHP-ification here...           -->

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title>Ollie's Website!</title>
        <link rel="stylesheet" type="text/css" href="ollie.css">
    </head>
    <body>
        <div id="wrapper">
            <div id="header"><img src="images/header.jpg" alt="Ollie's Website!" /></div>
            <?php include "./menu.php"; ?>

            <div id="content">
                <a href="./photo.php"><h1>My Favourite Photos</h1></a>
                <div id="image">
                    <?php echo $image; ?>
                </div>
            </div>
        </div>
        <div id="footer">
            <div id="footerleft">&copy; Ollie Robinson</div>
            <div id="footerright">
                <img src="images/flickr.gif" />
                <img src="images/youtube.gif" />
                <img src="images/twitter.gif" />
                <img src="images/google+.gif" />
            </div>
        </div>
    </body>
</html>

