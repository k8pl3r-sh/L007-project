<!-- ----- debut ControllerEvent -->
<?php

require_once "Controller.php";
require_once "../model/ModelFamily.php";

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

        $famille = ModelFamily::fromName(($_POST["nom"]));
        if (!empty($famille)) {
            return null;
        }

        $nv_famille = ModelFamily::addFamily($_POST["nom"]);
        self::setSelectedFamily($nv_famille[0]['id']);
        return $nv_famille;

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

    private static function setSelectedFamily($id)
    {
        $_SESSION["id_famille_selectionnee"] = $id;
    }

    public static function getSelectedFamily()
    {
        return isset($_SESSION["id_famille_selectionnee"]) ? $_SESSION["id_famille_selectionnee"] : null;
    }


}

?>
<!-- ----- fin ControllerFamily -->


