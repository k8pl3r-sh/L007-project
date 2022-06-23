<?php
echo "<table class='table table-bordered'>";

// Table header
if (isset($array) && !empty($array)) {
    foreach ($array[0] as $cle => $valeur) {
        echo "<th class='bg-info' scope='col'>" . $cle . "</th>";
    }
} else {
    echo "<h3>Aucun élément ne correspond à votre recherche</h3>";
}

// Table body
if (isset($array) && !empty($array)) {
    foreach ($array as $valeur) {
        echo "<tr>";
        foreach ($valeur as $element) {
            echo "<td>" . $element . "</td>";
        }
        echo "</tr>";
    }
}
echo "</table>";
?>