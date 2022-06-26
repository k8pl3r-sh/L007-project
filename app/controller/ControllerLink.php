<!-- ----- debut ControllerLink -->
<?php
require_once '../model/ModelLink.php';
require_once 'Controller.php';
require_once 'ControllerFamily.php';
require_once '../model/Formulaire.php';

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
        $les_personnes = ModelIndiv::getAllIndivFromFamily(ControllerFamily::getSelectedFamily());

        // la vue va enlever les parents sans le sexe
        $les_parents = ModelIndiv::getAllIndivFromFamily(ControllerFamily::getSelectedFamily());

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

    public static function addUnionLink()
    {
        $les_personnes_h = ModelIndiv::getAllIndivFromFamily(ControllerFamily::getSelectedFamily(), true, "and i.sexe='H'");
        $les_personnes_f = ModelIndiv::getAllIndivFromFamily(ControllerFamily::getSelectedFamily(), true, "and i.sexe='F'");
        $type_union = ModelLink::getAllTypesUnion();

        $form = new Formulaire('addUnionLink', 'post');
        $form->addSelectIndividuForm("Sélectionnez un homme", "homme", $les_personnes_h, true);
        $form->addSelectIndividuForm("Sélectionnez une femme", "femme", $les_personnes_f, true);
        $form->addSimpleSelectForm("Sélectionnez un type d'union", "type_union", $type_union);
        $form->addDateField();
        $form->addTextField("Quel est le lieu ?", "lieu", "Ecrivez ici le lieu");


        ControllerFamily::render_template("viewInsertUnion.php", ControllerLink::$directory,
            array('titre' => "Ajout d'une union",
                'formulaire' => $form->getView(),
            ));
    }


    public static function unionHasBeenCreated()
    {
        extract($_POST);

        return ModelLink::insertUnionLink(ControllerFamily::getSelectedFamily(),
            $homme,
            $femme,
            $type_union,
            $date,
            $lieu
        );
    }

}

?>
<!-- ----- fin ControllerEvent -->