<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
}
?>
<?php

$bdd = new PDO('mysql:host=localhost;dbname=bddpres_1_w3cam_fr',
'root',
''
);

if(isset($_POST['update'])) {

    $productid = intval ($_GET['id_product']);
    $price = $_POST['price'];
    $wholesale_price = $_POST['wholesale_price'];


    $requete = "UPDATE ps_product SET wholesale_price=:prix_achat, price=:prix_achat*1.4 WHERE id_product=:nouvelleid";

    $query = $bdd->prepare($requete);
    $query ->bindParam(':nouvelleid',$productid, PDO::PARAM_STR);
    $query ->bindParam(':prix_achat',$wholesale_price, PDO::PARAM_STR);
    $query ->execute();

    echo "<script>alert('Vous avez modifier un produit');</script>";
    echo "<script> window.location.href='prixHikvision.php'</script>";
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

        <h1>Modification du prix du produit</h1>
            <?php

            $productid = intval ($_GET['id_product']);
            $requete ="SELECT ps_product.id_product, name, price, wholesale_price FROM ps_product INNER JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product WHERE ps_product.id_product=:nouvelleid";
            
            $query = $bdd ->prepare($requete);
            $query->bindParam(':nouvelleid', $productid, PDO::PARAM_STR);
            $query->execute();

            $resultat= $query->fetchAll(PDO::FETCH_OBJ);

            foreach($resultat as $product) {

                

            ?>
             <div class="container">
<ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">ID</div>
      <div class="col col-2">Nom du Produit</div>
      <div class="col col-3">Prix d'achat</div>
      <!-- <div class="col col-3">Prix de vente</div> -->
      
    </li>
    <form action="" method="POST">
    <li class="table-row">
                <div class="col col-1" data-label="id_product"><?php echo $product ->id_product; ?></div>
                <div class="col col-2" data-label="name"><?php echo $product->name; ?></div> 
                <div class="col col-3" data-label="price_achat"><input type="text" name="wholesale_price" id="" value="<?php echo $product->wholesale_price;?>"></div>
                <!--<div class="col col-3" data-label="price_vente"><input type="text" name="price" id="" value="<?php echo $product->price;?>"></div>-->
                </li>  
                <?php } ?>
                </li> 
                <li class="table-row">
                <div class="col col-4" data-label="RETOUR"><input style="height: 50px;" onclick="history.go(-1)" id=button value="Retour"> </div>
                <div class="col col-4" data-label="RETOUR"><input  type="submit" style="margin-right:20%;height: 50px;" name="update" id="button" value="Modifier"></div>
            </li>
                </form>
            </ul>
            </div>
</body>
</html>