<?php
include "../redirect.php";
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
                <input type="text" placeholder="Page Title">
                <input type="text" placeholder="Unique Title">
                <input type="button" class="important" value="Save" onclick="saveContent()">
                <input type="button" value="Preview" onclick="preview()">
                <div id="editorjs"></div>
                <script>
                    const editor = new EditorJS({
                        holder: 'editorjs',
                        tools: {
                            header: Header,
                            linkTool: LinkTool,
                        },
                    });

                    function saveContent() {
                        ParseEditorToHtml(editor);
                    }

                    async function preview() {
                        const html = await ParseEditorToHtml(editor);
                        window.open(`preview.php?html=${html}`)
                    }
                </script>
            </div>
        </div>
    </body>
</html>