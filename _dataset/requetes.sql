-- 1.	Liste des hôtels avec le nombre de chambres actives.
SELECT  hot_id, hot_nom, COUNT(DISTINCT(cha_id)) `nb_cha_actives`
FROM hotel, reservation, chambre
WHERE res_hotel = hot_id
AND res_chambre = cha_id
AND cha_statut = 'Validé'
GROUP BY hot_id
ORDER BY nb_cha_actives DESC
-- 2.	Liste des chambres triée par hôtel.
SELECT cha_id, hot_id
FROM hotel, reservation, chambre
WHERE hot_id = res_hotel
AND res_chambre = cha_id
GROUP BY cha_id
ORDER BY hot_id;
-- 3.	Liste des réservations avec leurs durées (en jours) triées par hôtel, par date de début et par statut.
SELECT res_id, res_date_debut, res_etat, DATEDIFF(res_date_fin, res_date_debut)
FROM reservation
ORDER BY res_hotel, res_date_debut, res_etat
LIMIT 1,100
-- 4.	Liste des réservations entre 2 dates données pour un hôtel donné.
SELECT res_id, res_date_debut, res_date_fin
FROM reservation
WHERE res_date_debut > '2021-10-01' 
AND res_date_fin < '2021-10-30'
AND res_hotel = '1'
-- 5.	Nombre de réservations entre 2 dates données par hôtel.
SELECT res_hotel, COUNT(res_id)
FROM reservation
WHERE res_date_debut > '2021-10-01'  AND res_date_fin < '2021-10-30'
GROUP BY res_hotel
ORDER BY res_hotel;
-- 6.	Nombre d’hôtels par catégorie d’hôtel.
SELECT hoc_categorie, COUNT(hot_id)
FROM hocategorie, hotel
WHERE hot_hocategorie = hoc_id
GROUP BY hoc_categorie
-- 7.	Nombre de chambres par catégorie de chambre.
SELECT chc_categorie, COUNT(cha_id) `nb_chambres_cat`
FROM chcategorie, chambre
WHERE cha_chcategorie = chc_id
GROUP BY chc_id
-- 8.	Requête donnant la durée (en nombre d’heures) d’une location.
SELECT res_id, res_etat, HOUR(TIMEDIFF(res_date_fin, res_date_debut)) `h_reservation`
FROM reservation
ORDER BY res_hotel, res_date_debut, res_etat
LIMIT 1,100;
-- 9.	Liste les chambres libres entre deux dates données pour un hôtel donné. 
SELECT DISTINCT(cha_id), cha_numero, res_hotel
FROM chambre, reservation
WHERE cha_id = res_chambre
AND res_date_debut > '2021-01-01'
AND res_date_fin < '2021-03-01'
AND res_etat = 'En attente'
AND res_hotel = 1;
-- 10.	Calcul du prix d’une réservation hors services.
SELECT  res_id, cha_id, tar_prix
FROM reservation, chambre, hotel, tarifer
WHERE res_chambre = cha_id
AND res_hotel = hot_id
AND cha_chcategorie = tar_chcategorie
AND hot_hocategorie = tar_hocategorie
ORDER BY res_id
LIMIT 0,100
-- 11.	Calcul des services consommés par client.
SELECT cli_id, COUNT(com_id) `nb_services`
FROM client, commander, reservation
WHERE res_client = cli_id
AND res_id = com_reservation
GROUP BY cli_id
ORDER BY nb_services DESC
-- 12.	Liste des services, avec pour chacun le nombre d’hôtels qui le proposent.
SELECT ser_id, COUNT(hot_id)
FROM services, proposer, hotel
WHERE ser_id = pro_services
AND hot_id = pro_hotel
GROUP BY ser_id
-- 13.	Chiffre d’affaire annuel par hôtel (hors services).
SELECT hot_id, SUM(tar_prix) `c_affaire`
FROM chambre, reservation, tarifer, hotel 
WHERE res_chambre = cha_id
AND res_hotel = hot_id
AND tar_chcategorie = cha_chcategorie
AND tar_hocategorie = hot_hocategorie
GROUP BY hot_id
ORDER BY c_affaire DESC
-- 14.	Chiffre d’affaire annuel du groupe (hors services).
SELECT SUM(tar_prix)
FROM tarifer, chambre, hotel, reservation
WHERE tar_chcategorie = cha_chcategorie
AND tar_hocategorie = hot_hocategorie
AND res_chambre = cha_id
AND hot_id = res_hotel
-- 15.	Chiffre d’affaire annuel des services par hôtel
SELECT pro_hotel, SUM(pro_prix*com_quantite) `ca_service`
FROM commander, services, proposer
WHERE com_services = ser_id 
AND ser_id = pro_services
GROUP BY pro_hotel
ORDER BY ca_service DESC
-- 16.	Chiffre d’affaire annuel des services pour le groupe
SELECT SUM(pro_prix*com_quantite) `ca_services_groupe`
FROM commander, services, proposer
WHERE com_services = ser_id 
AND ser_id = pro_services
-- 17.	Calcul du chiffre d’affaire journalier maximum théorique (hôtel plein).

-- Chiffres d'affaire = somme de ce qui a été vendu
-- somme(en fonction de l'hôtel)somme(en fonction de la chambre)
-- du(prix de la chambre (hors services) + somme(prix des services de l'hôtel))
-- pour une journée

-- étape 1 : sommes des prix de tous les services pour chaque hôtel
CREATE VIEW prix_services AS
SELECT pro_hotel `pser_hotel`, SUM(pro_prix) `pser_total`
FROM proposer
GROUP BY pro_hotel;
-- étape 2 : on sélectionne les identifiants de chambres distinctes
CREATE VIEW liste_chambres AS
SELECT DISTINCT(res_chambre) `lcha_id`, cha_chcategorie `lcha_categorie`, res_hotel `lcha_hotel`
FROM reservation, chambre
WHERE res_chambre = cha_id;
-- étape 3 : somme des prix de toutes les chambres pour chaque hôtel
CREATE VIEW prix_chambres AS
SELECT hot_id `pcha_hotel`, SUM(tar_prix) `pcha_total`, COUNT(lcha_id) `pcha_nbchambres`
FROM liste_chambres, hotel, tarifer
WHERE lcha_hotel = hot_id
AND lcha_categorie = tar_chcategorie
AND hot_hocategorie = tar_hocategorie
GROUP BY hot_id;

-- on somme les prix des services * nombre de chambres + le prix total des chambres POUR tous les hôtels
-- étape 4 : faire la somme des prix des chambres + prix des services d'un hôtel
SELECT hot_id, SUM(pser_total * pcha_nbchambres +  pcha_total) `cha_journalier`
FROM hotel, prix_chambres, prix_services
WHERE hot_id = pcha_hotel
AND hot_id = pser_hotel
-- GROUP BY hot_id
