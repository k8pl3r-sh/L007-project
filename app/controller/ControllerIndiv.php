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
        if (isset($args['individu_id'])) {
            $individu_id = $args["individu_id"];
            $famille_id = $args["famille_id"];

            $personne = ModelIndiv::fromId($individu_id, $famille_id);
            // chopper infos de vie et mort
            $life_data = ModelEvent::listNaissanceMortIndividu($individu_id, $famille_id);
            $parents = array(
                "pere" => ModelIndiv::fromId($personne["pere"], $famille_id),
                "mere" => ModelIndiv::fromId($personne["mere"], $famille_id)
            );
            $unions = ModelLink::listLinkOfIndividu($individu_id, $famille_id);
            $les_enfants = ModelIndiv::ListEnfantDUnion($individu_id, $unions);
            // lister les unions avec éventuels résidus
            ControllerFamily::render_template("viewOne.php", ControllerIndiv::$directory,
                array('titre' => "Présentation de <b>" . $personne['nom'] . " " . $personne['prenom'] . "</b>",
                    'personne' => $personne,
                    'life_data' => $life_data,
                    'parents' => $parents,
                    'unions' => $unions,
                    'les_enfants' => $les_enfants
                ));
        } else
            ControllerFamily::render_template("viewSelect.php", ControllerIndiv::$directory,
                array('titre' => "Sélection de l'individu à afficher",
                    'object_list' => ModelIndiv::getAllIndivFromFamily(ControllerFamily::getSelectedFamily()),
                    'famille_id' => ControllerFamily::getSelectedFamily()
                ));

    }

}

?>
<!-- ----- fin ControllerEvent -->