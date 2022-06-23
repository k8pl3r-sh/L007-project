<!-- ----- debut ControllerLink -->
<?php
require_once '../model/ModelIndiv.php';
require_once 'Controller.php';
require_once 'ControllerFamily.php';

class ControllerIndiv extends Controller
{

    public static $directory = "/app/view/indiv";

    // --- Liste des individus
    public static function listIndiv()
    {
        $results = ModelIndiv::getAllIndivFromFamily(ControllerFamily::getSelectedFamily(), false);
        LibGlobale::print_html_table($results, "Tous les individus");
    }

    public static function selectIndiv($args)
    {
        extract($args);

        if (isset($individu_id)) {
            $famille_id = ControllerFamily::getSelectedFamily();
            $personne = ModelIndiv::fromId($individu_id, $famille_id);
            $personne_id = $personne["id"];
            // chopper infos de vie et mort
            $life_data = ModelEvent::listNaissanceMortIndividu($personne_id, $famille_id);
            $parents = array(
                "pere" => ModelIndiv::fromId($personne["pere"], $famille_id),
                "mere" => ModelIndiv::fromId($personne["mere"], $famille_id)
            );
            $unions = ModelLink::listLinkOfIndividu($personne_id, $famille_id);
            // lister les unions avec éventuels résidus
            ControllerFamily::render_template("viewOne.php", ControllerIndiv::$directory,
                array('titre' => "Présentation de <b>" . $personne['nom'] . " " . $personne['prenom'] . "</b>",
                    'personne' => $personne,
                    'life_data' => $life_data,
                    'parents' => $parents,
                    'unions' => $unions
                ));
        } else
            ControllerFamily::render_template("viewSelect.php", ControllerIndiv::$directory,
                array('titre' => "Sélection de l'individu à afficher",
                    'object_list' => ModelIndiv::getAllIndivFromFamily(ControllerFamily::getSelectedFamily())
                ));

    }

}

?>
<!-- ----- fin ControllerEvent -->