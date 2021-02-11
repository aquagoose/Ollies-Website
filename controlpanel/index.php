<?php
include "../redirect.php";
?>

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title>Ollie's Website</title>
        <link rel="stylesheet" type="text/css" href="/new-website/Styles/main.css">
    </head>
    <body>
        <?php include "../topbar.php";
        include "../header.php"; ?>
        <div id="wrapper"> <!-- Wraps around the webpage, the "frame" of it. -->
            <div id="text"> <!-- Where text is displayed -->
                <a href="pages.php">Pages</a><br />
                <a href="editor.php">Editor</a><br />
            </div> <!-- End of text div -->
        </div> <!-- End of wrapper -->
        <?php include "../footer.php"; ?>
    </body>
</html>
