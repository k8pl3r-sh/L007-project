<!-- ----- début viewInsert -->


<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        require $root . ControllerFamily::$base_directory . "/fragment/fragmentFormulaireInsertFamille.html";
        break;
    case 'POST':
        require $root . ControllerFamily::$directory . "/viewInserted.php";
        break;
}
?>


<!-- ----- fin viewInsert -->



