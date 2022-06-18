
<!-- ----- début viewInsert -->
 
<?php 
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentNavigation.html';
      include $root . '/app/view/famille/viewFamilleSelectionnee.php';
      echo("TEST_DEBUG")
      echo($_GET['nom'])
    ?> 


    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

<!-- ----- fin viewInsert -->



