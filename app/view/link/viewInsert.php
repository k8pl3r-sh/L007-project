<!-- ----- début viewInsert -->


<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        require $root . ControllerLink::$directory . "/formulaireInsertLink.php";
        break;
    case 'POST':
        require $root . ControllerLink::$directory . "/viewInserted.php";
        break;
}
?>


<!-- ----- fin viewInsert -->



