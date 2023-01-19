function promeniBitnost(element) {
  if (element.classList.contains("fa-regular")) {
    var inv = element.parentElement.getElementsByClassName("bitnost");
    inv[0].value = 1;
    element.classList.replace("fa-regular", "fa-solid");
    element.classList.remove("vaznoSelect", "vaznoDeselect");
    element.classList.add("vaznoSelect");
  } else {
    var inv = element.parentElement.getElementsByClassName("bitnost");
    inv[0].value = 0;
    element.classList.replace("fa-solid", "fa-regular");
    element.classList.remove("vaznoSelect", "vaznoDeselect");
    element.classList.add("vaznoDeselect");
  }
}

function dodajRed(element) {
  let redovi = element.parentElement.parentElement.parentElement;
  let red = document.getElementById("redToDo").content.cloneNode(true);
  let dugmeDodaj = element.parentElement;

  dugmeDodaj.remove();

  redovi.appendChild(red);
}

function noviProjekat() {
  let drzac = document.getElementById("drzacKartica");

  let forma = document.getElementById("novaForma").content;

  drzac.appendChild(document.importNode(forma, true));

  idiNaPoslednji();
}
