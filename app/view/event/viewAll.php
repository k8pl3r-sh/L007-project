
<!-- ----- début viewAll -->
<?php

require ($root . '/app/view/fragment/fragmentCaveHeader.html');
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
          <th scope = "col">famille_id</th>
          <th scope = "col">id</th>
          <th scope = "col">iid</th>
          <th scope = "col">Event_type</th>
          <th scope = "col">Event_date</th>
          <th scope = "col">Event_Lieu</th>
        </tr>
      </thead>
      <tbody>
          <?php
          // La liste des events est dans une variable $results             
          foreach ($results as $element) {
           printf("<tr><td>%d</td><td>%d</td><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $element->getFamille_id(), 
             $element->getId(), $element->getIid(), $element->getEvent_type(), $element->getEvent_date(), $element->getEvent_lieu());
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  
  