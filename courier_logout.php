<?php
session_start();

unset($_SESSION["courierID"]);
session_destroy();
$url = "courier_login.php";

header("Location:$url");

?>