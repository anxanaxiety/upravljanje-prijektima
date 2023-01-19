<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="img/logo.webp" width="21px" height="27px" alt="Logo kompanije" class="me-2">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggle">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse align-middle" id="toggle">
      <ul class="navbar-nav d-flex align-items-center">
        <li class="nav-item mx-3">
        <div class="dropdown">
            <button class="btn tamna-glavna dropdown-toggle bg-transparent border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              Teme
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="tema.php?id=0">Poslovna</a></li>
              <li><a class="dropdown-item" href="tema.php?id=1">Okean</a></li>
              <li><a class="dropdown-item" href="tema.php?id=2">Kreativna</a></li>
              <li><a class="dropdown-item" href="tema.php?id=3">Svetla</a></li>
              <li><a class="dropdown-item" href="tema.php?id=4">Papir</a></li>
              <li><a class="dropdown-item" href="tema.php?id=5">Koralna</a></li>
            </ul>
          </div>
        </li>
        <?php
        require_once("db_operacije.php");
        $operacijeBaze = new OperacijeBaze();
        $korisnik = $operacijeBaze->pronadjiEmail($_SESSION["auth"]) -> fetch_assoc();
        if ($korisnik["uloga"] == 1) {
          echo '
          <li class="nav-item mx-3 p-2 prijavi-se">
            <button class="prijavi-se" onclick="noviProjekat();">Novi projekat</button>
          </li>';

          include("novaFormaTemplate.php");
          echo '<script src="js/novaForma.js"></script>';
        }
        ?>
      </ul>
      <ul class="navbar-nav ms-auto mb-lg-0 d-flex align-items-center">
        <li class="nav-item mx-1 px-lg-2">
          <form action="pretraga.php">
            <div class="bar-pretrage tekst-svetla2 pretraga-container p-1">
              <i class="fas fa-search"></i>              
              <input type="search" name="pretraga" id="pretraga" class="pretraga tekst-svetla2" placeholder="Pretraga">
            </div>
          </form>
        </li>
        <li class="nav-item mx-1 tamna-glavna d-none">
          <i class="far fa-bell fs-25"></i>
        </li>
        <li class="nav-item ms-md-5 mt-1 mt-md-0 username d-flex justify-content-center align-items-center">
          <div class="dropdown">
            <button class="btn tamna-glavna text-white fs-25 bg-transparent border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $korisnik["ime"][0] . $korisnik["prezime"][0]; ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="logout.php">Izloguj se</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
