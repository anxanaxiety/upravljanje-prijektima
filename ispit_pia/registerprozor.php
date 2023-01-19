<section class="bg-1 bez-navbar">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-8 col-lg-4 d-flex align-items-center justify-content-center my-5 flex-column">
                <img src="img/logoSrednji.webp" alt="" class="my-3">
                <div class="login-prozor p-5">
                    <h5 class="text-center naslov-prijava-registracija">Napravite novi profil</h5>
                    <form action="register.php" class="container-fluid p-0 m-0 my-3" method="post">
                        <div class="row d-flex flex-column justify-content-center align-items-center">
                            <input type="email" class="my-2 w-100 tekst-email-pocetna py-1" placeholder="Email" name="email">
                            <div class="d-flex align-items-start">
                                <input type="checkbox" id="uslovi" class="d-inline-block me-2" name="uslovi">
                                <label for="uslovi" class="d-inline-block mali-tekst">Klikom na ovo dugme potvrđujete da ste pročitali i prihvatili 
                                uslove korišćenja i politiku privatnosti.</label>
                            </div>
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
                        <a href="#" class="mali-tekst mx-2">Već imate nalog?</a>
                        <div class="prijavi-se mali-tekst mx-2 p-2 px-3">Prijavi se</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>