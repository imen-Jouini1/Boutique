<?php
// php/boutique/boutique.php

require_once('../inc/init.inc.php');


// 1 : Recupérer tous les produits

if (isset($_GET['categorie']) && !empty($_GET['categorie'])) {

    $resultat = $pdo->prepare("SELECT * FROM produit_promo WHERE categorie = :cat");
    $resultat->bindParam(':cat', $_GET['categorie'], PDO::PARAM_STR);
    $resultat->execute();

    if ($resultat->rowCount() == 0) {
        $resultat = $pdo->query("SELECT * FROM produit_promo");
      
    }
} else {

    $resultat = $pdo->query("SELECT * FROM produit_promo");
    // $resultat ---> OBJ PDOStatement ---> INEXPLOITABLE
    // ---> FETCH ----> Plusieurs résultats --> FETCHALL
}

$produits = $resultat->fetchAll();
// $produits est un array multi avec tous les produits


// 2 : Récupérer toutes les catégories
$resultat = $pdo->query("SELECT DISTINCT categorie FROM produit_promo");
// $resultat ---> OBJ PDOStatement ---> INEXPLOITABLE
// ---> FETCH ----> Plusieurs résultats --> FETCHALL
$categories = $resultat->fetchAll();
// $categories est un array multi avec toutes les categories

// debug($produits);
// debug($categories);


// 3 : Afficher produits et catégorie via des boucles


$page = 'Promotion';
require_once('../inc/header.inc.php');
?>

   
        <div class="col-xs-12 col-sm-6 sidebar-offcanvas" id="sidebar">
            
        </div>  
        <!--/.sidebar-offcanvas-->
        <div class="col-xs-12 col-sm-11">
          
            <div class="container h-100" >
               <center> <h1 ><b><i>3ich lPromo m3a ElMouna</i></b></h1></center>
            </div>

      
            <?php foreach ($produits as $pdt) : ?>
                <?php extract($pdt) ?>
                
                <!-- col-xs-6 col-lg-4 -->
                <div class="col-xs-6 col-lg-3" style="margin-top: 10px;"  >
                    <div class="panel-body" >
                        <div class="panel-heading"><h3><?= $titre ?></h3></div>

                        <p><a href="../fiche_produit.php?id=<?= $id_produit ?>">

                                <img src="../photo/<?= $photo ?>" alt="" class="img-responsive">

                            </a></p>
                        <p class="text-center"><?= number_format($prix, 0, ',', ' ') ?>DT</p>
                



 <p class="text-center"><a class="btn btn-primary" 
                                                  role="button">Voir le détails &raquo;</a></p>



                    </div>

                </div>

                <!-- end  col-xs-6 col-lg-4 -->
            <?php endforeach; ?>
      

        </div>
        <!--/.col-xs-12.col-sm-9-->
    </div>
    <!--/row-->


<?php
require_once('../inc/footer.inc.php');
?>