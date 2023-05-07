/* Début - Confirmer l'appui sur le bouton supprimer */
let boutonssSuppr = document.body.getElementsByClassName('btn-danger');
let tdEditablesTarifs = document.body.getElementsByClassName('tarif');

Array.prototype.forEach.call(boutonssSuppr,
    function (item) {
        item.addEventListener('click', (e) => confSuppr(e))
    }
)

function confSuppr(e) {

    boolConf = confirm("Voulez-vous vraiment supprimer cet élément ?");
    if (boolConf) return false;
    e.preventDefault();
}
/* Fin - Confirmer l'appui sur le bouton supprimer */

/* Début - appel AJAX pour édition des tarifs */
let inputHotel = document.body.getElementsByClassName('tarif');

Array.prototype.forEach.call(tdEditablesTarifs,
    function (item) {
        item.addEventListener('input', (e) => infoTarif(e))
    }
)

async function infoTarif(e) { // callback
    let tdTarif = e.target;
    let tarPrix = tdTarif.innerHTML;

    let hoc = tdTarif.dataset.hoc;
    let chc = tdTarif.dataset.chc;

    editTerif(hoc, chc, tarPrix);

}

async function editTerif(hoc, chc, tarprix) {
    let tdEditionHeader = {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        mode: "cors",
        credentials: "same-origin",
        body: JSON.stringify({
            hoc: hoc,
            chc: chc,
            tarPrix: tarprix
        })
    };

    const texte = await fetch('index.php?m=tarifer&a=ajax', tdEditionHeader)
        .then((res) => res.text());

    console.log(texte);
}
/* Fin - appel AJAX pour édition des tarifs */

/* Début - appel AJAX pour numéro des chambres */
/* Fin - appel AJAX pour numéro des chambres */

/* Début - Evénemnt Javascript pour rechercher les chambres disponibles */

/* Fin - Evénement Javascript pour rechercher les chambres disponibles */