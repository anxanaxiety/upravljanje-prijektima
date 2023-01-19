var clanoviVrteske = document.getElementsByClassName("card");
var pos = 0;
var n = clanoviVrteske.length;

function idiNaPoslednji() {
    clanoviVrteske = document.getElementsByClassName("card");
    n = clanoviVrteske.length;
    pos = n - 1;
    updateClanove(pos, pos - 1, 0, false);
}

function pomeriDesno() {
    pos = (pos + 1) % n;
    posPre = (pos - 1) >= 0 ? pos - 1 : n - 1;
    posPosle = (pos + 1) % n;
    
    console.log(posPre, pos, posPosle)

    updateClanove(pos, posPre, posPosle,  false);
}

function pomeriLevo() {
    pos = (pos - 1) >= 0 ? pos - 1 : n - 1;
    posPre = (pos - 1) >= 0 ? pos - 1 : n - 1;
    posPosle = (pos + 1) % n;

    console.log(posPre, pos, posPosle)

    updateClanove(pos, posPre, posPosle, true);
}

function updateClanove(pos, posPre, posPosle, nalevo) {
    for (let i = 0; i < clanoviVrteske.length; i++) {
        if (i == pos) {
            clanoviVrteske[i].classList.remove("d-none", "kartica-levo", "kartica-desno", "nalevo", "nadesno");
            clanoviVrteske[i].classList.add("kartica-sredina");
        }
        else if (i == posPre) {
            clanoviVrteske[i].classList.remove("d-none", "kartica-sredina", "kartica-desno", "nalevo", "nadesno");
            clanoviVrteske[i].classList.add("kartica-levo");
            if (!nalevo) {
                clanoviVrteske[i].classList.add("nalevo");
            }
        }
        else if (i == posPosle) {
            clanoviVrteske[i].classList.remove("d-none", "kartica-sredina", "kartica-levo", "nalevo", "nadesno");
            clanoviVrteske[i].classList.add("kartica-desno");
            if (nalevo) {
                clanoviVrteske[i].classList.add("nadesno");
            }
        }
        else {
            clanoviVrteske[i].classList.remove("kartica-desno", "kartica-levo", "kartica-sredina", "nalevo", "nadesno")
            clanoviVrteske[i].classList.add("d-none");
        }
    }
}

pomeriDesno();