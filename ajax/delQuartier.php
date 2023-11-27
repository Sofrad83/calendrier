<?php
require_once('../bdd.php');

// Vérifie si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère les données POST et les stocke dans un tableau
    $postData = [];
    foreach ($_POST as $key => $value) {
        $postData[$key] = $value;
    }

    $result = supprimerQuartier($conn, $postData['id']);

    // Définit l'en-tête de réponse à JSON
    header('Content-Type: application/json');

    // Encode le tableau en JSON et l'envoie
    echo json_encode($result);
} else {
    // Si la requête n'est pas POST, renvoie une erreur
    echo json_encode(["error" => "Requête non autorisée"]);
}
?>
