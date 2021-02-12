<?php
include "../redirect.php";

$table = "";
$conn = include("../database.php");
$success = 0;
$error = "";

$deleteID = $_GET['delete'];
if (isset($deleteID)) {
    $stmt = $conn -> prepare("SELECT * FROM `pages` WHERE `pages`.`ID`=?");
    $stmt -> bind_param("i", $deleteID);
    $stmt -> execute();

    $result = $stmt -> get_result();
    if ($result -> num_rows == 1) {
        $row = $result -> fetch_assoc();
        if ($row['home-page'] == 1) {
            $error = "You are not allowed to delete the homepage.\nTo delete it, make a different page the homepage.";
        }
        else {
            $stmt = $conn->prepare("DELETE FROM `pages` WHERE `pages`.`ID`=?");
            $stmt->bind_param("i", $deleteID);
            $result = $stmt -> execute();
            if ($result) {
                $success = 1;
            }
        }
    }
    else {
        $error = "That page does not exist.";
    }
    $stmt -> close();
}
else {
    $stmt = $conn->prepare("SELECT * FROM `pages`"); // Attempts to get all the pages listed in the DB.
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $table .= "<table><tr><th>ID</th><th>Title</th><th>Unique Title</th><th>Status</th><th>Actions</th></tr>"; // Creates a table of pages.
        while ($row = $result->fetch_assoc()) {
            $table .= "<tr><td>" . $row['ID'] . "</td><td><a href='/" . $row['unique-title'] . "'>" . $row['page-title'] . "</a></td><td>" . $row['unique-title'] . "</td><td>". ($row['home-page'] == 1 ? "<img src='/Resources/Images/home-icon.png' width='16' height='16' title='This is set as the homepage.' alt='Homepage'/>" : "") ."</td><td><a class='actionitem' href='./editor.php?p=" . $row['ID'] . "'><img src='/Resources/Images/edit-icon.png' width='16' height='16' title='Edit page' alt='Edit page'/></a><a class='actionitem' style='cursor: pointer' onclick=\"DeletePage(`" . addslashes($row['page-title']) . "`, `" . $row['ID'] . "`)\"><img src='/Resources/Images/remove-icon.png' width='16' height='16' title='Remove page' alt='Remove page'/></a></td></tr>";
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
            <input type=button onclick="window.location='editor.php'" value="New Page">

            <script type="text/javascript">
                window.onload = function() {
                    document.getElementById("wrapper").style.minHeight = `calc(100vh - ${140 + document.getElementById("topbar").clientHeight}px`;
                    const success = `<?php echo $success; ?>`;
                    const error = `<?php echo $error; ?>`;
                    if (success == "1") {
                        window.location.href = window.location.href.split("?")[0]; // Keeps the page ID or nothing would load.
                        alert("Page has successfully been deleted."); // Send an alert out so people know it went well.
                    }
                    else if (error != "") {
                        window.location.href = window.location.href.split("?")[0];
                        alert(error);
                    }
                }

                function DeletePage(name, id) {
                    if (confirm(`Are you sure you want to delete "${name}"?\nWARNING! THIS ACTION IS IRREVERSIBLE!!!`)) {
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