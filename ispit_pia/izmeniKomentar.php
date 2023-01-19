<?php

require_once("db_operacije.php");
$operacijeBaze = new OperacijeBaze();

if (!isset($_POST["id"], $_POST["komentar"], $_POST["id_stavke"])) {
    header("refresh:0;url=index.php");
}

$id = $_POST["id"];
$id_stavke = $_POST["id_stavke"];
$komentar = $_POST["komentar"];

if (isset($_SESSION["auth"])) {
    $user = $operacijeBaze->pronadjiEmail($_SESSION["auth"])->fetch_assoc();
    
    if ($user["uloga"] != 1) {
        $us = $operacijeBaze -> selectUseraStavke($id_stavke);
        if ($us == -1) {
            header("refresh:0;url=index.php");
        } elseif ($us != $_SESSION["auth"]) {
            header("refresh:0;url=index.php");
        }
    }
}

$operacijeBaze -> izmeniKomentar($id, $komentar);
header("refresh:0;url=index.php");

?>