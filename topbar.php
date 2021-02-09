<?php
$check = include "checkauth.php";
if (include "checkauth.php") { ?>
<div id="topbar">
    <div id="topbarleft">
        <span>Hi <b><?php echo $_SESSION["username"]; ?>! 👋</b></span>
    </div>
    <div id="topbarright">
        <a class="topbarlink" href="./">Control Panel</a>
        <a class="topbarlink" href="./logout.php?redirect_to=<?php echo $_SERVER['REQUEST_URI']; ?>">Log out</a>
    </div>
</div>
<?php } ?>
