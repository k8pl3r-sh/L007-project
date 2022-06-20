
<!-- ----- début viewInsert -->
 
<?php 
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentNavigation.html';
    ?>

    <form role="form" method='get' action='router1.php'>
      <div class="form-group">
          <input type="hidden" name='action' value='addEvent'>
          <label>famille id : </label><input type="text" name='famille_id' size='30'><br/>
          <!-- ----- PAS sûr de l'utilité de l'id -->
          <label>id : </label><input type="text" name='id' size='30'></br>
          <label> iid : </label><input type="text" name="iid" className="nom"/><br/>
          <p>event_type</p>
          <select name="event_type">
              <option selected>NAISSANCE</option>
              <option>DECES</option>
          </select><br/>

          <label>event_date : </label><input type="text" name='nom' size='30' value='1966-08-14'></br>
          <label>event_lieu : </label><input type="text" name='nom' size='30' value='Troyes'>
      </div>
        <p/>
        <button class="btn btn-primary" type="submit">Go</button>
    </form>
      <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

  <!-- ----- fin viewInsert -->



