<!-- ----- debut viewFamilleSelectionnee -->

<div class="jumbotron">

    <?php

    if (isset($famille_selectionne))
        $_SESSION["famille_selectionne"] = $famille_selectionne->getName();

    if (isset($_SESSION["famille_selectionne"])) {
        $famille_selectionne = ModelFamily::fromName($_SESSION["famille_selectionne"]);
        echo '<h1 class="display-4">Famille sélectionnée: <b id="nom_famille">' . $famille_selectionne->getName() . '</b> </h1>';
    } else
        echo '<h1 class="display-4">Pas de famille sélectionnée </h1>';

    ?>

</div>
<p/>


<!-- ----- fin viewFamilleSelectionnee -->