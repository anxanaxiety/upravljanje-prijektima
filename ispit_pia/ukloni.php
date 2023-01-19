<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION["auth"])) {
    include_once("db_operacije.php");
    $operacijeBaze = new OperacijeBaze();

    $user = $operacijeBaze -> pronadjiEmail($_SESSION["auth"]) -> fetch_assoc();

    if ($user["uloga"] == 1) {
        $id = $_GET["id"];

        $rokId = $operacijeBaze -> ukloniProjekat($id);

        $operacijeBaze -> ukloniStavkeProjekta($id);
    }
}
header("refresh:0;url=index.php");
?>