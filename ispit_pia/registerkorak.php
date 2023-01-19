<section class="bg-1 bez-navbar">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-8 col-lg-4 d-flex align-items-center justify-content-center my-5 flex-column">
                <img src="img/logoSrednji.webp" alt="" class="my-3">
                <div class="login-prozor p-5 w-100">
                    <h5 class="text-center naslov-prijava-registracija">Napravite svoj profil</h5>
                    <form action="register.php" class="container-fluid p-0 m-0 my-3" method="post">
                        <div class="row d-flex flex-column justify-content-center align-items-center">
                            <?php
                                echo '<input type="hidden" name="email" value="' . $_POST["email"] . '">';
                            ?>
                            <input type="text" class="my-4 w-100 tekst-email-pocetna py-1" placeholder="Ime" name="ime">
                            <input type="text" class="my-4 w-100 tekst-email-pocetna py-1" placeholder="Prezime" name="prezime">
                            <input type="password" class="my-4 w-100 tekst-email-pocetna py-1" placeholder="Lozinka" name="sifra">
                            <input type="password" class="my-4 w-100 tekst-email-pocetna py-1" placeholder="Ponovi lozinku" name="ponovljena_sifra">
                            <div class="linija-solid mt-4"></div>
                            <input type="submit" class="w-50 mx-sm-2 prijavi-se p-2 mt-5 taman-tekst senka" value="Nastavi">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>