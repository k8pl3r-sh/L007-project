<!-- ----- debut ControllerEvent -->
<?php

require_once "Controller.php";

class ControllerFamily extends Controller
{

    public static $directory = "/app/view/famille";


    // --- Liste des Familles
    public static function listFamily()
    {
        $results = ModelFamily::listFamily();
        // ----- Construction chemin de la vue
        LibGlobale::print_html_table($results, "Toutes les familles");
//        ControllerFamily::render_template("viewAll.php", ControllerFamily::$directory,
//            array('results' => $results, 'titre' => "Toutes les familles"));
    }


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

        ModelFamily::addFamily($_POST["nom"]);

        $nouveau = ModelFamily::fromName($_POST["nom"]);
    }

    public static function debug()
    {
        // ----- Construction chemin de la vue
        include 'config.php';
        echo("DEBUG");
    }

//    public static function addFamily()
//    {
//        // ----- Construction chemin de la vue
//        echo "allo";
//        ControllerFamily::render_template("viewInserted.php", ControllerFamily::$directory,
//            array('titre' => "Ajout d'une famille",
//                'results' => ModelFamily::addFamily(htmlspecialchars($_GET['nom']))
//
//            ));
//    }

    public static function selectFamily()
    {
        // sélection d'une famille

        ControllerFamily::render_template("viewSelect.php", ControllerFamily::$directory,
            array('titre' => "Sélection d'une famille",
                "object_list" => ModelFamily::array_map_famille(ModelFamily::listFamily()))
        );

        if (isset($_GET["nom"])) {
            $results = ModelFamily::selectFamily(
                htmlspecialchars($_GET['nom']));
            $_SESSION["nom"] = $_GET['nom'];
        }
    }


}

?>
<!-- ----- fin ControllerFamily -->


