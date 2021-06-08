<?php
//boutique/admin/gestion_produits.php

require_once('../inc/init.inc.php');


// if(isset($_GET['validation']) && $_GET['validation'] == 'success'){
// $error .= '<div class="alert alert-success">Félicitations l\'opération est un succès</div>';
// }

if (isset($_SESSION['success'])) {
    $error .= $_SESSION['success'];
    unset($_SESSION['success']);

    // Grâce à la session on peut récupérer ici un message généré dans le fichier formulaire_produit.php
}

require_once('../inc/header.inc.php');


$resultat = $pdo->query("SELECT * FROM membre");
$users = $resultat->fetchAll(PDO::FETCH_ASSOC);
//var_dump($users);
$html .= '<table class="table table-dark table-fluid">';
$html .= '<tr>';


for ($i = 0; $i < $resultat->columnCount(); $i++) {
    $champs = $resultat->getColumnMeta($i);
    $html .= '<th>' . $champs['name'] . '</th>';
}

$html .= '<th colspan="3">Action</th>';
$html .= '</tr>';
foreach ($users as $value) {
    $html .= '<tr>';
    foreach ($value as $indice => $info) {

            $html .= '<td>' . $info . '</td>';
        }

$html .= '<td><a class="sup" href="' . RACINE_SITE . 'admin/suppression_membre.php?id=' . $value['id_membre'] . '"><i class="far fa-trash-alt"></i></a></td>';
   
 //$html .= '<td><a href="' . RACINE_SITE . 'profilclient.php?id=' . $value['id_membre'] . '"><i class="far fa-edit"></i></a></td>';
    
    $html .= '</tr>';






}

    $html .= '</tr>';

$html .= '</table>';

    

?>




<?= $error ?>

<div class="alert alert-info text-center"><h2>Listes des Clients</h2></div>
<?= $html ?>







<?php
require_once('../inc/footer.inc.php');
?>

<script type="text/javascript">
    $(function () {
        $(".sup").click(function () {
            return confirm('Voulez-vous supprimer le compte ?');
        });
    });
</script>