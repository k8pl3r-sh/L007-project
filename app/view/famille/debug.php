<!-- ----- début viewInsert -->

<?php
if (isset($root))
    require($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
<?php
include $root . '/app/view/fragment/fragmentNavigation.html';
?>
<main class="container">
    <?php
    include $root . '/app/view/famille/viewFamilleSelectionnee.php';
    echo("TEST_DEBUG")
      echo($_GET['nom'])
    ?>


    <p/>
</main>
<?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

<!-- ----- fin viewInsert -->



