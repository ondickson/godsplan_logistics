<?php
session_start();
session_unset();
session_destroy();
header("Location: http://192.168.10.45/godsplan_logistics/");
exit();
?>
