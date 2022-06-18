<!-- ----- début viewOne -->

<body>
<?php
include $root . '/app/view/famille/viewFamilleSelectionnee.php';
?>

<table class="table table-striped table-bordered py-5">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">nom</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // La liste des famille est dans une variable $results
    printf("<tr><td>%d</td><td>%s</td></tr>", $element->getId(),
        $element->getName());
    ?>
    </tbody>
</table>
<!-- ----- fin viewOne -->
  
  
  