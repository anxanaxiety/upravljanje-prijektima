<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION["auth"])) {
    $user = $operacijeBaze->pronadjiEmail($_SESSION["auth"])->fetch_assoc();
    if ($user["uloga"] != 1) {
        header("refresh:0;url=index.php");
    }
}

$id = $_POST["id"];
$email = $_POST["noviUser"];

require_once("db_operacije.php");
$operacijeBaze = new OperacijeBaze();

$user = $operacijeBaze->idUseraPoMail($email);

if ($user->num_rows > 0) {
    $us = $user->fetch_assoc();

    $operacijeBaze->izmeniUseraStavke($id, $us["id"]);

    header("Refresh:0; url=index.php");
} else {
    include("head.php");
    echo '
    <section class="bg-1 bez-navbar">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-8 col-lg-4 d-flex align-items-center justify-content-center my-5 flex-column">
                <img src="img/logoSrednji.webp" alt="" class="my-3">
                <div class="login-prozor p-5 w-100">
                    <h5 class="text-center naslov-prijava-registracija">Ne postoji user sa mailom ' . $email . '...</h5>
                    <p>ako ne radi preusmeravanje, <a href="index.php">kliknite ovde</a></p>
                </div>
            </div>
        </div>
    </div>
</section>';
    header("Refresh:3; url=index.php");
}
?>