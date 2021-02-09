<!--    Having a sneaky look at the source code are we? 🤔
        Nothing to see here except awful AWFUL website design.
        Move along now, nothing interesting here.               -->

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title>Ollie's Website</title>
        <link rel="stylesheet" type="text/css" href="Styles/main.css">
    </head>
    <body>
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
            else if ($result -> num_rows > 1) {
                echo "<h1 class='bigheader'>What the..</h1><p>There appear to be two homepages. What.<br />Anyway that's a problem, there's only supposed to be one homepage......</p>";
            }
            else {
                echo "<h1 class='bigheader'>Hmm...</h1><p>You sure that page exists? I can't find it..</p>";
            }
            ?>
        </div>
    </body>
</html>