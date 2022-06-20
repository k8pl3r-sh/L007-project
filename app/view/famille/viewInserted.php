<!-- ----- début viewInserted -->

<main class="container">

    <?php
    if (isset($_POST["nom"])) {
        $nv_membre = ControllerFamily::familyHasBeenCreated();
        if (isset($nv_membre)) {
            $id = $nv_membre->getId();
            $nom = $nv_membre->getName();
            echo(<<<EOF
                <h3>La nouvelle famille a été ajoutée </h3>
                <table class='table table-bordered'>
                    <tr>
                        <th class='bg-info' scope='col'>id</th>
                        <th class='bg-info' scope='col'>nom</th>
                        </tr>
                        <tr>
                        <td>$id </td>
                        <td>$nom</td>
                    </tr>
                </table>
                EOF);
        } else {
            echo "<h3>La famille <b>" . $_POST['nom'] . "</b> existe déjà</h3>";
        }


    } else
        echo("<h3>Problème lors de la création de la famille</h3>");


    ?>
</main>

<!-- ----- fin viewInserted -->

    
    