<?php
require_once('bdd.php');
$current_year = date("Y");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Calendrier</title>
    <link rel="stylesheet" type="text/css" href="/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/plugins/toastr/toastr.min.css">
    <link href="/plugins/datatable/datatables.min.css" rel="stylesheet">
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
        <a class="navbar-brand" href="/">Calendrier</a>
    </nav>

    <!-- Card avec onglets -->
    <div class="container mt-3">
        <div class="card">
            <div class="card-header bg-dark">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active onglet" href="#achat" data-toggle="tab">Achats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link onglet text-light" href="#clients" data-toggle="tab">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link onglet text-light" href="#quartier" data-toggle="tab">Quartier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link onglet text-light" href="#rue" data-toggle="tab">Rue</a>
                    </li>
                </ul>
            </div>
            <div class="card-body tab-content">
                <div class="tab-pane active" id="achat">
                    <!-- Contenu pour Listing -->
                    <div class="container-fluid">
                        <br>
                        <form class="row" action="/ajax/addAchat.php" id="formAjouterAchat" autocomplete="off">
                            <div class="col-1 text-center">
                                <label for="">Client* :</label>
                            </div>
                            <div class="col">
                                <select name="client_id" required class="form form-control" id="selectClientAchat">
                                    
                                </select>
                            </div>
                            <div class="col-1 text-center">
                                <label for="">Année* :</label>
                            </div>
                            <div class="col">
                                <input type="text" name="annee" readonly required class="form form-control" value="<?php echo $current_year; ?>">
                            </div>
                            <div class="col-1 text-center">
                                <label for="">Prix (en €) :</label>
                            </div>
                            <div class="col">
                                <input type="text" name="prix" class="form form-control" required>
                            </div>
                            <div class="col d-flex align-items-end">
                                <button class="btn btn-primary" type="submit">Ajouter</button>
                            </div>
                        </form>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h3>Liste des clients qui n'ont pas encore acheté</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="noAchatListing">

                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <h3>Liste des achats</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="achatListing">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="clients">
                    <!-- Contenu pour Clients -->
                    <div class="container-fluid">
                        <br>
                        <form class="row" action="/ajax/addClient.php" id="formAjouterClient" autocomplete="off">
                            <div class="col-1 text-center">
                                <label for="">Civilité* :</label>
                            </div>
                            <div class="col">
                                <select name="civilite" required class="form form-control">
                                    <option value="1">Monsieur</option>
                                    <option value="2">Madame</option>
                                </select>
                            </div>
                            <div class="col-1 text-center">
                                <label for="">Nom* :</label>
                            </div>
                            <div class="col">
                                <input type="text" name="nom" required class="form form-control">
                            </div>
                            <div class="col-1 text-center">
                                <label for="">Prénom :</label>
                            </div>
                            <div class="col">
                                <input type="text" name="prenom" class="form form-control">
                            </div>
                            <div class="col-1 text-center">
                                <label for="">Rue* :</label>
                            </div>
                            <div class="col">
                                <select name="rue_id" required class="form form-control" id="selectClientRue">

                                </select>
                            </div>
                            <div class="col d-flex align-items-end">
                                <button class="btn btn-primary" type="submit">Ajouter</button>
                            </div>
                        </form>
                        <hr>
                        <div class="row">
                            <div class="col" id="clientListing">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="quartier">
                    <!-- Contenu pour Quartier -->
                    <div class="container-fluid">
                        <br>
                        <form class="row" action="/ajax/addQuartier.php" id="formAjouterQuartier" autocomplete="off">
                            <div class="col-1 text-center">
                                <label for="">Nom* :</label>
                            </div>
                            <div class="col-3">
                                <input type="text" name="nom" required class="form form-control">
                            </div>
                            <div class="col d-flex align-items-end">
                                <button class="btn btn-primary" type="submit">Ajouter</button>
                            </div>
                        </form>
                        <hr>
                        <div class="row">
                            <div class="col" id="quartierListing">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="rue">
                    <!-- Contenu pour Rue -->
                    <div class="container-fluid">
                        <br>
                        <form class="row" action="/ajax/addRue.php" id="formAjouterRue" autocomplete="off">
                            <div class="col-1 text-center">
                                <label for="">Nom* :</label>
                            </div>
                            <div class="col-3">
                                <input type="text" name="nom" required class="form form-control">
                            </div>
                            <div class="col-1 text-center">
                                <label for="">Quartier* :</label>
                            </div>
                            <div class="col-3">
                                <select name="quartier_id" required class="form form-control" id="selectRueQuartier">
                                    
                                </select>
                            </div>
                            <div class="col d-flex align-items-end">
                                <button class="btn btn-primary" type="submit">Ajouter</button>
                            </div>
                        </form>
                        <hr>
                        <div class="row">
                            <div class="col" id="rueListing">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Détails des Achats</h5>
                </div>
                <div class="modal-body" id="detailListing">
                   
                </div>
            </div>
        </div>
    </div>

    <script src="/plugins/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/plugins/toastr/toastr.min.js"></script>   
    <script src="/plugins/datatable/datatables.min.js"></script>
    <script src="/script.js"></script>
</body>
</html>
