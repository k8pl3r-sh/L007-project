<!-- ----- début viewInsert -->


<main class="container">

    <?php if ($_SERVER["REQUEST_METHOD"] === "GET") {
        echo <<<EOF
         <h2 class="py-5">Veuillez choisir l'individu qui vous intéresse</h2>
            <form role="form" method='POST'  action='router1.php?action=selectIndiv' >
                <input name='famille_id' type="hidden" value="{$famille_id}">
                <select name="individu_id" data-live-search="true" class="selectpicker col-lg-12 text-center" >
EOF;
        if (!empty($object_list)) {
            foreach ($object_list as $obj)
                echo "<option value=" . $obj["id"] . ">" . $obj['nom'] . " " . $obj["prenom"] . "</option>";
        }

        echo '  </select>
                <button class="btn btn-primary btn-block" type="submit">Valider</button>
                </form>';
    } ?>

</main>
<!-- ----- fin viewInsert -->

