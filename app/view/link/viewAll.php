
<!-- ----- début viewAll -->
<?php

require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentNavigation.html';
      include $root . '/app/view/famille/viewFamilleSelectionnee.php';
      ?>

    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
            <th scope="col">famille_id</th>
            <th scope="col">id</th>
            <th scope="col">iid1</th>
            <th scope="col">iid2</th>
            <th scope="col">Lien_type</th>
            <th scope="col">Lien_date</th>
            <th scope="col">Lien_Lieu</th>
        </tr>
      </thead>
        <tbody>
        <?php
        // La liste des events est dans une variable $results
        foreach ($results as $element) {
            printf("<tr><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $element->getFamille_id(),
                $element->getId(), $element->getIid1(), $element->getIid2(), $element->getLink_type(), $element->getLink_date(), $element->getLink_lieu());
        }
        ?>
        </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  
  