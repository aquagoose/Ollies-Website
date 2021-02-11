<?php include "../redirect.php"; ?>

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title>Ollie's Website</title>
        <link rel="stylesheet" type="text/css" href="/Styles/main.css">
        <link rel="shortcut icon" href="/Resources/Images/snowflake.png" type="image/x-icon" />
    </head>
    <body>
        <?php include "../topbar.php";
        include "../header.php"; ?>
        <div id="wrapper">
            <?php
            $conn = include("../database.php");
            $result = $conn -> query("SELECT * FROM `pages`"); // Attempts to get all the pages listed in the DB.
            if ($result -> num_rows > 0) {
                echo "<table><tr><th>ID</th><th>Title</th><th>Unique Title</th><th>Actions</th></tr>"; // Creates a table of pages.
                while ($row = $result -> fetch_assoc()) {
                    echo "<tr><td>" . $row['ID'] . "</td><td><a href='/". $row['unique-title'] ."'>" . $row['page-title'] . "</a></td><td>" . $row['unique-title'] . "</td><td><a href='./editor.php?p=" . $row['ID'] . "'><img src='/Resources/Images/edit-icon.png' width='16' height='16'/></a><a href='./editor.php'><img src='/Resources/Images/remove-icon.png' width='16' height='16'/></a></td></tr>";
                }
                echo "</table>";
            }
            ?>
        </div>
        <?php include "../footer.php"; ?>
    </body>
</html>