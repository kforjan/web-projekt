<?php
setcookie("admin", "", time() - 3600, '/');
header("location: admin.php");
exit();