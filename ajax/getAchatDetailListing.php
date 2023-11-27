<?php
require_once('../bdd.php');

// Vérifie si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère les données POST et les stocke dans un tableau
    $postData = [];
    foreach ($_POST as $key => $value) {
        $postData[$key] = $value;
    }

    $achats = recupererAchatsDetail($conn, $postData['client_id'], $postData['annee']);
    $total = 0.00;

} else {
    // Si la requête n'est pas POST, renvoie une erreur
    echo json_encode(["error" => "Requête non autorisée"]);
}

?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="bg-dark text-light">Année</th>
            <th class="bg-dark text-light">Prix (en €)</th>
            <th class="bg-dark text-light">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($achats as $a){
                echo "<tr>";
                echo    "<td>{$a['annee']}</td>";
                $prix = number_format($a['prix'], 2, ',', ' ');
                echo    "<td>{$prix}</td>";
                echo    "<td><button class='btn btn-danger btn-sm del-achat' data-btn='btnvoirdetail{$a['client_id']}{$a['annee']}' data-id='{$a['id']}' type='button'>Supprimer</button></td>";
                echo "</tr>";
                $total += $a['prix'];
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th class="bg-dark text-light">Total</th>
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
