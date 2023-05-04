<?php
class Ctr__default extends Ctr_controleur
{
    /**
     * __construct
     *
     * @param string $action nom de l'action appelé dans le constructeur
     * @return void Lance l'action a_$action en tant que page web
     */
    public function __construct($action)
    {
        parent::__construct("_default", $action);
        $a = "a_$action";
        $this->$a();
    }


    /**
     * a_index
     *
     * @return void Lance la page d'accueil du site
     * - Formulaire de recherche
     * - Hôtels les plus proches
     */
    public function a_index()
    {
        require $this->gabarit;
    }


    /**
     * a_hotel
     *
     * @return void Lance la page de la liste des hôtels disponible
     * pour un utilisateur connecté
     */
    public function a_hotel()
    {
        $a = new Hotel();
        $data = $a->selectActifs();
        require $this->gabarit;
    }

    /**
     * a_hotel
     *
     * @return void Lance la page qui affiche le calendrier des disponbilités
     * de l'hôel
     * L'utilisateur peut aussi indiquer des critères sur la chambre qu'il cherche
     * La page va déterminer si il est possible pour lui d'obtenir un chambre qui 
     * est OK
     */
    public function a_hotel_chambres()
    {
        if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
            header('Location: ' . hlien('_default', 'hotel'));
            exit();
        }

        $a = new Hotel();
        $data = $a->select($_GET['id']);

        extract($data);

        require $this->gabarit;
    }

    /**
     * a_statistiques
     *
     * @return void Lance la page de statistiques globale des hôtels
     */
    public function a_statistiques()
    {
        checkAuth(['admin', 'teleconseiller', 'gestionnaire']);
        $hotel = new Hotel();
        $stats = [
            'nbHotels' => $hotel->countAll(),
            'CA' => $hotel->chiffreAffTot()
        ];

        require $this->gabarit;
    }
}
