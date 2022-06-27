<!-- ----- début viewInserted -->

<main class="container">
    <?php
    if (isset($_POST["nom"])) {
        $nv_membre = ControllerFamily::familyHasBeenCreated();
        if (isset($nv_membre)) {
            $array = $nv_membre;
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


