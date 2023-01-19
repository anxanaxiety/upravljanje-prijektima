<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (!isset($_SESSION["auth"])) {
    header("refresh:0;url=index.php");
}

$tema_id = $_GET["id"];

require_once("db_operacije.php");
$operacijeBaze = new OperacijeBaze();

$user = $operacijeBaze->idUseraPoMail($_SESSION["auth"]);

if ($user->num_rows > 0) {
    $us = $user->fetch_assoc();

    $operacijeBaze->izmeniTemuUsera($us["id"], $tema_id);
}

header("refresh:0;url=index.php");