<?php
$check = include "checkauth.php"; // If there is no authentication, nothing will be displayed at all.
if (include "checkauth.php") { ?>
<script type="text/javascript">window.onload = function(){document.getElementById("wrapper").style.minHeight = `calc(100vh - ${140 + document.getElementById("topbar").clientHeight}px`;}</script>
<div id="topbar">
    <div id="topbarleft">
        <span>Hi <b><?php echo $_SESSION["first-name"]; ?></b>! 👋</span>
    </div>
    <div id="topbarright">
        <?php
        $pageID = $_GET['p'];
        $query = "SELECT * FROM `pages` WHERE `unique-title`=?";
        if (!$pageID && $_SERVER['REQUEST_URI'] == '/') $query = "SELECT * FROM `pages` WHERE `home-page` = 1";
        $conn = include("database.php");
        $stmt = $conn -> prepare($query);
        $stmt -> bind_param("s", $pageID);
        $stmt -> execute();
        $result = $stmt -> get_result();
        if ($result -> num_rows == 1) {
            $row = $result -> fetch_assoc();
            echo "<a class='topbarlink' href='/controlpanel/editor.php?p=". $row['ID'] ."'>Edit Page</a>";
        }
        ?>
        <a class="topbarlink" href="/controlpanel/index.php">Control Panel</a>
        <a class="topbarlink" href="/logout.php?redirect_to=<?php echo $_SERVER['REQUEST_URI']; ?>">Log out</a>
    </div>
</div>
<?php } ?>
