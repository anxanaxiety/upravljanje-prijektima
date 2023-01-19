function promeniStatuseEdit(element) {
  if (element.classList.contains("fa-clock")) {
    var inv = element.parentElement.getElementsByClassName("statusi-projekta");
    inv[0].value = 1;
    var idStavke = element.parentElement.parentElement.getElementsByClassName("id-stavki-klasa")[0].value;
    $.ajax({
      type: "POST",
      url: "izmeniStatus.php",
      data: {
        id: idStavke,
        status: 1,
      }
    });
    element.classList.replace("fa-regular", "fa-solid");
    element.classList.replace("fa-clock", "fa-spinner");
    element.classList.remove("vaznoSelect", "vaznoDeselect");
    element.classList.add("vaznoSelect");
  } else if (element.classList.contains("fa-spinner")) {
    var inv = element.parentElement.getElementsByClassName("statusi-projekta");
    inv[0].value = 2;
    var idStavke = element.parentElement.parentElement.getElementsByClassName("id-stavki-klasa")[0].value;
    $.ajax({
      type: "POST",
      url: "izmeniStatus.php",
      data: {
        id: idStavke,
        status: 2,
      }
    });
    element.classList.replace("fa-spinner", "fa-check");
    element.classList.remove("vaznoSelect", "vaznoDeselect");
    element.classList.add("vaznoDeselect");
  } else if (element.classList.contains("fa-check")) {
    var inv = element.parentElement.getElementsByClassName("statusi-projekta");
    inv[0].value = 0;
    var idStavke = element.parentElement.parentElement.getElementsByClassName("id-stavki-klasa")[0].value;
    $.ajax({
      type: "POST",
      url: "izmeniStatus.php",
      data: {
        id: idStavke,
        status: 0,
      }
    });
    element.classList.replace("fa-solid", "fa-regular");
    element.classList.replace("fa-check", "fa-clock");
    element.classList.remove("vaznoSelect", "vaznoDeselect");
    element.classList.add("vaznoSelect");
  }
}
