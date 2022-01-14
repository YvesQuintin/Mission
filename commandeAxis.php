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
    <meta charset = "utf-8"/>
    <title>Liste des commandes de AXIS</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
	    <?php include('header.php');?>
    

   
    <h1> Liste des commandes de AXIS </h1>

<?php
$bdd = new PDO('mysql:host=localhost;dbname=bddpres_1_w3cam_fr',
'root',
''
);

//pagination
$nbr_commandes = 10;
$TotalesCommandesReq = $bdd->query('SELECT id_order_detail FROM ps_order_detail');
$TotalesCommandes = $TotalesCommandesReq->rowCount();
$pagesTotales = ceil($TotalesCommandes/$nbr_commandes);

if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] < $pagesTotales){
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
} else { 
    $pageCourante = 1;
}


$depart = ($pageCourante-1)*$nbr_commandes;


$orderStatement = $bdd->query("SELECT ps_orders.id_order, product_name, product_quantity, total_price_tax_incl, date_add, SUM(total_price_tax_incl) AS total_prix FROM ps_order_detail INNER JOIN ps_orders ON ps_order_detail.id_order = ps_orders.id_order WHERE product_name LIKE '%AXIS' OR product_name LIKE '%AXIS%' OR product_name LIKE 'AXIS%' GROUP BY id_order LIMIT $depart, $nbr_commandes");

    ?>
    <?php include('barre_recherche.php');?>

    <div class="container">
<ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">ID</div>
      <div class="col col-2">Nom du Produit</div>
      <div class="col col-3">Quantité</div>
      <div class="col col-3">Prix taxe inclus</div>
      <div class="col col-3">Date ajout</div>
      <div class="col col-3">Total Prix</div>
      <div class="col col-4">MODIFIER</div>
      
    </li>
<!-- div contenant les infos des commandes AXIS -->
<?php while($order = $orderStatement->fetch()) { ?>
    <li class="table-row">
    <div class="col col-1" data-label="id_product">  <?php echo $order['id_order']. '<br>';?> </div>
    <div class="col col-2" data-label="product_name">  <?php echo $order['product_name'] ?></div> 
    <div class="col col-3" data-label="quantite"><?php echo '&emsp;'.'&emsp;'.  $order ['product_quantity']. '<br>'; ?></div>
    <div class="col col-3" data-label="prix">   <?php echo $order['total_price_tax_incl']. '<br>'; ?> </div>
    <div class="col col-3" data-label="date">  <?php echo $order['date_add']. '<br>'; ?> </div>
    <div class="col col-3" data-label="total_prix">  <?php echo $order['total_prix']. '<br>'; ?></div>
    <div class="col col-4" data-label="MODIFIER"><a href="modif.php?id_order=<?php echo $order['id_order'];?>"><span id=button>Modifier</span id=button> </a></div>
    
    
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
         echo $i.'&nbsp &nbsp';
     } else{
     echo '<a href="commandeAxis.php?page='.$i.'">'.$i.'</a>&nbsp &nbsp';
     }
 }
 ?>
 <!-- flèche de la pagination qui permet d'aller à la page suivante  -->
 <a href="?page=<?php if($pageCourante != $pagesTotales){ echo $pageCourante+1; } else{ echo $pageCourante; }?>"> <?php echo $pageCourante +1; ?> &raquo;</a>
</ul>
</body>
<footer>
</footer>
</html>