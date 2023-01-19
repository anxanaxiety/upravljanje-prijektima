<section class="bg-1 bez-navbar">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-8 col-lg-4 d-flex align-items-center justify-content-center my-5 flex-column">
                <img src="img/logoSrednji.webp" alt="" class="my-3">
                <div class="login-prozor p-5">
                    <h5 class="text-center naslov-prijava-registracija">Prijavite se na svoj profil</h5>
                    <form action="login.php" class="container-fluid p-0 m-0 my-3" method="post">
                        <div class="row d-flex flex-column justify-content-center align-items-center">
                            <input type="email" class="my-2 w-100 tekst-email-pocetna py-1" placeholder="Email" name="email">
                            <input type="password" class="my-2 w-100 tekst-email-pocetna py-1" placeholder="Lozinka" name="sifra">
                            <input type="submit" class="w-50 mx-sm-2 prijavi-se p-2 mt-4 taman-tekst senka" value="Nastavi">
                        </div>
                    </form>
                    <div class="linija">
                        ili
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <div class="g-signin2" data-onsuccess="onSignIn"></div>
                    </div>
                    <div class="linija-solid mt-4"></div>
                    <div class="d-flex pt-2 justify-content-center align-items-center">
                        <a href="register.php" class="mali-tekst mx-2 d-inline-block">Nemate nalog? <div class="novi-profil-dugme mali-tekst mx-2 p-1 d-inline-block">Novi profil</div></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>