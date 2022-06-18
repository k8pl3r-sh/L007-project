<!-- ----- début viewAll -->
<?php

require($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
<?php
include $root . '/app/view/fragment/fragmentNavigation.html';
?>
<main class="container">
    <?php
    include $root . '/app/view/famille/viewFamilleSelectionnee.php';
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">nom</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // La liste des famille est dans une variable $results
        foreach ($results as $element) {
            printf("<tr><td>%d</td><td>%s</td></tr>", $element->getId(),
                $element->getName());
        }
        ?>
        </tbody>
    </table>
</main>
<?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

<!-- ----- fin viewAll -->
  
  
  