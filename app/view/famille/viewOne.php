<!-- ----- début viewOne -->

<section id="viewOne">
    <button class="btn btn-block btn-primary" onclick="history.back()">Choisir une autre famille</button>


    <table class="table table-striped table-bordered py-5">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">nom</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // La liste des famille est dans une variable $results
        printf("<tr><td>%d</td><td>%s</td></tr>", $element->getId(),
            $element->getName());
        ?>
        </tbody>
    </table>
</section>
<!-- ----- fin viewOne -->
  
  
  