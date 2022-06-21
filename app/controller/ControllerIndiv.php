
<!-- ----- debut ControllerLink -->
<?php
require_once '../model/ModelIndiv.php';
require_once 'Controller.php';
require_once 'ControllerFamily.php';

class ControllerIndiv extends Controller
{

    // --- Liste des Familles
    public static function listIndiv()
    {
        $results = ModelIndiv::getAllIndivFromFamily(ControllerFamily::getSelectedFamily());
        LibGlobale::print_html_table($results, "Tous les individus");
    }

}

?>
<!-- ----- fin ControllerEvent -->