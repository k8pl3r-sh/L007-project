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
        $results = ModelIndiv::getAllIndivFromFamily(ControllerFamily::getSelectedFamily());
        LibGlobale::print_html_table($results, "Tous les individus");
    }

    public static function selectIndiv($args)
    {
        var_dump($args);
        extract($args);

        if (isset($personne_id)) {
            var_dump("test");
            // chopper infos de vie et mort
            $life_data = ModelEvent::listEventIndividu($personne_id, $famille_id);
            $personne = ModelIndiv::fromId($personne_id);
            $parents = array(
                "pere" => ModelIndiv::fromId($personne->getPere()),
                "mere" => ModelIndiv::fromId($personne->getMere())
            );
            $unions = ModelLink::listLinkOfIndividu($personne_id, $famille_id);
            var_dump($life_data, $personne, $parents, $unions);
            // lister les unions avec éventuels résidus
            ControllerFamily::render_template("viewOne.php", ControllerIndiv::$directory,
                array('titre' => "Présentation de <b>" . $personne['nom'] . " " . $personne['prenom'] . "</b>",
                    'personne' => $personne,
                    'life_data' => $life_data,
                    'parents' => $parents,
                    'unions' => $unions
                ));
        }
        ControllerFamily::render_template("viewSelect.php", ControllerIndiv::$directory,
            array('titre' => "Sélection de l'individu à afficher",
                'object_list' => ModelIndiv::getAllIndivFromFamily(ControllerFamily::getSelectedFamily())
            ));


    }

}

?>
<!-- ----- fin ControllerEvent -->