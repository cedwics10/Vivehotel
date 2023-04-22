<?php
//class mère des controleurs secondaires
class Ctr_controleur
{
    protected string $module;
    protected string $action;
    protected string $gabarit;
    protected string $vue;

    /**
     * __construct
     *
     * @param  mixed $module nom du contrôleur actionné
     * @param  mixed $action action qui va être lancé à partir du contrôleur
     * @param  mixed $gabarit lien de la page de gabarit qui va charger la vue
     * @return void la classe mère n'a qu'un simple contrôleur de définition de variables
     */
    public function __construct(string $module, string $action, string $gabarit = "gabarit.php")
    {
        $this->module = $module;
        $this->action = $action;
        $this->gabarit = "../application/gabarit/$gabarit";
        $this->vue = "../application/module/{$module}/vue_{$module}_{$action}.php";
    }
}
