<?php
include "../redirect.php";
$pageID = "";
$html = "";
$pageTitle = "";
$uniqueTitle = "";
$headerTitle = "Editor - Ollie's Website";
$success = 0;

if (isset($_GET['p'])) { // If no page ID is set, don't bother with anything below.
    $pageID = $_GET['p'];
    $conn = include "../database.php";

    $save = $_GET['save']; // Checks to see if the user wants to save or not.
    if (isset($save) && $save == "true") {
        $setHtml = addslashes(urldecode($_GET['html'])); // Adds slashes & decodes the URL to readable HTML format.
        $result = $conn -> query("UPDATE `pages` SET `unique-title`='". $_GET['utitle'] ."', `page-title`='". addslashes($_GET['ptitle']) ."', `body`='$setHtml' WHERE `pages`.`ID` = $pageID"); // Insert query into the database.
        if ($result) { // If there is success, set the success flag to 1.
            $success = 1;
        }
    }
    else {
        $result = $conn->query("SELECT * FROM `pages` WHERE `ID`=$pageID"); // This is only run if save is not true, as the page reloads twice, saves load on the database.
        if ($result->num_rows == 1) { // There shouldn't be more than one of the page.
            $row = $result->fetch_assoc();
            $html = $row['body']; // Get the HTML data from the 'body' section of the db. This will be interpreted by javascript later.
            $pageTitle = $row['page-title'];
            $uniqueTitle = $row['unique-title'];
            $headerTitle = "Editor - $pageTitle - Ollie's Website";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title><?php echo $headerTitle ?></title>
        <link rel="stylesheet" type="text/css" href="/new-website/Styles/main.css">
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script> <!-- Scripts! SCRIPTS!  S C R I P T S ! -->
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script>
        <script src="../Scripts/EditorParser.js"></script> <!-- Including one by yours truly -->
    </head>
    <body>
        <?php include "../topbar.php";
        include "../header.php"; ?>
        <div id="wrapper">
            <div id="text">
                <input id="pagetitle" type="text" placeholder="Page Title" value="<?php echo $pageTitle; ?>">
                <input id="uniqueid" type="text" placeholder="Unique Title" value="<?php echo $uniqueTitle; ?>">
                <input type="button" class="important" value="Save" onclick="saveContent()">
                <input type="button" value="Preview" onclick="preview()">
                <div id="editorjs"></div>
                <script>
                    let html = `<?php echo $html; ?>`;
                    let editor;

                    window.onload = async function() {
                        const success = "<?php echo $success; ?>";
                        if (success == "1") {
                            window.location.href = window.location.href.split("?")[0] + "?p=<?php echo $pageID; ?>";
                            alert("Saved successfully!");
                        }

                        editor = new EditorJS({
                            holder: 'editorjs',
                            tools: {
                                header: Header,
                                linkTool: LinkTool,
                            },
                            data: (html !== "") ? await ParseHtmlToEditorFormat(html) : {},
                        });
                    }

                    async function saveContent() {
                        const html = await ParseEditorToHtml(editor);
                        const pageTitle = document.getElementById("pagetitle").value;
                        const uniqueTitle = document.getElementById("uniqueid").value;

                        if (pageTitle == "" || uniqueTitle == "" || html == "") {
                            alert("Content fields cannot be blank.");
                            return;
                        }
                        if (/\s/.test(uniqueTitle)) {
                            alert("Unique title field cannot contain spaces.");
                            return;
                        }

                        let url = window.location.href;
                        url += `&save=true&ptitle=${pageTitle}&utitle=${uniqueTitle}&html=${encodeURIComponent(html)}`;
                        window.location.href = url;
                    }

                    async function preview() {
                        const html = await ParseEditorToHtml(editor);
                        const pageTitle = document.getElementById("pagetitle").value;
                        document.title = `Editor - ${pageTitle} - Ollie's Website`;
                        window.open(`preview.php?ptitle=${pageTitle}&html=${encodeURIComponent(html)}`, 'PreviewWindow').focus();
                    }
                </script>
            </div>
        </div>
        <?php include "../footer.php"; ?>
    </body>
</html>