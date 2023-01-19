<?php
if ($listaProjekata->num_rows > 0) {
    while ($projekat = $listaProjekata->fetch_assoc()) {
        $stavke = $operacijeBaze->selectPoIdProjekta($projekat["id"]);
        if ($stavke->num_rows > 0) {
            while ($stavka = $stavke->fetch_assoc()) {
                if ($korisnik["uloga"] == 1 || $korisnik["id"] == $stavka["id_usera"]) {
                    echo '<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas' . $stavka["id"] . '">
                  <input type="hidden" name="id" value="' . $stavka["id"] . '"></input>
                  <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">' . $stavka["naziv"] . '</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body">
                  ';
                    if ($korisnik["uloga"] == 1) {
                        echo '
                    <form action="izmeniUsera.php" method="post">
                        Zadato: 
                        <input type="hidden" name="id" value="'. $stavka["id"] .'"></input>
                        <input type="text" name="noviUser" placeholder="' . $operacijeBaze->selectUserMailpoId($stavka["id_usera"]) . '">
                        </input>
                        <input type="submit" class="prijavi-se p-2 d-block text-center mt-2" value="Potvrdi izmenu"></input>
                    </form>
                    <form action="izmeniKomentar.php" method="post">
                    ';
                    }
                    $komentar = $operacijeBaze->selectKomentarPoIdStavke($stavka["id"]);
                    $napravljen = false;
                    $idKomentara = -1;
                    if ($komentar == null) {
                        $napravljen = true;
                        $idKomentara = $operacijeBaze->napraviKomentar($stavka["id"], "");
                    } else {
                        $idKomentara = $komentar["id"];
                    }

                    if ($napravljen) {
                        echo '
                        <input type="hidden" name="id" value="' . $idKomentara . '"></input>
                        <input type="hidden" name="id_stavke" value="' . $stavka["id"] . '"></input>
                        <textarea class="mt-5 w-100 vh-50 align-top" maxlength="512" name="komentar"></textarea>
                        <input type="submit" class="prijavi-se p-2 d-block text-center mt-2" value="Ostavi belešku"></input>
                    </form>
                  </div>
                </div>';
                    } else {
                        echo '
                        <input type="hidden" name="id" value="' . $idKomentara . '"></input>
                        <input type="hidden" name="id_stavke" value="' . $stavka["id"] . '"></input>
                        <textarea class="mt-5 w-100 vh-50 align-top" maxlength="512" name="komentar" ">' . $komentar["komentar"] . '</textarea>
                        <input type="submit" class="prijavi-se p-2 d-block text-center mt-2" value="Ostavi belešku"></input>
                    </form>
                  </div>
                </div>';
                    }
                }
            }
        }
    }
}
