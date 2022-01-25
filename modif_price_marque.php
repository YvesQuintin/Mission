<?php 
$bdd = new PDO('mysql:host=localhost;dbname=bddpres_1_w3cam_fr',
'root',
''
);
if(isset($_POST['updatemarque'])) {

$name = $_GET['name'];
$wholesale_price = $_POST['wholesale_price'];
$id = $_GET['id_product'];

$update = $bdd->prepare("UPDATE ps_product INNER JOIN ps_manufacturer ON ps_product.id_manufacturer = ps_manufacturer.id_manufacturer 
SET wholesale_price= ?, price = ROUND ((wholesale_price*multiplicateur_value)*2.0)/2 WHERE id_product = ? AND ps_manufacturer.name = '$name' ");

$update->execute(array($wholesale_price, $id));
}
if(isset($_POST['update'])) {
        $name = $_GET['name'];
        $update = $bdd->prepare("UPDATE ps_product INNER JOIN ps_manufacturer ON ps_product.id_manufacturer = ps_manufacturer.id_manufacturer 
        SET price = ROUND ((wholesale_price*multiplicateur_value)*2.0)/2 WHERE ps_manufacturer.name = '$name' ");
        $update->execute();
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification du prix du produit</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>

        <h1>Modification des prix de <?php echo $_GET['name']?></h1>
           
        
        <?php

$name = $_GET['name'];
$marquemodif = $bdd->query("SELECT ps_manufacturer.name as name_manu,
                      ps_product_lang.name as name_pro,
                      price, 
                      wholesale_price, 
                      ps_product.id_product 
                      FROM ps_product 
                      INNER JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product
                      INNER JOIN ps_manufacturer ON ps_product.id_manufacturer = ps_manufacturer.id_manufacturer 
                      WHERE ps_product.active = 1 AND ps_manufacturer.active = 1 AND  ps_manufacturer.name ='$name'");


        ?>
<div class="container">
    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-1">ID</div>
            <div class="col col-2">Nom de la marque</div>
            <div class="col col-3">Prix d'achat</div>
            <div class="col col-3">Prix de Vente</div>
        </li>

      <?php  while($product = $marquemodif->fetch()) {?>
        <form id="form_chat" method="POST" action="modif_price_marque.php?name=<?= $_GET['name'];?>&id_product=<?= $product['id_product'];?>">
        <li class="table-row">
                <div class="col col-1" data-label="id_product"><?php echo $product['id_product']; ?></div>
                <div class="col col-2" data-label="name"><?php echo $product['name_manu']; ?></div> 
                <div class="col col-2" data-label="name"><?php echo $product['name_pro']; ?></div> 
                <div class="col col-3" data-label="price_achat"><input type="text" name="wholesale_price" id="" value="<?php echo $product['wholesale_price'];?>"></div>
                <div class="col col-3" data-label="price"><?php echo $product['price'];?></div>
                <div class="col col-4" data-label="Modifier"><input  type="submit" style="margin-right:20%;height: 50px;" name="updatemarque" id="button" value="Modifier"></div>
        </li>
        </form>
                <?php } ?>
        <li class="table-row">
                <div class="col col-4" data-label="RETOUR"><input style="height: 50px;" onclick="history.go(-1)" id=button value="Retour"> </div>
                <div class="col col-4" data-label="RETOUR"><a href="produit_marque.php"><span style="height: 50px;" id=button value="Accueil">Accueil</span></a></div>
                <form method="POST" action="">
                <div class="col col-4" data-label="Modifier"><input  type="submit" style="height: 50px;" name="update" id="button" value="Modifier prix de vente"></div>
      </form>
        </li>
    </ul>
    
</div>
</body>
</html>