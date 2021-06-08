<?php
//boutique/profil.php
require_once('inc/init.inc.php');

// Est-ce user est connecté sinon... redirection !! 
if (!userConnecte()) { // Si c'est false
    header('location:connexion.php');
}


//debug($_SESSION);

extract($_SESSION['membre']);


$page = 'Profil';
require_once('inc/header.inc.php');

?>
<div class="row">
    <div class="alert alert-info text-center"><h3>Profil de <?= $pseudo ?></h3></div>
    
    <div class="col-md-6 col-xs-12">
        <center><h3 >Infos De profil</h3></center>
        <hr>
        <ul>
            <ol >Prénom : <b><?= $prenom ?></b></ol>
            <hr>
            <ol> Nom : <b><?= $nom ?></b></ol>
            <hr>
            <ol >Civilite : <b><?= ($civilite == 'm') ? 'Homme' : 'Femme' ?></b></ol>
            <hr>
            <ol >Email : <b><?= $email ?></b></ol>
            <hr>
            <ol >Statut : <b><?= ($statut == '0') ? 'Client' : 'Admin' ?></b></ol>
        </ul>
    </div>
    <div class="col-md-6 col-xs-12">
       <center> <h3>Adresse de livraison</h3></center>
          <hr>
        <p> <center>
            <b><?= $nom ?> <?= $prenom ?></b><br/>
            <?= $adresse ?><br/>
            <?= $code_postal ?> <?= $ville ?>
        </p></center>

    </div>
</div>
<div class="alert alert-info text-center"><h4>Historique des commandes</h4></div>
<table class="table table-fluid table-dark">
    <tr>
        <th>Commande N°</th>
        <th>Montant</th>
        <th>Date</th>
        <th>Statut</th>
    </tr>
    <?php

    $id_membre = $_SESSION['membre']['id_membre'];
    $commande = $pdo->prepare("SELECT * FROM commande WHERE id_membre = $id_membre");
    $commande->execute();

    while ($row = $commande->fetch(PDO::FETCH_ASSOC)) {   //Creates a loop to loop through results

        echo "<tr>";
        echo "<td>";
        echo $row['id_commande'];
        echo "</td>";
        echo "<td>";
        echo $row['montant'];
        echo "</td>";
        echo "<td>";
        echo $row['date_enregistrement'];
        echo "</td>";
        echo "<td>";
        echo $row['etat'];
        echo "</td>";
        echo "</tr>";

    }

    echo "</table>";
    ?>


    <?php
    require_once('inc/footer.inc.php');
    ?>
