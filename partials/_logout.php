<?php
session_start();
echo "Logging you out . please wait";
session_destroy();
header("location: /Harry iDisucuss forum website/index.php")


?>