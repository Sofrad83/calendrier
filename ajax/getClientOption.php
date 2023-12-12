<?php
require_once('../bdd.php');

$clients = recupererClients($conn);
foreach($clients as $c){
    echo "<option value='{$c['id']}'>{$c['nom']} {$c['prenom']} ({$c['quartier_nom']})</option>";
}
?>
