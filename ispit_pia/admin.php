<?php
if ($korisnik["uloga"] != 2) {
    die("Nisi administrator!");
}
?>
<div class="modal fade" id="dodajUsera" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="dodajUsera.php" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dodaj korisnika</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body d-flex justify-content-center flex-column">
                <input type="text" name="ime" placeholder="Ime"></input>
                <input type="text" name="prezime" placeholder="Prezime"></input>
                <input type="email" name="email" placeholder="Email"></input>
                <input type="password" name="lozinka" placeholder="Lozinka"></input>
                <input type="password" name="lozinka-ponovljeno" placeholder="Ponovi lozinku"></input>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                <input type="submit" class="btn btn-primary" value="Dodaj"></input>
            </div>
        </form>
    </div>
</div>
<section class="bg-2 d-flex align-items-stretch section-fiksirano overflow-hidden">
    <div class="container font-raleway">
        <h1 class="text-white font-raleway mt-5 fs-64">Lista korisnika<i class="fa-regular fa-id-card fs-1 ms-3"></i></h1>
        <div class="pozadina-tabele">
            <div class="row text-white card-header d-flex py-3 m-0">
                <div class="col text-end cursor-pointer-mouseover" data-bs-toggle="modal" data-bs-target="#dodajUsera">
                    <i class="fa-solid fa-circle-plus"></i>
                    Dodaj
                </div>
            </div>
            <?php
            require_once("db_operacije.php");
            $operacijeBaze = new OperacijeBaze();

            $useri = $operacijeBaze->selectSve("user");

            if ($useri->num_rows > 0) {
                while ($user = $useri->fetch_assoc()) {
                    if ($user["uloga"] != 2) {
                        printf('
                <div class="row px-3 py-2 text-white d-flex justify-content-center fs-25">
                    <div class="col-8 col-lg-10 semi-bold">%s %s</div>
                    <div class="col"><i class="fa-solid %s cursor-pointer-mouseover" onclick="izmeniUlogu(this);" id="' . $user["id"] . '"></i></div>
                    <div class="col"><i class="ikonica-tabela ikonica-admin fa-solid fa-trash" onclick="ukloniUsera(this);" id="' . $user["id"] . '"></i></div>
                </div>
                ', $user["ime"], $user["prezime"], $user["uloga"] == 1 ? "fa-user-pen" : "fa-user");
                    }
                }
            }
            ?>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function izmeniUlogu(element) {
        var menadzer = element.classList.contains("fa-user-pen");
        var id = element.id;

        console.log(id);

        if (menadzer == false) {
            element.classList.replace("fa-user", "fa-user-pen");
            $.ajax({
                type: 'POST',
                url: 'modUsera.php',
                data: {
                    id: id,
                    uloga: 1
                }
            });
        } else {
            element.classList.replace("fa-user-pen", "fa-user");
            $.ajax({
                type: 'POST',
                url: 'modUsera.php',
                data: {
                    id: id,
                    uloga: 0
                }
            });
        }
    }

    function ukloniUsera(element) {
        var id = element.id;

        $.ajax({
            type: 'POST',
            url: 'ukloniUsera.php',
            data: {
                id: id
            },
            success: function(data) {
                element.parentElement.parentElement.remove();
            }
        });
    }
</script>