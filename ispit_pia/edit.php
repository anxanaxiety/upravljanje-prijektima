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
        $id_projekta = $_POST["idProjekta"];

        $todoId = $_POST["id_stavki"];
        $statusi = $_POST["statusi"];
        $todo = $_POST["todo"];
        $bitnost = $_POST["bitnost"];
        $rokovi = $_POST["todoDatum"];

        if (isset($_POST["novitodo"])) {
            $novitodo = $_POST["novitodo"];
            $novabitnost = $_POST["novabitnost"];
            $novitodoDatum = $_POST["novitodoDatum"];
        }

        $rokId = $operacijeBaze -> izmeniProjekat($id_projekta, $naslov_projekta, $bitnost_projekta, $datum_projekta);

        for ($i=0; $i < count($todo); $i++) {
            $operacijeBaze -> izmeniStavku($todoId[$i], $id_projekta, $todo[$i], $bitnost[$i], $rokovi[$i], $statusi[$i]);
        }

        if (isset($_POST["novitodo"]))
            for ($i=0; $i < count($novitodo); $i++) {
                $operacijeBaze -> napraviStavku($id_projekta, $novitodo[$i], $novabitnost[$i], $novitodoDatum[$i], 0, -1);
            }
    }
}
header("refresh:0;url=index.php");
?>