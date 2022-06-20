<!-- ----- début viewInsert -->


<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        require $root . ControllerEvent::$directory . "/formulaireInsertEvent.php";
        break;
    case 'POST':
        require $root . ControllerEvent::$directory . "/viewInserted.php";
        break;
}
?>


<!-- ----- fin viewInsert -->



