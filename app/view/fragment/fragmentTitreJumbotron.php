<!-- ----- debut fragmentTitreJumbotron -->
<div class="jumbotron text-center">
    <?php

    if (isset($titre))
        echo '<h1 class="display-4">' . $titre . ' </h1>';
    else
        echo '<h1 class="display-4">Page indéterminée</h1>';
    ?>

</div>

<!-- ----- fin fragmentTitreJumbotron -->