<!-- ----- debut ControllerEvent -->
<?php

require_once "Controller.php";

class ControllerFamily extends Controller
{

    public static $directory = "/app/view/famille";


    // --- Liste des Familles

    public static function familyCreate()
    {
        // Affiche la vue du formulaire

        ControllerFamily::render_template("viewInsert.php", ControllerFamily::$directory,
            array('titre' => "Ajout d'une famille",
            ));
    }

    public static function familyHasBeenCreated()
    {
        require 'config.php';

        if (ModelFamily::fromName(($_POST["nom"])) !== null)
            return null;

        self::setSelectedFamily($_POST["nom"]);
        return ModelFamily::addFamily($_POST["nom"]);

    }

    private static function setSelectedFamily($id)
    {
        $_SESSION["id_famille_selectionnee"] = $id;
    }

    public static function debug()
    {
        // ----- Construction chemin de la vue
        include 'config.php';
        echo("DEBUG");
    }

    public static function selectFamily()
    {
        // sélection d'une famille

        ControllerFamily::render_template("viewSelect.php", ControllerFamily::$directory,
            array('titre' => "Sélection d'une famille",
                "object_list" => ModelFamily::array_map_famille(ModelFamily::listFamily())));

    }

    public static function listFamily()
    {
        $results = ModelFamily::listFamily();
        LibGlobale::print_html_table($results, "Toutes les familles");

    }

    public static function familySelected()
    {
        self::setSelectedFamily($_POST["famille"]);
        $element = ModelFamily::fromId($_POST["famille"]);
        Controller::render_template("viewOne.php", ControllerFamily::$directory,
            array('titre' => "Famille choisie",
                "object_list" => ModelFamily::array_map_famille(ModelFamily::listFamily()),
                "element" => $element
            ));
    }

    public static function getSelectedFamily()
    {
        return isset($_SESSION["id_famille_selectionnee"]) ? $_SESSION["id_famille_selectionnee"] : null;
    }


}

?>
<!-- ----- fin ControllerFamily -->


