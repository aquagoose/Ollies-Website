<!--    Having a sneaky look at the source code are we? 🤔
        Nothing to see here except awful AWFUL website design.
        Move along now, nothing interesting here.

        Also, one thing to note, I don't write like the mess
        like you see below. I try to keep things neat. PHP? Well,
        that, not so much. If you take a look at my GitHub page
        (https://github.com/ohtrobinson/Ollies-Website) you will
        see the underlying code for the site is a lot neater than
        this. Thanks, PHP :)                                        -->

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title>Ollie's Website</title>
        <link rel="stylesheet" type="text/css" href="Styles/main.css">
    </head>
    <body>
        <?php include "topbar.php"; ?>
        <div id="wrapper">
            <?php
            include "header.php";
            $conn = include "database.php";
            $pageID = $_GET['p']; // Get the unique page identifier.
            $query = "SELECT * FROM `pages` WHERE `unique-title` = $pageID";
            if (!$pageID) $query = "SELECT * FROM `pages` WHERE `home-page` = 1"; // If there is no ID, go to the homepage.
            $result = $conn -> query($query);
            if ($result -> num_rows == 1) {
                $row = $result -> fetch_assoc(); // Fetch the first available row.
                echo "<h1 class='bigheader'>".$row['page-title']."</h1>\n".$row['body']; // The page title is displayed as a header. Then display the body.
            }
            else if ($result -> num_rows > 1) { // There shouldn't be more than one homepage..
                echo "<h1 class='bigheader'>What the..</h1><p>There appear to be two homepages. What.<br />Anyway that's a problem, there's only supposed to be one homepage......</p>";
            }
            else { // If the user enters some stinky page that doesn't exist, this gets displayed.
                echo "<h1 class='bigheader'>Hmm...</h1><p>You sure that page exists? I can't find it..</p>";
            }
            ?>
        </div>
    </body>
</html>