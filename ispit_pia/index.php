<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once("db_operacije.php");
$operacijeBaze = new OperacijeBaze();
include("head.php");
if (isset($_SESSION["auth"])) {
    $korisnik = $operacijeBaze -> idUseraPoMail($_SESSION["auth"]) -> fetch_assoc();
    if ($korisnik["uloga"] == 2) {
        include("mininavbar.php");
        include("admin.php");
    } else {
        include("fullnavbar.php");
        include("tabela.php");
    }
}
else {
    include("navbar.php");
    include("nolog.php");
}
include("footer.php");
?>
