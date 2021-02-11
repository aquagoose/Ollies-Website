<?php
$check = include "checkauth.php"; // If there is no authentication, nothing will be displayed at all.
if (include "checkauth.php") { ?>
<div id="topbar">
    <div id="topbarleft">
        <span>Hi <b><?php echo $_SESSION["username"]; ?>! 👋</b></span>
    </div>
    <div id="topbarright">
        <a class="topbarlink" href="/controlpanel/index.php">Control Panel</a>
        <a class="topbarlink" href="/logout.php?redirect_to=<?php echo $_SERVER['REQUEST_URI']; ?>">Log out</a>
    </div>
</div>
<?php } ?>
