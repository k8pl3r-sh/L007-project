
<!-- ----- debut ControllerLink -->
<?php
require_once '../model/ModelIndiv.php';
require_once 'Controller.php';

class ControllerIndiv extends Controller
{

    // --- Liste des Familles
    public static function listIndiv()
    {
        $results = ModelIndiv::listIndiv();
        LibGlobale::print_html_table($results, "Tous les individus");
    }

}

?>
<!-- ----- fin ControllerEvent -->