<!-- ----- début viewInserted -->

<main class="container">
    <?php
    if (isset($_POST["individu"])) {
        $link = ControllerLink::parentHasBeenCreated();
        if (isset($link)) {
            $array = array($link);
            //todo dire s'il on a ajouté père ou mère
            require_once $root . "/app/view/viewTable.php";
        } else {
            echo "<h3>Le lien existe déjà</h3>";
        }


    } else
        echo("<h3>Problème lors de la création du lien</h3>");


    ?>


    <?php


    ?>
</main>

<!-- ----- fin viewInserted -->


