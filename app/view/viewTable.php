<?php
echo "<table class='table table-bordered'>";

// Table header
if (isset($array)) {
    foreach ($array[0] as $clave => $fila) {
        echo "<th class='bg-info' scope='col'>" . $clave . "</th>";
    }
}

// Table body
if (isset($array)) {
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