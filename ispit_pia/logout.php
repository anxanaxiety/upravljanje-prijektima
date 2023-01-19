<?php
session_start();

unset($_SESSION["auth"]);
header("refresh:0;url=index.php");

?>