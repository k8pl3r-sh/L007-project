<!-- ----- début fragmentFormulaireInsertEvent -->

<main class="container">
    <form role="form" method='post' action='router1.php?action=eventCreate'>
        <div class="form-group row">
            <label for="individu" class="col-4 col-form-label">Sélectionner un individu</label>
            <div class="col-8">
                <select id="individu" name="individu" required="required" class="custom-select">
                    <?php
                    foreach ($les_personnes as $personne) {
                        $nom = $personne["nom"];
                        $prenom = $personne["prenom"];
                        $id = $personne["id"];
                        echo "<option value='" . $id . "'>" . $nom . " " . $prenom . "</option>";
                    }
                    ?>

                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="evenement" class="col-4 col-form-label">Type d'évènement</label>
            <div class="col-8">
                <select id="evenement" name="evenement" required="required" class="custom-select">
                    <?php
                    foreach ($les_evenements as $evenement)
                        echo "<option value='" . $evenement["event_type"] . "'>" . $evenement["event_type"] . "</option>"
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="date" class="col-4 col-form-label">Date</label>
            <div class="col-8">
                <input type="date" id="date" name="date" placeholder="Choisir la date" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4 col-form-label" for="lieu">Lieu</label>
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-building"></i>
                        </div>
                    </div>
                    <input id="lieu" name="lieu" placeholder="Veuillez indiquer la ville de l'évènement" type="text"
                           class="form-control" required="required">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <p/>
</main>

<script async type="text/javascript">

    function forceKeyPressUppercase(e) {
        var charInput = e.keyCode;
        if ((charInput >= 97) && (charInput <= 122)) { // lowercase
            if (!e.ctrlKey && !e.metaKey && !e.altKey) { // no modifier key
                var newChar = charInput - 32;
                var start = e.target.selectionStart;
                var end = e.target.selectionEnd;
                e.target.value = e.target.value.substring(0, start) + String.fromCharCode(newChar) + e.target.value.substring(end);
                e.target.setSelectionRange(start + 1, start + 1);
                e.preventDefault();
            }
        }
    }

    document.getElementById("input_nom_famille").addEventListener("keypress", forceKeyPressUppercase, false);


</script>

<!-- ----- fin fragmentFormulaireInsertEvent -->