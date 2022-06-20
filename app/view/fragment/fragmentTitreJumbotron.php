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

    if (isset($_SESSION["nom_famille_selectionne"])) {
        $famille_selectionne = ModelFamily::fromName($_SESSION["nom_famille_selectionne"]);
        echo '<p class="lead">Famille sélectionnée: <b id="nom_famille">' . $famille_selectionne->getName() . '</b> </p>';
    } else
        echo '<p class="lead">Pas de famille sélectionnée </p>';

    ?>


    <!-- ----- fin viewFamilleSelectionnee -->

</div>

<!-- ----- fin fragmentTitreJumbotron -->