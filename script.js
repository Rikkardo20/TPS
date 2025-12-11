function pulisciTabella() {

    const tab = document.getElementById("tabella");
    if(!tab) return;
    tab.innerHTML ="<tr><th>Nome</th><th>Prezzo</th><th></th></tr>";
}

function LetturaFileXML() {
    pulisciTabella();

    let leggi = new XMLHttpRequest();
    leggi.open('GET', "elettronica.xml", true);
    leggi.send();

    leggi.onload = function () {
        const xml = leggi.responseXML;

        const prodotto = xml.getElementsByTagName("prodotto");

        for (let i = 0; i < prodotto.length; i++) {
            let nome = prodotto[i].getElementsByTagName("nome")[0].textContent;
            let prezzo = prodotto[i].getElementsByTagName("prezzo")[0].textContent;

            aggiungiriga(nome, prezzo);
        }
    }
}


function LetturaFileJSON() {
    pulisciTabella();

    let leggi = new XMLHttpRequest();

    leggi.open('GET', 'dispositivicasa.json', true);
    leggi.send();
    leggi.onload = function () {

        const dati = JSON.parse(leggi.responseText);

        for (let i = 0; i < dati.prodotti.length; i++) {
            let x = dati.prodotti[i];
            aggiungiriga(x.nome, x.prezzo);
        }
    }
}

function LetturaFileCSV() {

    pulisciTabella();

    let leggi = new XMLHttpRequest();
    leggi.open('GET', 'sport.csv', true);
    leggi.send();

    leggi.onload = function () {
        const righe = leggi.responseText.split("\n");
        for (let i = 0; i < righe.length; i++) {
            const colonne = righe[i].split(",");
            aggiungiriga(colonne[0], colonne[1]);
        }
    }
}
function LetturaFileTXT() {
    pulisciTabella();

    let leggi = new XMLHttpRequest();
    leggi.open('GET', 'tipiaerei.txt', true);
    leggi.send();

    leggi.onload = function () {
        const righe = leggi.responseText.split("\n");
        for (let i = 0; i < righe.length; i++) {
            const colonne = righe[i].split(";");
            aggiungiriga(colonne[0], colonne[1]);
        }
    }
}

function acquista(nome, prezzo) {
    alert("Hai acquistato: " + nome + ", prezzo: " + prezzo);
}

function aggiungiriga(nome, prezzo) {
    const tabella = document.getElementById("tabella");

    tabella.innerHTML +=
        "<tr><td>" + nome + "</td><td>" + prezzo + 
        "</td><td><button onclick='acquista(\"" + nome + "\", \"" + prezzo + "\")'>Acquista prodotto</button></td></tr>";
}

