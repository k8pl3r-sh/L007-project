<!-- ----- debut ControllerLink -->
<?php
require_once '../model/ModelLink.php';
require_once 'Controller.php';
require_once 'ControllerFamily.php';

class ControllerLink extends Controller
{

    // --- Liste des Familles
    public static function listLink()
    {
        $results = ModelLink::listLinkOfFamily(ControllerFamily::getSelectedFamily());
        LibGlobale::print_html_table($results, "Tous les liens de la famille sélectionnée");
    }

}

?>
<!-- ----- fin ControllerEvent -->