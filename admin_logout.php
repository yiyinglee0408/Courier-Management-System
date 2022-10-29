<?php
session_start();

unset($_SESSION["adminID"]);
session_destroy();
$url = "admin_login.php";

header("Location:$url");

?>