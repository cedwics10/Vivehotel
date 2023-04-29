<?php
class Ctr_gestionnaire extends Ctr_controleur
{

    /**
     * __construct
     *
     * @param string $action nom de l'action appelé dans le constructeur
     * @return void Lance l'action a_$action en tant que page web
     */
    public function __construct($action)
    {
        parent::__construct("gestionnaire", $action);
        $a = "a_$action";
        $this->$a();
    }

    /**
     * a_hotel
     *
     * @return void Liste les réservation d'un hôtel spécifique
     */
    function a_hotel()
    {
        checkAuth('gestionnaire');

        $h = new Hotel();
        $hotData = $h->select($_SESSION['per_hotel']);
        extract($hotData);

        $u = new Reservation();
        $data = $u->resHotel($_SESSION['per_hotel']);
        require $this->gabarit;
    }
}
