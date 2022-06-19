<!-- ----- début viewInsert -->

<script async>
    function onDropdownFamillyClick(button) {
        dropdown = document.getElementById("dropdown_famille")
        dropdown.classList.toggle("show");
        if (dropdown.classList.contains("show")) {
            document.getElementById("input_famille").value = "";
            document.getElementById("viewOne").style.display = "none";
            btn.type = "submit";

        } else {
            document.getElementById("viewOne").style.display = "";
            btn.type = "button"
        }

    }

    function dropDownItemClick(valeur) {
        document.getElementById("input_famille").value = valeur;
        document.getElementById("dropdown_famille").value = "Famille choisie: " + valeur;
        filterFunction()
    }

    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("input_famille");
        filter = input.value.toUpperCase();
        div = document.getElementById("dropdown_famille");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
</script>

<main class="container">

    <h2 class="py-5">Veuillez choisir la famille qui vous intéresse</h2>
    <form role="form" method='POST' action='router1.php?action=selectFamily'>

        <div class="form-group">
            <input type="hidden" name='action' value='addFamily'>
            <div class="dropdown">
                <button type="button" onclick="onDropdownFamillyClick(this)" class="btn btn-outline-primary">Rechercher
                    une famille
                </button>
                <div id="dropdown_famille" class="dropdown-menu">
                    <input class="form-control" type="search" placeholder="Recherchez.." name="famille"
                           id="input_famille"
                           onkeyup="filterFunction()">
                    <?php
                    {
                        if (!empty($object_list))
                            foreach ($object_list as $obj)
                                echo "<a type='submit' class='dropdown-item' onclick='dropDownItemClick(\"" . $obj->getName() . "\")' value=" . $obj->getId() . ">" . $obj->getName() . "</a>";
                    }

                    ?>
                </div>
            </div>
        </div>
        <p/>
        <button class="btn btn-primary" type="submit">Valider</button>
    </form>
    <p/>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $famille_selectionne = ModelFamily::fromName($_POST["famille"]);
        $element = $famille_selectionne;

        $vue = $root . '/app/view/famille/viewOne.php';
        require($vue);
    }
    ?>
</main>

<!-- ----- fin viewInsert -->

