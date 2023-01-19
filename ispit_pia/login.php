<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION["auth"])) {
    header("Location: index.php");
}

if (isset($_POST["email"]) && isset($_POST["sifra"])){
    require_once("db_operacije.php");
    $operacijeBaze = new OperacijeBaze();

    if ($operacijeBaze -> loginUsera($_POST["email"], $_POST["sifra"]) == TRUE) {
        $_SESSION["auth"] = $_POST["email"];
        include("head.php");
        include("logingotovo.php");
        include("footer.php");
    }
    else {
        include("head.php");
        include("google-login.php");
        include("loginprozor.php");
        echo "<script>alert('Nepravilan email ili sifra!')</script>";
        include("footer.php");
    }

}
else {
    include("head.php");
    include("google-login.php");
    include("loginprozor.php");
    include("footer.php");
}

?>