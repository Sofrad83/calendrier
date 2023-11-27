<?php
require_once('../bdd.php');

$rues = recupererRues($conn);
foreach($rues as $r){
    echo "<option value='{$r['id']}'>{$r['nom']} ({$r['quartier_nom']})</option>";
}
?>
