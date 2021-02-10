<?php
include "../redirect.php";
$html = "";
$pageTitle = "";
$uniqueTitle = "";
if (isset($_GET['p'])) {
    $pageID = $_GET['p'];
    $conn = include "../database.php";
    $result = $conn -> query("SELECT * FROM `pages` WHERE `ID`=$pageID");
    if ($result -> num_rows == 1) {
        $row = $result -> fetch_assoc();
        $html = addslashes($row['body']);
        $pageTitle = $row['page-title'];
        $uniqueTitle = $row['unique-title'];
    }
}
?>

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title>Ollie's Website</title>
        <link rel="stylesheet" type="text/css" href="/new-website/Styles/main.css">
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script>
        <script src="../Scripts/EditorParser.js"></script>
    </head>
    <body>
        <?php include "../topbar.php"; ?>
        <div id="wrapper">
            <?php include "../header.php" ?>
            <div id="text">
                <input type="text" placeholder="Page Title" value="<?php echo $pageTitle; ?>">
                <input type="text" placeholder="Unique Title" value="<?php echo $uniqueTitle; ?>">
                <input type="button" class="important" value="Save" onclick="saveContent()">
                <input type="button" value="Preview" onclick="preview()">
                <div id="editorjs"></div>
                <script>
                    let html = "<?php echo $html; ?>";
                    let editor;

                    window.onload = async function() {
                        editor = new EditorJS({
                            holder: 'editorjs',
                            tools: {
                                header: Header,
                                linkTool: LinkTool,
                            },
                            data: (html !== "") ? await ParseHtmlToEditorFormat(html) : {},
                        });
                    }

                    function saveContent() {
                        ParseEditorToHtml(editor);
                    }

                    async function preview() {
                        const html = await ParseEditorToHtml(editor);
                        const pageTitle = "<?php echo $pageTitle; ?>";
                        window.open(`preview.php?ptitle=${pageTitle}&html=${html}`)
                    }
                </script>
            </div>
        </div>
        <?php include "../footer.php"; ?>
    </body>
</html>