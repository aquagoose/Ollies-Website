<?php
if (!include "checkauth.php") header("Location: /new-website/login.php?redirect_to=" . $_SERVER["REQUEST_URI"]);