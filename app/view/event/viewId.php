<!-- ----- début viewId -->
<?php
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentNavigation.html';
    include $root . '/app/view/famille/viewFamilleSelectionnee.php';

    // $results contient un tableau avec la liste des clés.
    ?>

    <form role="form" method='get' action='router1.php'>
        <div class="form-group">
            <input type="hidden" name='action' value='vinReadOne'>
            <label for="id">id : </label> <select class="form-control" id='id' name='id' style="width: 100px">
                <?php
                foreach ($results as $id) {
                    echo("<option>$id</option>");
                }
                ?>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
</div>

<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

<!-- ----- fin viewId -->