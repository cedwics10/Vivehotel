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
     */
    public function a_index()
    {
        require $this->gabarit;
    }

    /**
     * a_statistiques
     *
     * @return void Lance la page de statistiques globale des hôtels
     */
    public function a_statistiques()
    {
        $hotel = new Hotel();
        $stats = [
            'nbHotels' => $hotel->countAll(),
            'CA' => $hotel->chiffreAffTot()
        ];

        require $this->gabarit;
    }
}
