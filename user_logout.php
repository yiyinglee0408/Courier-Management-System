<?php
session_start();

unset($_SESSION["userID"]);
session_destroy();
$url = "login.php";

header("Location:$url");

?>