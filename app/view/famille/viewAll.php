<!-- ----- début viewAll -->

<main class="container">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">nom</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // La liste des famille est dans une variable $results
        foreach ($results as $element) {
            printf("<tr><td>%d</td><td>%s</td></tr>", $element->getId(),
                $element->getName());
        }
        ?>
        </tbody>
    </table>
</main>

<!-- ----- fin viewAll -->
  
  
  