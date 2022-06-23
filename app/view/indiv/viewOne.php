<section class="alert alert-primary">
    <h2>Biologie</h2>
    <?php

    if (isset($life_data["naissance"]))
        echo "<p>Né le <i>" . $life_data['naissance']['date'] . "</i> à <i>" . $life_data['naissance']['lieu'] . "</i></p>";
    else
        echo "<p> Naissance inconnue</p>";

    //    $date = isset($life_data["deces"]) ? $life_data['deces']['date'] : "NC";
    //    $lieu = isset($life_data["deces"]) ? $life_data['deces']['lieu'] : "NC";
    if (isset($life_data["deces"]))
        echo "<p>Mort le <i>" . $life_data['deces']['date'] . "</i> à <i>" . $life_data['deces']['lieu'] . "</i></p>";
    else
        echo "<p> Mort inconnue</p>";
    ?>

</section>
<section class="alert alert-info">
    <h2>Parents</h2>
    <?php
    if (isset($parents['pere']))
        echo '<p>Père: ' . $parents["pere"]["nom"] . ' ' . $parents["pere"]["prenom"] . '</p>';
    if (isset($parents['mere']))
        echo '<p>Père: ' . $parents["mere"]["nom"] . ' ' . $parents["mere"]["prenom"] . '</p>';
    ?>
</section>
<section class="alert alert-secondary">
    <h2>Unions et lien</h2>
    <?php
    if (isset($unions))
        foreach ($unions as $union) {
            $parent_nom = (isset($personne) && $union["iid1"] == $personne["id"]) ? $union["individu2"] : $union["individu1"];
            $parent_id = (isset($personne) && $union["iid1"] == $personne["id"]) ? $union["iid2"] : $union["iid1"];
            echo '<p">Union avec <a href="router1.php?action=selectIndiv&individu_id=' . $parent_id . '">' . $parent_nom . '</a></p>';
            //todo chopper les gosses

        }
    ?>
</section>

<?php
