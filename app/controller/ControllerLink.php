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
        // todo uniquement pour les personnes n'ayant pas de parents déclarés ?
        //todo enlever les parents sans sexe
        $les_personnes = ModelIndiv::getAllIndivFromFamily(ControllerFamily::getSelectedFamily());

        ControllerFamily::render_template("viewInsert.php", ControllerLink::$directory,
            array('titre' => "Ajout d'une famille",
                "les_personnes" => $les_personnes
            ));
    }

    public static function parentHasBeenCreated()
    {
        require 'config.php';

        $parent = $_POST["parent"];
        $individu = $_POST["individu"];
        $famille_id = ControllerFamily::getSelectedFamily();
        //todo debug fromName
        $iid = ModelIndiv::fromName($famille_id, $individu)["id"];
        $pid = ModelIndiv::fromName($famille_id, $parent)["id"];

        return ModelLink::insertParentLink($famille_id, $iid, $pid);

    }

}

?>
<!-- ----- fin ControllerEvent -->