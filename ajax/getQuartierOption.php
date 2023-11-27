<?php
require_once('../bdd.php');

$quartiers = recupererQuartiers($conn);
foreach($quartiers as $q){
    echo "<option value='{$q['id']}'>{$q['nom']}</option>";
}
?>
