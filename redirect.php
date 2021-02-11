<?php
if (!include "checkauth.php") header("Location: /login.php?redirect_to=" . $_SERVER["REQUEST_URI"]);