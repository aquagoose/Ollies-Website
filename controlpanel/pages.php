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
                echo "<table><tr><th>ID</th><th>Title</th><th>Unique Title</th><th>Actions</th></tr>"; // Creates a table of pages.
                while ($row = $result -> fetch_assoc()) {
                    echo "<tr><td>" . $row['ID'] . "</td><td>" . $row['page-title'] . "</td><td>" . $row['unique-title'] . "</td><td><a href='./editor.php?p=" . $row['ID'] . "'><img src='/new-website/Resources/Images/edit-icon.png' width='16' height='16'/></a><a href='./editor.php'><img src='/new-website/Resources/Images/remove-icon.png' width='16' height='16'/></a></td></tr>";
                }
                echo "</table>";
            }
            ?>
        </div>
        <?php include "../footer.php"; ?>
    </body>
</html>