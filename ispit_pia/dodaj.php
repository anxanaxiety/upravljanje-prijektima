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
        $naslov_projekta = $_POST["naslovProjekta"];
        $datum_projekta = $_POST["rokProjekta"];
        $bitnost_projekta = $_POST["bitnostProjekta"];

        $todo = $_POST["novitodo"];
        $bitnost = $_POST["novabitnost"];
        $rokovi = $_POST["novitodoDatum"];

        $rokId = $operacijeBaze -> napraviProjekat($naslov_projekta, $bitnost_projekta, $datum_projekta);

        for ($i=0; $i < count($todo); $i++) {
            $operacijeBaze -> napraviStavku($rokId, $todo[$i], $bitnost[$i], $rokovi[$i], 0, -1);
        }
    }
}
header("refresh:0;url=index.php");
?>