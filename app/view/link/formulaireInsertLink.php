<!-- ----- début fragmentFormulaireInsertEvent -->

<main class="container">
    <form role="form" method='post' action='router1.php?action=addParentLink'>
        <div class="form-group row">
            <label for="individu" class="col-4 col-form-label">Sélectionnez l'enfant</label>
            <div class="col-8">
                <select id="individu" name="individu" required="required" class="custom-select">
                    <?php
                    // permet de selectionner le 1er élement de la liste comme choisi par défaut
                    $a = true;

                    foreach ($les_personnes as $personne) {
                        $nom = $personne["nom"];
                        $prenom = $personne["prenom"];
                        if ($a) {
                            echo "<option selected value='" . $nom . $prenom . "'>" . $nom . " " . $prenom . "</option>";
                            $a = false;
                        } else
                            echo "<option value='" . $nom . $prenom . "'>" . $nom . " " . $prenom . "</option>";
                    }
                    ?>

                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="parent" class="col-4 col-form-label">Sélectionnez le parent</label>
            <div class="col-8">
                <select id="parent" name="parent" required="required" class="custom-select">
                    <?php

                    foreach ($les_personnes as $personne) {
                        $nom = $personne["nom"];
                        $prenom = $personne["prenom"];
                        // permet de selectionner le 2eme élement de la liste comme choisi par défaut
                        if ($a) {
                            echo "<option selected value='" . $nom . $prenom . "'>" . $nom . " " . $prenom . "</option>";
                        } else {
                            echo "<option " . $a ? 'selected=selected' : '' . " value='" . $nom . $prenom . "'>" . $nom . " " . $prenom . "</option>";
                            $a = true;
                        }
                    }
                    unset($a);
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
                <button name="submit" type="submit" class="btn btn-primary">Valider</button>
            </div>
        </div>
    </form>
    <p/>
</main>

<script async type="text/javascript">

    // empêche de sélectionner la même personne et pour le parent et l'enfant
    $(document).ready(function () {
        $('select').on('change', function (event) {
            var prevValue = $(this).data('previous');
            $('select').not(this).find('option[value="' + prevValue + '"]').show();
            var value = $(this).val();
            $(this).data('previous', value);
            $('select').not(this).find('option[value="' + value + '"]').hide();
        });
    });


</script>

<!-- ----- fin fragmentFormulaireInsertEvent -->