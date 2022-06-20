<!-- ----- debut ControllerEvent -->
<?php
require_once '../model/ModelEvent.php';
require_once '../model/ModelIndiv.php';
require_once 'Controller.php';
require_once 'ControllerFamily.php';

class ControllerEvent extends Controller
{

    public static $directory = "/app/view/event";


    // --- Liste des Familles
    public static function listEvent()
    {
        $results = ModelEvent::listEventFamille(ControllerFamily::getSelectedFamily());
        // ----- Construction chemin de la vue


        LibGlobale::print_html_table($results,
            "Tous les évènements de la famille sélectionnée",
        );

    }


    public static function eventCreate()
    { // Affiche la vue du formulaire

        $les_evenements = ModelEvent::getAllEventTypes();
        $les_personnes = ModelIndiv::getAllIndivFromFamily(ControllerFamily::getSelectedFamily());

        ControllerFamily::render_template("viewInsert.php", ControllerEvent::$directory,
            array('titre' => "Ajout d'une famille",
                "les_evenements" => $les_evenements,
                "les_personnes" => $les_personnes
            ));
    }

    public static function eventHasBeenCreated()
    {
        require 'config.php';

        $date = $_POST["date"];
        $evenement = $_POST["evenement"];
        $individu = $_POST["individu"];
        $lieu = $_POST["lieu"];
        $famille_id = ControllerFamily::getSelectedFamily();

        return ModelEvent::addEvent($famille_id, $individu, $evenement, $date, $lieu);
    }

}

?>
<!-- ----- fin ControllerEvent -->