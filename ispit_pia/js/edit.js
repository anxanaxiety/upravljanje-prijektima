editMod = false;

function edituj(element) {

  if (editMod) {
    element.parentElement.parentElement.submit();
  }

  editMod = true;

  var editDugme = element.getElementsByClassName("fa-pen-to-square")[0];
  editDugme.classList.replace("fa-pen-to-square", "fa-check");
  editDugme.classList.replace("fa-regular", "fa-solid");

  var kruzici = element.parentElement.parentElement.getElementsByClassName("kruzic");

  for (let index = 0; index < kruzici.length; index++) {
    const element = kruzici[index];
    element.classList.add("d-none");
  }

  var naslov = element.parentElement.parentElement.getElementsByClassName("naslov-projekta");

  var tekst = naslov[0].innerHTML;

  naslov[0].innerHTML = '<input type="text" class="w-100" name="naslovProjekta" value="' + tekst + '"></input>';

  var rokProjekta = element.parentElement.parentElement.getElementsByClassName("rok-projekta-datum");

  var tekst = rokProjekta[0].innerHTML;

  rokProjekta[0].innerHTML = '<input type="date" name="rokProjekta" value="' + tekst + '"></input>';

  var naziviToDo = element.parentElement.parentElement.getElementsByClassName("nazivi-todo");

  for (let index = 0; index < naziviToDo.length; index++) {
    const element = naziviToDo[index];
    element.parentElement.removeAttribute('data-bs-toggle');
    element.parentElement.removeAttribute('data-bs-target');
    const txt = element.innerHTML;
    element.innerHTML = '<input type="text" name="todo[]" class="w-100" value="' + txt + '"></input>';
  }

  var datumiToDo = element.parentElement.parentElement.getElementsByClassName("rok-stavke");

  for (let index = 0; index < datumiToDo.length; index++) {
    const element = datumiToDo[index];
    const txt = element.innerHTML;
    element.innerHTML = '<input type="date" name="todoDatum[]" class="w-100" value="' + txt + '"></input>';
  }

  var zaDodavanjeRedova = element.parentElement.parentElement.getElementsByClassName("custom-scrollbar")[0].getElementsByClassName("row");
  
  var red = zaDodavanjeRedova[zaDodavanjeRedova.length - 1]

  red.innerHTML += `<div class="row d-flex justify-content-center" id="dodajRedDugme">
  <button type="button" class="text-center d-flex justify-content-center align-items-center bg-white border-0 s30x30 rounded-circle my-1" onclick="dodajRed(this);">+</button>
</div>`;

}

function dodajRed(element) {
  let redovi = element.parentElement.parentElement.parentElement;
  let red = document.getElementById("redToDo").content.cloneNode(true);
  let dugmeDodaj = element.parentElement;

  dugmeDodaj.remove();

  redovi.appendChild(red);
}

function promeniBitnostEdit(element) {
  if (!editMod) return;
  
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

function promeniStatuseEdit(element) {
  if (!editMod) return;
  
  if (element.classList.contains("fa-clock")) {
    var inv = element.parentElement.getElementsByClassName("statusi-projekta");
    inv[0].value = 1;
    element.classList.replace("fa-regular", "fa-solid");
    element.classList.replace("fa-clock", "fa-spinner");
    element.classList.remove("vaznoSelect", "vaznoDeselect");
    element.classList.add("vaznoSelect");
  } else if (element.classList.contains("fa-spinner")) {
    var inv = element.parentElement.getElementsByClassName("statusi-projekta");
    inv[0].value = 2;
    element.classList.replace("fa-spinner", "fa-check");
    element.classList.remove("vaznoSelect", "vaznoDeselect");
    element.classList.add("vaznoDeselect");
  } else if (element.classList.contains("fa-check")) {
    var inv = element.parentElement.getElementsByClassName("statusi-projekta");
    inv[0].value = 0;
    element.classList.replace("fa-solid", "fa-regular");
    element.classList.replace("fa-check", "fa-clock");
    element.classList.remove("vaznoSelect", "vaznoDeselect");
    element.classList.add("vaznoSelect");
  }
}
