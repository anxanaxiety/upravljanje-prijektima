<section class="bg-1 bez-navbar">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-8 col-lg-4 d-flex align-items-center justify-content-center my-5 flex-column">
                <img src="img/logoSrednji.webp" alt="" class="my-3">
                <div class="login-prozor p-5 w-100">
                    <h5 class="text-center naslov-prijava-registracija">Uspesan login, preusmeravam na glavnu stranicu...</h5>
                    <p>ako ne radi preusmeravanje, <a href="index.php">kliknite ovde</a></p>
                    <?php
                    header("Refresh:5; url=index.php");
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>