<?php
$images = "";

if ($handle = opendir("./images/photos/")) {
    while (false !== ($entry = readdir($handle))) {
        if (substr($entry, 0, 1) !== ".")
            $images .= "<a href='view.php?image=$entry'><img class='photo' src='images/photos/$entry' width='150' height='100'/></a>";
    }
    closedir($handle);
}
?>

<!--    Ollie's Website 2012 RECREATION
        I just **HAD** to use some PHP... Sorry XD
        (If it's not obvious or you haven't looked at the github, I use PHP
        to fetch the photos here. It's to save the hassle of creating a separate
        page for every photo, that's the only reason. Since this is a low effort
        site, (just a recreation), there's no point creating a page for every picture
        if some PHP will just do it for me. Closer to the original? No. Convenient? Yes. -->

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title>Ollie's Website!</title>
        <link rel="stylesheet" type="text/css" href="ollie.css">
    </head>
    <body>
        <div id="wrapper">
            <div id="header"><img src="images/header.jpg" alt="Ollie's Website!" /></div>
            <div id="menu">
                <a href="./" class="menulink">home</a> -
                <a href="./" class="menulink">links</a> -
                <a href="./" class="menulink">electrical</a> -
                <a href="./" class="menulink">youtube</a> -
                <a href="./" class="menulink">school</a> -
                <a href="./photo.php" class="menulink">photos</a> -
                <a href="./windows8.php" class="menulink">windows 8</a> -
                <a href="./" class="menulink">twitter</a>
            </div>

            <div id="content">
                <h1>My Favourite Photos</h1>
                <p>
                    Hello and welcome to my favourite photos page! This is the page where all my favourite photos are.
                    Each photo is a link and if you click on one of my photos it will take you to another page with the
                    same photo but bigger. Please remember that these are all my photos. Here they are:
                </p>
                <div id="images">
                    <?php echo $images ?>
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
