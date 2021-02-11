<?php
include "../redirect.php";

$table = "";
$conn = include("../database.php");
$success = 0;

$deleteID = $_GET['delete'];
if (isset($deleteID)) {
    $stmt = $conn->prepare("DELETE FROM `pages` WHERE `pages`.`ID`=?");
    $stmt->bind_param("i", $deleteID);
    $result = $stmt -> execute();
    if ($result) {
        $success = 1;
    }
    $stmt -> close();
}
else {
    $stmt = $conn->prepare("SELECT * FROM `pages`"); // Attempts to get all the pages listed in the DB.
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $table .= "<table><tr><th>ID</th><th>Title</th><th>Unique Title</th><th>Actions</th></tr>"; // Creates a table of pages.
        while ($row = $result->fetch_assoc()) {
            $table .= "<tr><td>" . $row['ID'] . "</td><td><a href='/" . $row['unique-title'] . "'>" . $row['page-title'] . "</a></td><td>" . $row['unique-title'] . "</td><td><a href='./editor.php?p=" . $row['ID'] . "'><img src='/Resources/Images/edit-icon.png' width='16' height='16'/></a><a onclick='DeletePage(`" . $row['page-title'] . "`, `" . $row['ID'] . "`)'><img src='/Resources/Images/remove-icon.png' width='16' height='16'/></a></td></tr>";
        }
        $table .= "</table>";
    }
    $stmt -> close();
}
$conn->close();

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
        <div id="wrapper">
            <?php echo $table; ?>

            <script type="text/javascript">
                window.onload = function() {
                    const success = "<?php echo $success; ?>";
                    if (success == "1") {
                        window.location.href = window.location.href.split("?")[0]; // Keeps the page ID or nothing would load.
                        alert("Page has successfully been deleted."); // Send an alert out so people know it went well.
                    }
                }

                function DeletePage(name, id) {
                    if (confirm(`Are you sure you want to delete ${name}?\nWARNING! THIS ACTION IS IRREVERSIBLE!!!`)) {
                        let url = window.location.href;
                        url += `?delete=${id}`;
                        window.location.href = url;
                    }
                }
            </script>
        </div>
        <?php include "../footer.php"; ?>
    </body>
</html>