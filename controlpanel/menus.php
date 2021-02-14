<?php
include "../redirect.php";

$conn = include "../database.php";
$table = "";
$stmt = $conn -> prepare("SELECT * FROM `links` ORDER BY `link-order` ASC");
$stmt -> execute();
$result = $stmt -> get_result();
$table .= "<table><tr><th>Order</th><th>Title</th><th>Href</th></tr>";
while ($row = $result -> fetch_assoc()) {
    $table .= "<tr><td>". $row['link-order'] ."</td><td>". $row['title'] ."</td><td>". $row['href'] ."</td></tr>";
}
$table .= "</table>";
?>

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
        <div id="wrapper"> <!-- Wraps around the webpage, the "frame" of it. -->
            <div id="text"> <!-- Where text is displayed -->
                <?php echo $table ?>
            </div> <!-- End of text div -->
        </div> <!-- End of wrapper -->
        <?php include "../footer.php"; ?>
    </body>
</html>
