<?php include "../redirect.php"; ?>

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title>Ollie's Website</title>
        <link rel="stylesheet" type="text/css" href="/new-website/Styles/main.css">
    </head>
    <body>
        <?php include "../topbar.php"; ?>
        <div id="wrapper">
            <?php
            include "../header.php";
            $conn = include("../database.php");
            $result = $conn -> query("SELECT * FROM `pages`"); // Attempts to get all the pages listed in the DB.
            if ($result -> num_rows > 0) {
                echo "<table><tr><th>ID</th><th>Title</th><th>Unique Title</th></tr>"; // Creates a table of pages.
                while ($row = $result -> fetch_assoc()) {
                    echo "<tr><th>" . $row['ID'] . "</th><th>" . $row['page-title'] . "</th><th>" . $row['unique-title'] . "</th></tr>";
                }
                echo "</table>";
            }
            ?>
        </div>
    </body>
</html>