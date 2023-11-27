<?php
require_once('../bdd.php');

$rues = recupererRues($conn);
?>
<table class="table table-bordered table-hover" id="rueTable">
    <thead>
        <tr>
            <th class="bg-dark text-light">ID</th>
            <th class="bg-dark text-light">Nom</th>
            <th class="bg-dark text-light">Quartier</th>
            <th class="bg-dark text-light">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($rues as $q){
                echo "<tr><td>{$q['id']}</td><td>{$q['nom']}</td><td>{$q['quartier_nom']}</td><td><button class='btn btn-danger btn-sm del-rue' data-id='{$q['id']}' type='button'>Supprimer</button></td></tr>";
            }
        ?>
    </tbody>
</table>
