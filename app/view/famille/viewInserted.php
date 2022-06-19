<!-- ----- début viewInserted -->

<main class="container">

    <?php
    if (isset($_POST["nom"])) {
        $nom = $_POST['nom'];
        $id = DatabaseConnector::getInstance()->lastInsertID();
        if (isset($id)) {
            if ($id == 0)
                echo "<h3>La famille <b>" . $nom . "</b> existe déjà</h3>";
            else
                echo(<<<EOF
                <h3>La nouvelle famille a été ajoutée </h3>
                <table class='table table-bordered'>
                    <tr>
                        <th class='bg-info' scope='col'>id</th>
                        <th class='bg-info' scope='col'>nom</th>
                                <td>$id </td>
                                <td>$nom</td>
                    </tr>
                </table>
                EOF);
        }

    } else
        echo("<h3>Problème lors de la création de la famille</h3>");


    ?>
</main>

<!-- ----- fin viewInserted -->

    
    