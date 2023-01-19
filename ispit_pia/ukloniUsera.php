<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("db_operacije.php");
$operacijeBaze = new OperacijeBaze();
if (isset($_SESSION["auth"])) {
    $user = $operacijeBaze->pronadjiEmail($_SESSION["auth"])->fetch_assoc();
    if ($user["uloga"] != 2) {
        header("refresh:0;url=index.php");
    }
}

$id = $_POST["id"];

$operacijeBaze->ukloniUsera($id);
?>