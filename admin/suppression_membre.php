<?php

//Boutique/admin/suppression_produit.php

require_once('../inc/init.inc.php');

// Cette page a vocation à supprimer un produit puis à nous rediriger directement vers la liste des produits (en confirmant l'action). Il n'y a donc pas besoin de require la partie visuelle du site (header et footer).


if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    // Pour supprimer un produit cette page doit obligatoirement recevoir un id, non vide et numérique.
    // Avant de supprimer un produit, on va vérifier que ce produit existe.
    $resultat = $pdo->prepare("SELECT * FROM membre WHERE id_membre = :id");
    $resultat->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $resultat->execute();

    if ($resultat->rowCount() > 0) {
        // Si le produit existe bien
        $users = $resultat->fetch();

        // 1 : On va supprimer la photo du produit
        // Pour supprimer la photo on doit récupérer son chemin absolu
       

        // 2 : On va supprimer le produit
        $resultat = $pdo->exec("DELETE FROM membre WHERE id_membre = $users[id_membre]");
        if ($resultat) {
            // Si la requête s'est bien passée
            $_SESSION['success'] = '<div class="alert alert-success">Le produit N°' . $users['id_membre'] . ' a été supprimé avec succès</div>';
            header("location:" . RACINE_SITE . "admin/gestion_membres.php");
        }
    } else {
        header("location:gestion_membres.php");
    }
} else {
    header("location:gestion_membres.php");
}