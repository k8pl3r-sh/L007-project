<?php
echo "<table class='table table-bordered'>";

// Table header
if (isset($array) && !empty($array)) {
    foreach ($array[0] as $clave => $fila) {
        echo "<th class='bg-info' scope='col'>" . $clave . "</th>";
    }
} else {
    echo "<h3>Aucun élément ne correspond à votre recherche</h3>";
}

// Table body
if (isset($array) && !empty($array)) {
    foreach ($array as $fila) {
        echo "<tr>";
        foreach ($fila as $elemento) {
            echo "<td>" . $elemento . "</td>";
        }
        echo "</tr>";
    }
}
echo "</table>";
?>