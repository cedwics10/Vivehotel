<?php
class Recherche
{
    /**
     * inputs
     *
     * @var array
     */
    protected array $inputs = [];
    protected array $names = [];
    protected string $action = '';
    protected string $method = '';

    /**
     * fields
     *
     * @var array
     */
    protected $fields = [];

    /**
     * creerFormulaire
     *
     * @param  mixed $action
     * @param  mixed $method
     * @return void
     */
    public function creerFormulaire(string $action, string $method)
    {
        $this->action = $action;
        $this->method = $method;
    }

    /**
     * ajouterInputText
     *
     * @return void
     */
    public function ajouterInputText(
        string $strName,
        string $strLabel,
        string $strValue
    ) {
        $this->inputs[] = [
            'name' => $strName,
            'label' => $strLabel,
            'type' => 'text',
            'value' => $strValue
        ];
        $this->names[$strLabel] = '';
    }



    /**
     * ajouterInputGroup
     *
     * @param  mixed $strName
     * @param  mixed $arrayLabel
     * @param  mixed $arrayValue
     * @param  mixed $type
     * @return void
     */
    public function ajouterInputGroup(
        string $strName,
        array $arrayLabel,
        array $arrayValue,
        string $type = 'checkbox'
    ) {
        if (count($arrayLabel) != count($arrayValue))
            trigger_error("Il n'y a pas autant de label que de valeurs dans la liste des checkboxs à ajouter.", E_USER_ERROR);

        $idValue = 0;
        foreach ($arrayLabel as $label) {
            $this->inputs[] = [
                'name' => $strName,
                'label' => $label,
                'type' => 'checkbox',
                'value' => $arrayValue[$idValue],
            ];
            $idValue++;
        }

        $this->names[$strName] = '';
    }



    /**
     * ajouterCheckboxes
     *
     * @param  mixed $strName
     * @param  mixed $arrayLabel
     * @param  mixed $arrayValue
     * @return void
     */
    public function ajouterCheckboxes(string $strName, array $arrayLabel, array $arrayValue)
    {
        return $this->ajouterInputGroup(
            $strName,
            $arrayLabel,
            $arrayValue,
            'checkbox'
        );
    }

    /**
     * ajouterRadios
     *
     * @param  mixed $strName
     * @param  mixed $arrayLabel
     * @param  mixed $arrayValue
     * @return void
     */
    public function ajouterRadios(string $strName, array $arrayLabel, array $arrayValue)
    {
        return $this->ajouterInputGroup(
            $strName,
            $arrayLabel,
            $arrayValue,
            'radio'
        );
    }

    /**
     * returnSqlFields
     * Morceau de requête SQL à insérer dans une recherche pour que le 
     * formulaire renvoie des réponses personnalitées
     * @return array Ensemble des champs SQL que l'utilsiateur devait saisir
     */
    public function returnSqlFields(): array
    {
        return array_intersect_key($_POST, $this->inputs);
    }


    private function generateText()
    {
    }

    /**
     * htmlForm
     *
     * @return void
     */
    public function htmlForm()
    {
        $text = '';
        foreach ($this->inputs as $input) {
            $function = 'generate' . ucfirst($input['type']);
            $function();
        }
    }
}
