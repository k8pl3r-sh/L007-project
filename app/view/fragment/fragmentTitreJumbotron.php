<!-- ----- debut fragmentTitreJumbotron -->
<div class="jumbotron text-center">
    <?php

    if (isset($titre))
        echo '<h1 class="display-4">' . $titre . ' </h1>';
    else
        echo '<h1 class="display-4">Page indéterminée</h1>';
    ?>

    <!-- ----- debut viewFamilleSelectionnee -->

    <hr class="my-4">
    <?php

    if (isset($_SESSION["id_famille_selectionnee"])) {
        $famille_selectionne = ModelFamily::fromId($_SESSION["id_famille_selectionnee"]);
        echo '<p class="lead">Famille sélectionnée: <b id="nom_famille">' . $famille_selectionne["nom"] . '</b> </p>';
    } else
        echo '<p class="lead">Pas de famille sélectionnée </p>';

    ?>


    <!-- ----- fin viewFamilleSelectionnee -->

</div>

<!-- ----- fin fragmentTitreJumbotron -->