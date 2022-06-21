<!-- ----- début viewInserted -->

<main class="container">
    <?php
    if (isset($_POST["individu"])) {
        $nv_event = ControllerEvent::eventHasBeenCreated();
        if (isset($nv_event)) { //todo faire des meilleures vérifications
            $array = $nv_event;
            require_once $root . "/app/view/viewTable.php";
        } else {
            echo "<h3>L'évènement existe déjà</h3>";
        }


    } else
        echo("<h3>Problème lors de la création de l'évènement</h3>");


    ?>


    <?php


    ?>
</main>

<!-- ----- fin viewInserted -->


