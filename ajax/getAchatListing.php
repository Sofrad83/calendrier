<?php
require_once('../bdd.php');

$achats = recupererAchats($conn);
$total = 0.00;
?>
<table class="table table-bordered table-hover" id="achatTable">
    <thead>
        <tr>
            <th class="bg-dark text-light">Civilité</th>
            <th class="bg-dark text-light">Nom</th>
            <th class="bg-dark text-light">Prénom</th>
            <th class="bg-dark text-light">Quartier</th>
            <th class="bg-dark text-light">Rue</th>
            <th class="bg-dark text-light">Année</th>
            <th class="bg-dark text-light">Prix (en € total sur l'année)</th>
            <th class="bg-dark text-light">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($achats as $a){
                echo "<tr>";
                if($a['civilite'] == 1){
                    echo    "<td>Monsieur</td>";
                }else{
                    echo    "<td>Madame</td>";
                }
                echo    "<td>{$a['nom']}</td>";
                echo    "<td>{$a['prenom']}</td>";
                echo    "<td>{$a['quartier_nom']}</td>";
                echo    "<td>{$a['rue_nom']}</td>";
                echo    "<td>{$a['annee']}</td>";
                $prix = number_format($a['prix'], 2, ',', ' ');
                echo    "<td>{$prix}</td>";
                echo    "<td><button class='btn btn-primary btn-sm detail-achat' id='btnvoirdetail{$a['client_id']}{$a['annee']}' data-client_id='{$a['client_id']}' data-annee='{$a['annee']}' type='button'>Voir détails</button></td>";
                echo "</tr>";
                $total += $a['prix'];
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th class="bg-dark text-light">Total</th>
            <th class="bg-dark text-light"></th>
            <th class="bg-dark text-light"></th>
            <th class="bg-dark text-light"></th>
            <th class="bg-dark text-light"></th>
            <th class="bg-dark text-light"></th>
            <th class="bg-dark text-light">
                <?php
                    $prix_total = number_format($total, 2, ',', ' ');
                    echo $prix_total;
                ?>
            </th>
            <th class="bg-dark text-light"></th>
        </tr>
    </tfoot>
</table>
