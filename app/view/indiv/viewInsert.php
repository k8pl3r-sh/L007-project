<main class="container">
    <?php

    $method = $_SERVER['REQUEST_METHOD'];

    function print_inserted($root)
    {
        $array = ControllerIndiv::indivHasBeenCreated();
        require_once $root . "/app/view/viewTable.php";
    }

    switch ($method) {
        case 'GET':
            if (isset($formulaire))
                echo $formulaire;
            break;
        case 'POST':
            print_inserted($root);
            break;
    }


    ?>
</main>
