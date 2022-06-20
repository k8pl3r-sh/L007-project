<!-- ----- debut viewFamilleSelectionnee -->

<section class="jumbotron text-center">

    <?php

    if (isset($famille_selectionne))
        $_SESSION["nom_famille_selectionne"] = $famille_selectionne->getName();

    if (isset($_SESSION["nom_famille_selectionne"])) {
        $famille_selectionne = ModelFamily::fromName($_SESSION["nom_famille_selectionne"]);
        echo '<p class="lead">Famille sélectionnée: <b id="nom_famille">' . $famille_selectionne->getName() . '</b> </p>';
    } else
        echo '<p class="lead">Pas de famille sélectionnée </p>';

    ?>

</section>


<!-- ----- fin viewFamilleSelectionnee -->