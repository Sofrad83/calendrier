<?php
require_once('../bdd.php');

$no_achats = recupererNoAchats($conn);
?>
<table class="table table-bordered table-hover" id="noAchatTable">
    <thead>
        <tr>
            <th class="bg-dark text-light">Nom</th>
            <th class="bg-dark text-light">Prénom</th>
            <th class="bg-dark text-light">Quartier</th>
            <th class="bg-dark text-light">Rue</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($no_achats as $a){
                echo "<tr>";
                echo    "<td>{$a['nom']}</td>";
                echo    "<td>{$a['prenom']}</td>";
                echo    "<td>{$a['quartier_nom']}</td>";
                echo    "<td>{$a['rue_nom']}</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
