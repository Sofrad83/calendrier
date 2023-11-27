<?php
require_once('../bdd.php');

$clients = recupererClients($conn);
?>
<table class="table table-bordered table-hover" id="clientTable">
    <thead>
        <tr>
            <th class="bg-dark text-light">ID</th>
            <th class="bg-dark text-light">Civilité</th>
            <th class="bg-dark text-light">Nom</th>
            <th class="bg-dark text-light">Prénom</th>
            <th class="bg-dark text-light">Quartier</th>
            <th class="bg-dark text-light">Rue</th>
            <th class="bg-dark text-light">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($clients as $c){
                echo "<tr>";
                echo    "<td>{$c['id']}</td>";
                if($c['civilite'] == 1){
                    echo    "<td>Monsieur</td>";
                }else{
                    echo    "<td>Madame</td>";
                }
                echo    "<td>{$c['nom']}</td>";
                echo    "<td>{$c['prenom']}</td>";
                echo    "<td>{$c['quartier_nom']}</td>";
                echo    "<td>{$c['rue_nom']}</td>";
                echo    "<td><button class='btn btn-danger btn-sm del-client' data-id='{$c['id']}' type='button'>Supprimer</button></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
