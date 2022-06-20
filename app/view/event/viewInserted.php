<!-- ----- début viewInserted -->

<main class="container">
    <?php
    if (isset($_POST["individu"])) {
        $nv_event = ControllerEvent::eventHasBeenCreated();
        if (isset($nv_event)) {
            $array = $nv_event;
            require_once $root . "/app/view/viewTable.php";
        } else {
            echo "<h3>La famille <b>" . $_POST['nom'] . "</b> existe déjà</h3>";
        }


    } else
        echo("<h3>Problème lors de la création de la famille</h3>");


    ?>


    <?php


    ?>
</main>

<!-- ----- fin viewInserted -->


