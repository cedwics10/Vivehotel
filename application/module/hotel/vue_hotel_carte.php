<p>
            <label for="region">Région : </label>
            <select id="region"></select>
        </p>
        <p>
            <label for="departement">Département : </label>
            <select id="departement"></select>
        </p>
        <p>
            <label for="ville">Ville : </label>
            <select id="ville"></select>
        </p>
        <div id="detail"></div>
        <label>Qualité de l'air</label>
        <div id="aqicn"></div>
        <div id="map"></div>
        </body>
        <script>
            afficheRegion();
            region.addEventListener("change", afficheDept);
            departement.addEventListener("change", afficheVille);
            ville.addEventListener("change", afficheDetail);

            function afficheRegion() {
                fetch("http://localhost/site_vivehotel/www/index.php?m=hotel&a=edit&id=1")
                    .then(reponse => reponse.json())
                    .then(data => {
                        for (let i = 0; i < data.length; i++) {
                            region.innerHTML += `<option value='${data[i]["region_code"]}'>${data[i]["name"]}</option>`;
                        }
                        afficheDept();
                    });
            }

            function afficheDept() {
                fetch("http://bilel/devoir/informatique/05%20-%20Web/d_javascript/03_ajax/02_ajax_france/backfrance/franceapi.php?para=departement&code=" + region.value)
                    .then(reponse => reponse.json())
                    .then(data => {
                        departement.innerHTML = "";
                        for (let i = 0; i < data.length; i++) {
                            departement.innerHTML += `<option value='${data[i]["departement_code"]}'>${data[i]["name"]}</option>`;
                        }
                        afficheVille();
                    });
            }

            function afficheVille() {
                fetch("http://bilel/devoir/informatique/05%20-%20Web/d_javascript/03_ajax/02_ajax_france/backfrance/franceapi.php?para=ville&code=" + departement.value)
                    .then(reponse => reponse.json())
                    .then(data => {
                        ville.innerHTML = "";
                        for (let i = 0; i < data.length; i++) {
                            ville.innerHTML += `<option value='${data[i]["id"]}' data-longitude='${data[i]["longitude"]}' data-latitude='${data[i]["latitude"]}'>${data[i]["name"]}</option>`;
                        }
                    });
            }

            function getAirQualite() {
                let nomville = ville.options[ville.selectedIndex].text;
                const token = "c70205a509a2207b528bbead42a7c096f2e98675";
                fetch("https://api.waqi.info/feed/" + nomville + "/?token=" + token)
                    .then(data => data.json())
                    .then(obj => {
                        console.log(obj);
                        aqicn.innerHTML = "qualité de l'air : " + obj.data.aqi;
                    });
            }

            function afficheDetail() {
                //objet option sélectionné
                let opt = ville.options[ville.selectedIndex];
                let longitude = opt.dataset.latitude;
                let latitude = opt.dataset.longitude;
                newcenter.lat = parseFloat(latitude);
                newcenter.lng = parseFloat(longitude);
                initMap();
                //Affichage du détail de la ville       
                /*
                fetch("http://gilles/reseau/05%20-%20Web/d_javascript/03_ajax/02_ajax_france/backfrance/franceapi.php?para=ville&id=" + ville.value)
                    .then(reponse => reponse.json())
                    .then(data => {
                        detail.innerHTML = "";
                        for (let cle in data) {
                            detail.innerHTML += cle + " : " + data[cle] + "<br>";
                        }
                    });
                */
            }

            let newmap;
            let newcenter = {
                lat: 45.0,
                lng: 3.0
            };
            //de 1 à 22
            let zoom = 15;

            function initMap() {
                newmap = new google.maps.Map(document.getElementById('map'), {
                    "center": newcenter,
                    "zoom": zoom
                });
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC575In87Ezt0AI_ePANmEMjoWKu6Gw-Ng&callback=initMap" async defer></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC575In87Ezt0AI_ePANmEMjoWKu6Gw-Ng&callback=initMap" async defer></script>