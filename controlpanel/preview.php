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
<?php include "../topbar.php"; ?>
<div id="wrapper"> <!-- Wraps around the webpage, the "frame" of it. -->
    <?php include "../header.php" ?>
    <div id="text"> <!-- Where text is displayed -->
        <?php
        $html = $_GET['html'];
        echo $html;
        ?>
    </div> <!-- End of text div -->
</div> <!-- End of wrapper -->
</body>
</html>
