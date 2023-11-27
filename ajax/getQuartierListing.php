<?php
require_once('../bdd.php');

$quartiers = recupererQuartiers($conn);
?>
<table class="table table-bordered table-hover" id="quartierTable">
    <thead>
        <tr>
            <th class="bg-dark text-light">ID</th>
            <th class="bg-dark text-light">Nom</th>
            <th class="bg-dark text-light">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($quartiers as $q){
                echo "<tr><td>{$q['id']}</td><td>{$q['nom']}</td><td><button class='btn btn-danger btn-sm del-quartier' data-id='{$q['id']}' type='button'>Supprimer</button></td></tr>";
            }
        ?>
        
    </tbody>
</table>
