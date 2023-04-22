<?php
header('Content-Type: application/javascript');
include('../../framework/fonction.php');
?>

boutonssSuppr = document.body.getElementsByClassName('btn-danger');
tdEditablesTarifs = document.body.getElementsByClassName('tarif');

Array.prototype.forEach.call(boutonssSuppr,
function (item) {
item.addEventListener('click', (e) => confSuppr(e))
}
)

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

let tarPrix = e.target.innerHTML;
let tarHoCategorie = e.target.getAttribute('numhoc');
let tarChCategorie = e.target.getAttribute('numchc');

editTar(tarHoCategorie, tarChCategorie, tarPrix);

}

async function editTar(hoc, chc, tarprix) {
let tdEditionHeader = {
method: "POST",
headers: {
'Content-Type': 'application/x-www-form-urlencoded'
},
mode: "cors",
credentials: "same-origin",
body: JSON.stringify({
tar_hocategorie: hoc,
tar_chcategorie: chc,
tar_prix: tarprix
})
};

const texte = await fetch('<?= hlien('tarifer', 'ajax') ?>', tdEditionHeader)
.then((res) => res.text());

console.log(texte);
}