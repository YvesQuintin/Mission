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

    <h1> Liste des produits en Stock Limite</h1>
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
$TotalesCommandesReq = $bdd->query("SELECT id_product FROM ps_stock_available WHERE quantity > 0 AND quantity <= 5");
$TotalesCommandes = $TotalesCommandesReq->rowCount();
$pagesTotales = ($TotalesCommandes/$nbr_commandes)+1;

if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] < $pagesTotales){
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
} else { 
    $pageCourante = 1;
}

$depart = ($pageCourante-1)*$nbr_commandes;

$quantityStock = $bdd->query("SELECT ps_product_lang.id_product, name, quantity FROM ps_stock_available INNER JOIN ps_product_lang ON ps_stock_available.id_product = ps_product_lang.id_product WHERE quantity > 0 AND quantity <= 5 GROUP BY id_product LIMIT $depart, $nbr_commandes");

?>
<div class="container">
<ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">ID</div>
      <div class="col col-2">Nom du Produit</div>
      <div class="col col-3">Quantité</div>
    </li>

<?php while($quantity = $quantityStock->fetch()){ ?>
    
    <li class="table-row">
    <div class="col col-1" data-label="id_product">  <?php echo $quantity['id_product']. '<br>';?> </div>
    <div class="col col-2" data-label="name">  <?php echo $quantity['name'] ?></div> 
    <div class="col col-3" data-label="quantite"><?php echo '&emsp;'.'&emsp;'. $quantity['quantity']. '<br>'; ?></div>
    </li>
<?php } ?>
</ul>

<ul class=pagination>
<!-- flèche de la pagination qui permet de retourner en arrière -->
<a class=pagination href="?page= <?php if($pageCourante != 1){ echo $pageCourante-1; } else{ echo $pageCourante; }?>">&laquo;</a>
 
 <?php
//code permettant d'afficher la page actuelle dans l'url et dans la pagination
 for($i=1;$i<=$pagesTotales;$i++){
     if($i == $pageCourante) {
         echo $i .'&nbsp &nbsp';
     } else{
     echo '<a href="produitQuantiteLimite.php?page='.$i.'">'.$i.'</a>&nbsp &nbsp';
     }
 }
 ?>
  <!-- flèche de la pagination qui permet d'aller à la page suivante  -->
 <a href="?page=<?php if($pageCourante != $pagesTotales){ echo $pageCourante+1; } else{ echo $pageCourante; }?>"> &raquo;</a>
</ul>

</body>

</html>