<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset = "utf-8">
  <title>Produit en Stock</title>
  <link rel="stylesheet" href="css/style.css">
 
 </head>
 <body>
	    <?php include('header.php');?>

    <h1> Liste des produits en Stock</h1>
 <?php

 try
{
    $bdd = new PDO('mysql:host=localhost;dbname=bddpres_1_w3cam_fr', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

//pagination
$nbr_commandes = 20;
$TotalesCommandesReq = $bdd->query("SELECT id_product FROM ps_stock_available");
$TotalesCommandes = $TotalesCommandesReq->rowCount();
$pagesTotales = ($TotalesCommandes/$nbr_commandes)+1;

if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] < $pagesTotales){
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
} else { 
    $pageCourante = 1;
}

$depart = ($pageCourante-1)*$nbr_commandes;


$quantityStock = $bdd->query("SELECT ps_product_lang.id_product, name, quantity FROM ps_stock_available INNER JOIN ps_product_lang ON ps_stock_available.id_product = ps_product_lang.id_product GROUP BY id_product LIMIT $depart, $nbr_commandes");

?>
<div class="container">
<ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">ID</div>
      <div class="col col-3">Nom du Produit</div>
      <div class="col col-5">Quantité</div>
      <div class="col col-5">LIMITE</div>
    </li>

<?php while($quantity = $quantityStock->fetch()){ ?>
    
    <li class="table-row">
    <div class="col col-5" data-label="id_product">  <?php echo $quantity['id_product']. '<br>';?> </div>
    <div class="col col-3" data-label="name">  <?php echo $quantity['name'] ?></div> 
        <?php  if($quantity['quantity']>5) {?>
        
            <div class="col col-5" data-label="quantite"> <?php echo  $quantity['quantity']. '<br>'; ?></div>
            <div class="col col-5" >&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
    <?php   }
    else if($quantity['quantity'] == 0){?>
        
        <div class="col col-5" data-label="quantite"> <?php echo $quantity['quantity']. '<br>';?> </div>
        <div class="col col-5" data-label="quantite"id=button> <?php echo 'Ruputure'. '<br>';?> </div> <?php
        
    }
        else{ ?>
            <div class="col col-5" data-label="quantite"> <?php echo $quantity['quantity']. '<br>';?> </div>
            <div class="col col-5" data-label="LIMITE"><a href="produitQuantiteLimite.php"><span id=button>LIMITE</span action="produitQuantiteLimite.php" id=button> </a></div>
       <?php }
    ?>
    </li>
<?php } ?>
</ul>
</div>
<ul class=pagination>
<!-- flèche de la pagination qui permet de retourner en arrière -->
<a class=pagination href="?page= <?php if($pageCourante != 1){ echo $pageCourante-1; } else{ echo $pageCourante; }?>">&laquo;</a>
 
 <?php
//code permettant d'afficher la page actuelle dans l'url et dans la pagination
 for($i=1;$i<=20;$i++){
     if($i == $pageCourante) {
         echo $i .'&nbsp &nbsp';
     } else{
     echo '<a href="produitStock.php?page='.$i.'">'.$i.'</a>&nbsp &nbsp';
     }
 }
 ?>
  <!-- flèche de la pagination qui permet d'aller à la page suivante  -->
 <a href="?page=<?php if($pageCourante != $pagesTotales){ echo $pageCourante+1; } else{ echo $pageCourante; }?>"> <?php echo $pageCourante +1; ?>&raquo;</a>
</ul>

</body>

</html>