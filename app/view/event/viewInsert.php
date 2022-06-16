
<!-- ----- début viewInsert -->
 
<?php 
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentCaveMenu.html';
      include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
    ?> 

    <form role="form" method='get' action='router1.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='addEvent'>        
        <label>famille id : </label><input type="text" name='famille_id' size='30'><br/>
        <label>id : </label><input type="text" name='id' size='30'></br>
        <label> iid : </label><input type="text" name="iid" className="nom"  /><br/>
        <p>event_type</p>
        <select name="event_type">
        <option selected>NAISSANCE</option><option>DECES</option>
        </select><br/>

        <label>event_date : </label><input type="text" name='nom' size='30' value='1966-08-14'></br>
        <label>event_lieu : </label><input type="text" name='nom' size='30' value='Troyes'>                                        
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

<!-- ----- fin viewInsert -->



