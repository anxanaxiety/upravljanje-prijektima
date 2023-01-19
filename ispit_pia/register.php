<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION["auth"])) {
    header("Location: index.php");
}

include("head.php");
include("google-login.php");

if (isset($_POST["email"], $_POST["sifra"], $_POST["ponovljena_sifra"], $_POST["ime"], $_POST["prezime"])) {
    
    require_once("db_operacije.php");
    $operacijeBaze = new OperacijeBaze();
    $res = $operacijeBaze -> pronadjiEmail($_POST["email"]);

    if ($res->num_rows != 0) {
        include("registerprozor.php");
        echo "<script>alert('Vec postoji user sa tim emailom!')</script>";
        include("footer.php");
        die();
    }

    if ($_POST["sifra"] != $_POST["ponovljena_sifra"]) {
        include("registerprozor.php");
        echo "<script>alert('Sifra i ponovljena sifra moraju biti iste!')</script>";
        include("footer.php");
        die();
    }

    include("registergotovo.php");
    $operacijeBaze -> napraviUsera($_POST["email"], $_POST["sifra"], $_POST["ime"], $_POST["prezime"]);

}

elseif (isset($_POST["email"])) {

    require_once("db_operacije.php");
    $operacijeBaze = new OperacijeBaze();
    $res = $operacijeBaze -> pronadjiEmail($_POST["email"]);

    if ($res->num_rows != 0) {
        include("registerprozor.php");
        echo "<script>alert('Vec postoji user sa tim emailom!')</script>";
        include("footer.php");
        die();
    }

    if (isset($_POST["uslovi"]) && $_POST["uslovi"] == TRUE) {
        include("registerkorak.php");
    }
    else {
        include("registerprozor.php");
        echo "<script>alert('Neophodno je prihvatiti uslove korišćenja i politiku privatnosti za pristup sajtu!')</script>";
    }

} else {
    include("registerprozor.php");
}

include("footer.php");
?>