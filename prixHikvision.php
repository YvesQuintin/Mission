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
  <title>Prix HikVision</title>
  <link rel="stylesheet" href="css/style.css"/>
 </head>
 <body>
    <?php include('header.php');?>
 
    <h1> Modification des commandes de HIKVISION </h1>
    <form enctype="multipart/form-data" action="import_csv.php" method="post">
        <div >
            <label >Choisir un fichier CSV</label>
            <input type="file" name="file"  accept=".csv">
          
            <button type="submit" name="import" >Import</button>
           
        </div>
    </form>
    <?php
$bdd = new PDO('mysql:host=localhost;dbname=bddpres_1_w3cam_fr',
'root',
''
);

//pagination
$nbr_commandes = 20;
$TotalesCommandesReq = $bdd->query("SELECT id_product name FROM ps_product_lang WHERE name LIKE '%HIKVISION%'");
$TotalesCommandes = $TotalesCommandesReq->rowCount();
$pagesTotales = ceil($TotalesCommandes/$nbr_commandes);

if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] < $pagesTotales){
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
} else { 
    $pageCourante = 1;
}


    $depart = ($pageCourante-1)*$nbr_commandes;

    $productStatement =$bdd->query("SELECT ps_product.id_product, name, price,wholesale_price FROM ps_product INNER JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product WHERE name LIKE '%HIKVISION%' GROUP BY id_product LIMIT $depart, $nbr_commandes")

    ?>

<?php include('barre_recherche_modif.php');?>

<div class="container">
<ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">ID</div>
      <div class="col col-2">Nom du Produit</div>
      <div class="col col-3">Prix d'Achat</div>
      <div class="col col-3">Prix de vente</div>
      <div class="col col-4">MODIFIER</div>
      
    </li>

         <?php while ( $product =  $productStatement->fetch()){?>
                                     
    <li class="table-row">
        <div class="col col-1" data-label="id_product"><?php echo $product['id_product'] ?></div>
        <div class="col col-2" data-label="name"><?php echo $product['name'] ?></div>
        <div class="col col-3" data-label="price"><?php echo '&emsp;'.'&emsp;'.  $product['wholesale_price'] ?></div>
        <div class="col col-3" data-label="price"><?php echo '&emsp;'.'&emsp;'.  $product['price'] ?></div>
        <div class="col col-4" data-label="MODIFIER"><a href="modif_price.php?id_product=<?php echo $product['id_product'];?>"><span id=button>Modifier</span id=button> </a>                                      
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
     echo '<a href="prixHikvision.php?page='.$i.'">'.$i.'</a>&nbsp &nbsp';
     }
 }
 ?>
 <!-- flèche de la pagination qui permet d'aller à la page suivante  -->
 <a href="?page=<?php if($pageCourante != $pagesTotales){ echo $pageCourante+1; } else{ echo $pageCourante; }?>"> <?php echo $pageCourante +1; ?> &raquo;</a>
</ul>
        
 </body>
</html>