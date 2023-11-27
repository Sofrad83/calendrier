<?php
$servername = "localhost"; // Remplacez par l'adresse de votre serveur
$username = "root"; // Remplacez par votre nom d'utilisateur de la base de données
$password = ""; // Remplacez par votre mot de passe de la base de données
$dbname = "calendrier"; // Remplacez par le nom de votre base de données

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

function creerQuartier($conn, $nomQuartier) {
    // Préparation de la requête pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO quartier (nom) VALUES (?)");

    // Vérification si la préparation a réussi
    if ($stmt === false) {
        die("Erreur lors de la préparation : " . $conn->error);
    }

    $stmt->bind_param("s", $nomQuartier);

    // Exécution de la requête
    if ($stmt->execute()) {
        return "Quartier créé avec succès";
    } else {
        return "Erreur lors de la création du quartier : " . $stmt->error;
    }

    // Fermeture de la déclaration
    $stmt->close();
}

function recupererQuartiers($conn) {
    $quartiers = array();

    // Préparation de la requête SQL pour sélectionner tous les quartiers
    $sql = "SELECT * FROM quartier order by nom";
    $result = $conn->query($sql);

    // Vérification si la requête a réussi
    if ($result === false) {
        die("Erreur lors de la récupération des quartiers : " . $conn->error);
    }

    // Récupération des résultats
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $quartiers[] = [
                'id' => $row['id'],
                'nom' => $row['nom']
            ];
        }
    }

    // Retourner le tableau des quartiers
    return $quartiers;
}

function supprimerQuartier($conn, $idQuartier) {

    //On supprime toutes les rues du quartier d'abord
    // Préparation de la requête SQL pour supprimer le quartier
    $stmtr = $conn->prepare("DELETE FROM rue WHERE quartier_id = ?");
    if ($stmtr === false) {
        die("Erreur de préparation : " . $conn->error);
    }

    // Liaison de l'ID du quartier à la requête
    $stmtr->bind_param("i", $idQuartier);

    // Exécution de la requête
    if ($stmtr->execute()) {
        
    } else {
        return "Erreur lors de la suppression des rues du quartier : " . $stmtr->error;
    }

    // Fermeture de la déclaration
    $stmtr->close();

    // Préparation de la requête SQL pour supprimer le quartier
    $stmt = $conn->prepare("DELETE FROM quartier WHERE id = ?");
    if ($stmt === false) {
        die("Erreur de préparation : " . $conn->error);
    }

    // Liaison de l'ID du quartier à la requête
    $stmt->bind_param("i", $idQuartier);

    // Exécution de la requête
    if ($stmt->execute()) {
        return "Quartier supprimé avec succès";
    } else {
        return "Erreur lors de la suppression du quartier : " . $stmt->error;
    }

    // Fermeture de la déclaration
    $stmt->close();
}

function creerRue($conn, $nomQuartier, $idQuartier) {
    // Préparation de la requête pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO rue (nom, quartier_id) VALUES (?, ?)");

    // Vérification si la préparation a réussi
    if ($stmt === false) {
        die("Erreur lors de la préparation : " . $conn->error);
    }

    $stmt->bind_param("ss", $nomQuartier, $idQuartier);

    // Exécution de la requête
    if ($stmt->execute()) {
        return "Rue créée avec succès";
    } else {
        return "Erreur lors de la création de la rue : " . $stmt->error;
    }

    // Fermeture de la déclaration
    $stmt->close();
}

function recupererRues($conn) {
    $rues = array();

    // Préparation de la requête SQL pour sélectionner tous les quartiers
    $sql = "SELECT rue.id as id, rue.nom as nom, quartier.nom as quartier_nom FROM rue INNER JOIN quartier on rue.quartier_id = quartier.id order by quartier_nom";
    $result = $conn->query($sql);

    // Vérification si la requête a réussi
    if ($result === false) {
        die("Erreur lors de la récupération des rues : " . $conn->error);
    }

    // Récupération des résultats
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rues[] = [
                'id' => $row['id'],
                'nom' => $row['nom'],
                'quartier_nom' => $row['quartier_nom']
            ];
        }
    }

    // Retourner le tableau des quartiers
    return $rues;
}

function supprimerRue($conn, $idRue) {
    // Préparation de la requête SQL pour supprimer le quartier
    $stmt = $conn->prepare("DELETE FROM rue WHERE id = ?");
    if ($stmt === false) {
        die("Erreur de préparation : " . $conn->error);
    }

    // Liaison de l'ID du quartier à la requête
    $stmt->bind_param("i", $idRue);

    // Exécution de la requête
    if ($stmt->execute()) {
        return "Rue supprimée avec succès";
    } else {
        return "Erreur lors de la suppression de la rue : " . $stmt->error;
    }

    // Fermeture de la déclaration
    $stmt->close();
}

function creerClient($conn, $civilite, $nom, $prenom, $rueId) {
    // Préparation de la requête pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO client (civilite, nom, prenom, rue_id) VALUES (?, ?, ?, ?)");

    // Vérification si la préparation a réussi
    if ($stmt === false) {
        die("Erreur lors de la préparation : " . $conn->error);
    }

    $stmt->bind_param("ssss", $civilite, $nom, $prenom, $rueId);

    // Exécution de la requête
    if ($stmt->execute()) {
        return "Client créé avec succès";
    } else {
        return "Erreur lors de la création du client : " . $stmt->error;
    }

    // Fermeture de la déclaration
    $stmt->close();
}

function recupererClients($conn) {
    $rues = array();

    // Préparation de la requête SQL pour sélectionner tous les quartiers
    $sql = "SELECT client.id as id, client.civilite as civilite, client.nom as nom, client.prenom as prenom, rue.nom as rue_nom, quartier.nom as quartier_nom FROM client LEFT JOIN rue on client.rue_id = rue.id LEFT JOIN quartier on rue.quartier_id = quartier.id where client.id > 0 order by client.nom";
    $result = $conn->query($sql);

    // Vérification si la requête a réussi
    if ($result === false) {
        die("Erreur lors de la récupération des clients : " . $conn->error);
    }

    // Récupération des résultats
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rues[] = [
                'id' => $row['id'],
                'nom' => $row['nom'],
                'prenom' => $row['prenom'],
                'civilite' => $row['civilite'],
                'rue_nom' => $row['rue_nom'],
                'quartier_nom' => $row['quartier_nom']
            ];
        }
    }

    // Retourner le tableau des quartiers
    return $rues;
}

function supprimerClient($conn, $idClient) {
    // Préparation de la requête SQL pour supprimer le quartier
    $stmt = $conn->prepare("DELETE FROM client WHERE id = ?");
    if ($stmt === false) {
        die("Erreur de préparation : " . $conn->error);
    }

    // Liaison de l'ID du quartier à la requête
    $stmt->bind_param("i", $idClient);

    // Exécution de la requête
    if ($stmt->execute()) {
        // return "Client supprimé avec succès";
    } else {
        return "Erreur lors de la suppression du client : " . $stmt->error;
    }

    // Fermeture de la déclaration
    $stmt->close();

    // Préparation de la requête SQL pour supprimer le quartier
    $stmt = $conn->prepare("UPDATE achat SET client_id = 0 WHERE client_id = ?");
    if ($stmt === false) {
        die("Erreur de préparation : " . $conn->error);
    }

    // Liaison de l'ID du quartier à la requête
    $stmt->bind_param("i", $idClient);

    // Exécution de la requête
    if ($stmt->execute()) {
        return "Client supprimé avec succès";
    } else {
        return "Erreur lors de la suppression du client : " . $stmt->error;
    }

    // Fermeture de la déclaration
    $stmt->close();
}

function creerAchat($conn, $clientId, $annee, $prix) {
    // Préparation de la requête pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO achat (client_id, annee, prix) VALUES (?, ?, ?)");

    // Vérification si la préparation a réussi
    if ($stmt === false) {
        die("Erreur lors de la préparation : " . $conn->error);
    }

    $stmt->bind_param("sss", $clientId, $annee, $prix);

    // Exécution de la requête
    if ($stmt->execute()) {
        return "Achat créé avec succès";
    } else {
        return "Erreur lors de la création du client : " . $stmt->error;
    }

    // Fermeture de la déclaration
    $stmt->close();
}

function recupererAchats($conn) {
    $rues = array();

    // Préparation de la requête SQL pour sélectionner tous les quartiers
    $sql = "SELECT achat.client_id as client_id, client.nom as nom, client.prenom as prenom, client.civilite as civilite, rue.nom as rue_nom, quartier.nom as quartier_nom, achat.annee as annee, sum(achat.prix) as prix FROM achat LEFT JOIN client on achat.client_id = client.id LEFT JOIN rue on client.rue_id = rue.id LEFT JOIN quartier on rue.quartier_id = quartier.id GROUP BY client_id, annee order by annee desc";
    $result = $conn->query($sql);

    // Vérification si la requête a réussi
    if ($result === false) {
        die("Erreur lors de la récupération des achats : " . $conn->error);
    }

    // Récupération des résultats
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rues[] = [
                'client_id' => $row['client_id'],
                'nom' => $row['nom'],
                'prenom' => $row['prenom'],
                'civilite' => $row['civilite'],
                'rue_nom' => $row['rue_nom'],
                'quartier_nom' => $row['quartier_nom'],
                'annee' => $row['annee'],
                'prix' => $row['prix']
            ];
        }
    }

    // Retourner le tableau des quartiers
    return $rues;
}

function recupererAchatsDetail($conn, $clientId, $annee) {
    $achats = array();

    // Préparation de la requête SQL pour sélectionner tous les quartiers
    $sql = "SELECT id, client_id, annee, prix FROM achat where client_id = {$clientId} and annee = {$annee}";
    $result = $conn->query($sql);

    // Vérification si la requête a réussi
    if ($result === false) {
        die("Erreur lors de la récupération des achats : " . $conn->error);
    }

    // Récupération des résultats
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $achats[] = [
                'id' => $row['id'],
                'client_id' => $row['client_id'],
                'annee' => $row['annee'],
                'prix' => $row['prix']
            ];
        }
    }

    // Retourner le tableau des quartiers
    return $achats;
}

function supprimerAchat($conn, $idAchat) {
    // Préparation de la requête SQL pour supprimer le quartier
    $stmt = $conn->prepare("DELETE FROM achat WHERE id = ?");
    if ($stmt === false) {
        die("Erreur de préparation : " . $conn->error);
    }

    // Liaison de l'ID du quartier à la requête
    $stmt->bind_param("i", $idAchat);

    // Exécution de la requête
    if ($stmt->execute()) {
        return "Achat supprimé avec succès";
    } else {
        return "Erreur lors de la suppression de l'achat : " . $stmt->error;
    }

    // Fermeture de la déclaration
    $stmt->close();
}

?>
