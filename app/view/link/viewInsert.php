
<!-- ----- début viewInsert -->
 
<?php 
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentNavigation.html';
      include $root . '/app/view/famille/viewFamilleSelectionnee.php';
    ?>

      <form role="form" method='get' action='router1.php'>
          <div class="form-group">
              <input type="hidden" name='action' value='addFamily'>
              <label>nom : </label><input type="text" name='nom' size='75' value='napoleon'>
          </div>
          <p/>
          <button class="btn btn-primary" type="submit">Go</button>
      </form>
      <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

  <!-- ----- fin viewInsert -->



