boutonssSuppr = document.body.getElementsByClassName('btn-danger');

Array.prototype.forEach.call(boutonssSuppr,
    function (item) {
        item.addEventListener('click', (e) => confSuppr(e))
    }
)

/* Editable tarifs */
tdEditablesTarifs = document.body.getElementsByClassName('tarif');

Array.prototype.forEach.call(tdEditablesTarifs,
    function (item) {
        item.addEventListener('input', (e) => infoTarif(e))
    }
)

function confSuppr(e) {

    boolConf = confirm("Voulez-vous vraiment supprimer cet élément ?");
    if (boolConf) return false;
    e.preventDefault();
}

async function infoTarif(e) {

    let tdTarif = e.target;
    let tarPrix = tdTarif.innerHTML;


    let hoc = tdTarif.getAttribute('data-hoc');
    let chc = tdTarif.getAttribute('data-chc');

    editTar(hoc, chc, tarPrix);

}

async function editTar(hoc, chc, tarprix) {
    console.log('hoc vaut : ' + hoc)
    console.log('chc vaut : ' + chc)
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