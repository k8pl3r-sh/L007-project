<!-- ----- debut viewFamilleSelectionnee -->

<div class="jumbotron">

    <?php

    if (isset($famille_selectionne))
        echo '<h1 class="display-4">Famille sélectionnée: '.$famille_selectionne->getName().' </h1>';
    else
        echo '<h1 class="display-4">Pas de famille sélectionnée </h1>';

    ?>

</div>
<p/>


<!-- ----- fin viewFamilleSelectionnee -->