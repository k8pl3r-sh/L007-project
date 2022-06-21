<!-- ----- debut ControllerLink -->
<?php
require_once '../model/ModelLink.php';
require_once 'Controller.php';
require_once 'ControllerFamily.php';

class ControllerLink extends Controller
{
    public static $directory = "/app/view/link";


    // --- Liste des Familles
    public static function listLink()
    {
        $results = ModelLink::listLinkOfFamily(ControllerFamily::getSelectedFamily());
        LibGlobale::print_html_table($results, "Tous les liens de la famille sélectionnée");
    }

    public static function addParentLink()
    {
        $les_personnes = ModelIndiv::getAllIndivFromFamily(ControllerFamily::getSelectedFamily());

        ControllerFamily::render_template("viewInsert.php", ControllerLink::$directory,
            array('titre' => "Ajout d'une famille",
                "les_personnes" => $les_personnes
            ));
    }

    public static function parentHasBeenCreated()
    {
//        require 'config.php';
//
//        if (ModelFamily::fromName(($_POST["nom"])) !== null)
//            return null;
//
//        self::setSelectedFamily($_POST["nom"]);
//        return ModelFamily::addFamily($_POST["nom"]);

    }

}

?>
<!-- ----- fin ControllerEvent -->