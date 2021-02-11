<meta property="og:title" content="Ollie's Website">
<meta property="og:type" content="website">
<meta property="og:url" content="https://www.ollierobinson.co.uk">
<meta property="og:description" content="This is new.">
<meta name="theme-color" content="#FFA500">
<link rel="stylesheet" type="text/css" href="/Styles/header.css">
<div id="header">
    <div id="headerleft">
        <div id="himage"><img id="headerimage" src="/Resources/Images/snowflake.png" alt="Yes" /></div>
        <div id="htext"><a class="headermainlink" href="/"><div id="toptext">Ollie's Website</div><div id="bottomtext">This is new.</div></a></div>
    </div>
    <div id="headerright">
        <?php
        $conn = require("database.php"); // Connect to the database.
        $result = $conn -> query("SELECT ID, title, href FROM links"); // Query the links section from the database
        while ($row = $result -> fetch_assoc()) {
            $className = "menu"; // The default class name is "menu"
            if ($_SERVER['REQUEST_URI'] == $row['href']) {
                $className = "menu-highlighted"; // However if the current URI is equal to the href of the row, highlight the link (to make it look selected).
            }
            echo "<a class=\"$className\" href=\"".$row['href']."\">".$row['title']."</a>"; // Echo the link.
        }
        ?>
    </div> <!-- PHP generated stuff -->
</div>
