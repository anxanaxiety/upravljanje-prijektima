<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("db_operacije.php");
$operacijeBaze = new OperacijeBaze();

$listaProjekata = $operacijeBaze->selectSve('projekti');
if ($korisnik["uloga"] == 1) {
    echo '
<template id="redToDo">
    <div class="row my-2 border-md noviTodo">
        <div class="col-8 col-lg-6">
            <input type="text" name="novitodo[]" class="w-100" placeholder="Stavka"></input>
        </div>
        <div class="col-2 col-lg-1">
            <input type="hidden" name="novabitnost[]" value="0" class="bitnost"></input>
            <i class="fa-regular fa-star" onclick="promeniBitnost(this);"></i>
        </div>
        <div class="col-lg">
            <input type="date" name="novitodoDatum[]" class="w-100"></input>
        </div>
        <div class="row d-flex justify-content-center" id="dodajRedDugme">
            <button type="button" class="text-center d-flex justify-content-center align-items-center bg-white border-0 s30x30 rounded-circle my-1" onclick="dodajRed(this);">+</button>
        </div>
    </div>
</template>';
}

include("offcanvas.php");

$listaProjekata = $operacijeBaze->selectSve('projekti');;

?>
<section class="bg-2 d-flex align-items-stretch section-fiksirano overflow-hidden">
    <div class="container py-5 tekst-svetla3 font-raleway fs-25">
        <div class="row">
            <h1 class="beli-tekst font-raleway fw-bold fs-64 my-3">Svi projekti</h1>
        </div>
        <div class="row d-flex justify-content-center h-75 position-relative align-items-stretch" id="drzacKartica">
            <?php
            if ($listaProjekata->num_rows > 0) {
                while ($projekat = $listaProjekata->fetch_assoc()) {

                    $stavke = $operacijeBaze->selectPoIdProjekta($projekat["id"]);

                    if (isset($_GET["pretraga"])) {
                        $pronadjeno = false;
                        $pretraga = $_GET["pretraga"];

                        if (strcasecmp(substr($projekat["naziv"], 0, strlen($pretraga)), $pretraga) == 0) {
                            $pronadjeno = true;
                        }

                        if (!$pronadjeno) {
                            if ($stavke->num_rows > 0) {
                                while ($stavka = $stavke->fetch_assoc()) {
                                    if (strcasecmp(substr($stavka["naziv"], 0, strlen($pretraga)), $pretraga) == 0) {
                                        $pronadjeno = true;
                                        break;
                                    }
                                }
                            }
                        }

                        if (!$pronadjeno) {
                            continue;
                        }
                    }

                    $stavke = $operacijeBaze->selectPoIdProjekta($projekat["id"]);


                    echo '<form method="post" action="edit.php" class="col-10 col-sm-8 col-lg-6 card d-flex align-self-stretch flex-column font-raleway p-0 h-100">';
                    echo '<div class="card-header text-center fw-bold">';
                    echo '<input type="hidden" name="idProjekta" value="' . $projekat["id"] . '">';
                    if ($projekat['vazno']) {
                        echo '<input type="hidden" name="bitnostProjekta" value="1" class="bitnost">';
                        echo '<i class="fa-solid fa-star" onclick="promeniBitnostEdit(this)"></i>';
                    } else {
                        echo '<input type="hidden" name="bitnostProjekta" value="0" class="bitnost">';
                        echo '<i class="fa-regular fa-star" onclick="promeniBitnostEdit(this)"></i>';
                    }
                    echo '<div class="naslov-projekta d-inline-block">' . $projekat["naziv"] . '</div>';

                    if ($korisnik["uloga"] == 1) {
                        echo '<button type="button" class="position-absolute end-0 top-0 my-2 mx-2 bg-transparent border-0 text-white" onclick="edituj(this);"><i class="fa-regular fa-pen-to-square dugme-edit"></i></button>';
                    }

                    echo '<br><div class="fw-normal rok-projekta-datum">' . $projekat["rok"] . '</div>';
                    echo '</div>';

                    echo '<div class="card-body container p-5 overflow-auto h-100 custom-scrollbar">';

                    $nestoIspisano = false;

                    if ($stavke->num_rows > 0) {
                        while ($stavka = $stavke->fetch_assoc()) {
                            if ($korisnik["uloga"] == 1 || $korisnik["id"] == $stavka["id_usera"]) {
                                $nestoIspisano = true;
                                echo '<div class="row my-2 border-md " ">
                            <div class="col-8 col-lg-6 cursor-pointer-mouseover" data-bs-toggle="offcanvas" data-bs-target="#offcanvas' . $stavka["id"] . '">
                            <div class="kruzic"></div><div class="nazivi-todo d-inline-block">' . $stavka["naziv"] . '</div></div>
                            <div class="col-2 col-lg-1">';
                                echo '<input class="id-stavki-klasa" type="hidden" name="id_stavki[]" value="' . $stavka["id"] . '">';
                                if ($stavka["vazno"]) {
                                    echo '<input type="hidden" name="bitnost[]" value="1" class="bitnost">';
                                    echo '<i class="fa-solid fa-star" onclick="promeniBitnostEdit(this)"></i>';
                                } else {
                                    echo '<input type="hidden" name="bitnost[]" value="0" class="bitnost">';
                                    echo '<i class="fa-regular fa-star" onclick="promeniBitnostEdit(this)"></i>';
                                }
                                echo '</div>
                            <div class="col-2 col-lg-1">';

                                if ($stavka["status"] == 0) {
                                    echo '<input type="hidden" name="statusi[]" value="0" class="statusi-projekta">';
                                    echo '<i class="fa-regular fa-clock" onclick="promeniStatuseEdit(this)"></i>';
                                } elseif ($stavka["status"] == 1) {
                                    echo '<input type="hidden" name="statusi[]" value="1" class="statusi-projekta">';
                                    echo '<i class="fa-solid fa-spinner" onclick="promeniStatuseEdit(this)"></i>';
                                } else {
                                    echo '<input type="hidden" name="statusi[]" value="2" class="statusi-projekta">';
                                    echo '<i class="fa-solid fa-check" onclick="promeniStatuseEdit(this)"></i>';
                                }

                                echo '</div>
                            <div class="col-lg-4 text-end">';
                                echo '<div class="rok-stavke">' . $stavka["rok"] . '</div>';
                                echo '</div></div>';
                            }
                        }
                    }

                    if (!$nestoIspisano) {
                        echo "Nemate zadatih stavki u ovom projektu";
                    }

                    echo '</div>
                    <div class="card-footer d-flex justify-content-center">
                    <div class="ikonica-tabela mx-2"><i class="fa-solid fa-arrow-down-wide-short"></i></div>';
                    if ($korisnik["uloga"] == 1) {
                        echo '<button onclick="window.location=\'ukloni.php?id=' . $projekat["id"] . '\'" class="ikonica-tabela mx-2" form="uklanjanje"><i class="fa-solid fa-trash"></i></button>';
                    }
                    echo '</div></form>';
                }
            }

            ?>
            <button id="levo" class="position-absolute bg-transparent border-0 navigacija-ikonica top-50 start-0 text-white" onclick="pomeriLevo()">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button id="desno" class="position-absolute bg-transparent border-0 navigacija-ikonica top-50 end-0 text-white" onclick="pomeriDesno()">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
            <script src="js/vrteska.js"></script>
            <?php
            if ($korisnik["uloga"] == 1) {
                echo '<script src="js/edit.js"></script>';
            } else {
                echo '<script src="js/editKorisnika.js"></script>';
            }
            ?>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        </div>
    </div>
</section>