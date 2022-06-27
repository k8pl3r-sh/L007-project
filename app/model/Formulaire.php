<?php

class Formulaire
{
    private $html_form;

    public function __construct($action, $method = 'post')
    {
        $this->init($action, $method);
    }

    private function init($action, $method)
    {
        $this->html_form = <<<EOF
            <form role="form" method='$method' action='router1.php?action=$action'>
EOF;
    }


    public function addSelectIndividuForm($label, $name, $values, $is_filtered = true)
    {
        return self::addSelectForm($label, $name, $values, $is_filtered,
            function ($individu) {
                return $individu["id"];
            },
            function ($individu) {
                return $individu["nom"] . " " . $individu["prenom"];
            }
        );
    }

    /**
     * @param $name
     * @param $values
     * @param bool $is_filtered indique si on pourra filtrer les valeurs pour une recherche
     * @param $callback_values une fonction qui permet de créer un id aux valeurs du formulaire
     * @param $callback_print une fonction qui permet d'afficher l'objet
     * @return void
     */
    private function addSelectForm($label, $name, $values, $is_filtered = false, $callback_values, $callback_print)
    {
        $select_class = $is_filtered ? "custom-select" : "selectpicker";
        $this->html_form .= "    <div class=\"form-group row\">
        <label for=\"$name\" class=\"col-4 col-form-label\">$label</label>
        <div class=\"col-8\">
        <select id=\"$name\" name=\"$name\" required=\"required\" class=\"$select_class\">";
        if ($callback_values != null && is_callable($callback_values))
            if ($callback_print != null && is_callable($callback_print))
                foreach ($values as $value)
                    $this->html_form .= sprintf("<option value='%s'>%s</option>", $callback_values($value), $callback_print($value));

        $this->html_form .= "</select></div></div>";
    }

    public function addSimpleSelectForm($label, $name, $values, $is_filtered = false)
    {
        return $this->addSelectForm($label, $name, $values, $is_filtered,
            function ($item) {
                return $item;
            },
            function ($item) {
                return $item;
            }
        );
    }

    /**
     * @param $label
     * @param $name
     * @param $placeholder
     * @return void
     */
    public function addTextField($label, $name, $placeholder, $with_icon = false)
    {
        $icon_field = $with_icon
            ? '<div class="input-group-prepend">
                    <div class="input-group-text">
                         <i class="fa fa-building"></i>
                    </div>
                </div>'
            : "";
        $this->html_form .= <<<EOF
           <div class="form-group row">
            <label class="col-4 col-form-label" for="$name">$label</label>
            <div class="col-8">
                <div class="input-group">
                    $icon_field
                    <input id="$name" name="$name" placeholder="$placeholder" type="text"
                           class="form-control" required="required">
                </div>
            </div>
        </div>
EOF;

    }

    public function getView()
    {
        return $this->html_form . $this->getSubmitButton() . "</form>";
    }


    private function getSubmitButton()
    {
        return <<<EOF
                <div class="form-group row">
                    <div class="offset-4 col-8">
                        <button name="submit" type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </div>
EOF;
    }

    /**
     * On part du principe qu'on en a un seul par formulaire
     * @return void
     */
    public function addDateField()
    {
        $this->html_form .= '<div class="form-group row">
                    <label for="date" class="col-4 col-form-label">Date</label>
                    <div class="col-8">
                        <input type="date" id="date" name="date" placeholder="Choisir la date" type="text" class="form-control">
                    </div>
                </div>';
    }


}