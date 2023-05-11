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
    public function a_chambre_dispo()
    {
        if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
            header('Location: ' . hlien('_default', 'hotel'));
            exit();
        }

        $h = new Hotel();
        $dataHotel = $h->select($_GET['id']);

        if (count($dataHotel) == 0) {
            $_SESSION['message'][] = 'Cet hôtel n\'existe pas';
            header('Location: ' . hlien('_default', 'hotel'));
            exit();
        }

        if (
            isset($_POST['date_debut'])
            and isset($_POST['date_fin'])
        ) {
            $r = new Reservation();

            $nombreChambreDispo = $r->chambresDisposDates(
                $_GET['id'],
                $_POST['date_debut'],
                $_POST['date_fin']
            );
        }

        if (isset($nombreChambreDispo) and $nombreChambreDispo > 0) {
            $dateDebut = str_replace('-', '', $_POST['date_debut']);
            $dateFin = str_replace('-', '', $_POST['date_fin']);
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

    public function a_calendrier()
    {
        if (
            !isset($_GET['mo'])
            or !isset($_GET['an'])
            or !is_numeric($_GET['mo'])
            or !is_numeric($_GET['an'])
        ) {
            exit();
        }

        echo calendrierHTML($_GET['mo'], $_GET['an']);
    }


    /**
     * a_edit
     *
     * @return void Page de réservation d'une chambre
     */
    function a_reserver_chambre()
    {
        checkAllow(['admin', 'gestionnaire']);

        if (!isset($_GET['hotel']) or !is_numeric($_GET['hotel'])) {
            $_SESSION['message'][] = 'Lien invalide';
            header('Location: ' . hlien('_default', 'index'));
            exit();
        }

        $u = new Chambre();
        $row = $u->select($_GET['hotel']);
        if (count($row) == 0) {
            $_SESSION['message'][] = 'Lien invalide';
            header('Location: ' . hlien('_default', 'index'));
            exit();
        }
        extract($row);

        require $this->gabarit;
    }

    function a_payer_chambre()
    {

        require $this->gabarit;
    }
}
