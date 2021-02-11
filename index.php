<!--    Having a sneaky look at the source code are we? 🤔
        Nothing to see here except awful AWFUL website design.
        Move along now, nothing interesting here.

        Also, one thing to note, I don't write like the mess
        like you see below. I try to keep things neat. PHP? Well,
        that, not so much. If you take a look at my GitHub page
        (https://github.com/ohtrobinson/Ollies-Website) you will
        see the underlying code for the site is a lot neater than
        this. Thanks, PHP :)                                        -->

<?php
$content = "";
$pageTitle = "";
$conn = include "database.php";
$pageID = $_GET['p']; // Get the unique page identifier.
$query = "SELECT * FROM `pages` WHERE `unique-title` = $pageID";
if (!$pageID) $query = "SELECT * FROM `pages` WHERE `home-page` = 1"; // If there is no ID, go to the homepage.
$result = $conn -> query($query);
if ($result -> num_rows == 1) {
    $row = $result -> fetch_assoc(); // Fetch the first available row.
    // This sets the title of the page in the head. If it's a homepage, just display the title.
    // If not a homepage, append " - Ollie's Website" to the end of the title.
    $pageTitle = $row['page-title'] . ($row['home-page'] == 0 ? " - Ollie's Website" : "");
    $content = "<h1 class='bigheader'>".$row['page-title']."</h1>\n".$row['body']; // The page title is displayed as a header. Then display the body.
}
else if ($result -> num_rows > 1) { // There shouldn't be more than one homepage..
    $content = "<h1 class='bigheader'>What the..</h1><p>There appear to be two homepages. What.<br />Anyway that's a problem, there's only supposed to be one homepage......</p>";
}
else { // If the user enters some stinky page that doesn't exist, this gets displayed.
    $content = "<h1 class='bigheader'>Hmm...</h1><p>You sure that page exists? I can't find it..</p>";
}
?>

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title><?php echo $pageTitle; ?></title>
        <link rel="stylesheet" type="text/css" href="/Styles/main.css">
        <link rel="shortcut icon" href="/Resources/Images/snowflake.png" type="image/x-icon" />
    </head>
    <body>
        <?php include "topbar.php";
        include "header.php"; ?>
        <div id="wrapper"> <!-- Wraps around the webpage, the "frame" of it. -->
            <div id="text"> <!-- Where text is displayed -->
                <?php echo $content; ?> <!-- This might look like trash. Trust me. IT'S PHP's FAULT!!! -->
            </div> <!-- End of text div -->
        </div> <!-- End of wrapper -->
        <?php include "footer.php"; ?>
    </body>
</html>