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
    if (isset($parents['pere']) && $parents['pere']['id'] != 0) {
        $pere = $parents['pere'];
        echo "<p>Père: <a href='router1.php?action=selectIndiv&famille_id={$pere['famille_id']}&individu_id=" . $pere['id'] . "' >{$pere['nom']} {$pere['prenom']}</a></p>";

    } else
        echo "<p>Père inconnu</p>";
    if (isset($parents['mere']) && $parents['mere']['id'] != 0) {
        $mere = $parents['mere'];
        echo "<p>Mère: <a href='router1.php?action=selectIndiv&famille_id={$mere['famille_id']}&individu_id=" . $mere['id'] . "'>{$mere['nom']} {$mere['prenom']}</a></p>";
    } else
        echo "<p>Mère inconnue</p>";
    ?>
</section>
<section class="alert alert-secondary">
    <h2>Unions et lien</h2>
    <?php
    if (isset($unions))
        foreach ($unions as $union) {
            $parent_nom = (isset($personne) && $union["iid1"] == $personne["id"]) ? $union["individu2"] : $union["individu1"];
            $parent_id = (isset($personne) && $union["iid1"] == $personne["id"]) ? $union["iid2"] : $union["iid1"];
            $parent_fid = (isset($personne) && $union["iid1"] == $personne["id"]) ? $union["fid2"] : $union["fid1"];
            echo '<p">Union avec <a href="router1.php?action=selectIndiv&famille_id= ' . $parent_fid . ' & individu_id=' . $parent_id . '">' . $parent_nom . '</a></p>';
            if (isset($les_enfants[$parent_id])) {
                echo "<ol>";
                foreach ($les_enfants[$parent_id] as $enfant)
                    echo " <li>Enfant
                             <a href ='router1.php?action=selectIndiv&famille_id=" . $enfant['famille_id'] . "&individu_id=" . $enfant['id'] . "' > " . $enfant['nom'] . ' ' . $enfant['prenom'] . "</a>
                          </li > ";
                echo "</ol> ";
            }

        }
    ?>
</section>

<?php
