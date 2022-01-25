<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>
<?php

$bdd = new PDO(
    'mysql:host=localhost;dbname=bddpres_1_w3cam_fr',
    'root',
    ''
);

if (isset($_POST['update'])) {

    
    $nom = $_GET['name'];
    $wholesale_price = $_POST['wholesale_price'];
    $productid = intval($_GET['id_product']);

    if (isset($_GET['name']) && !empty($_GET['name']) && $_GET['multiplicateur_value'] == 1.4 ) {
        $requete = "UPDATE ps_product INNER JOIN ps_manufacturer ON ps_manufacturer.id_manufacturer = ps_product.id_manufacturer 
    SET wholesale_price=:prix_achat, price= ROUND (:prix_achat*multiplicateur_value) WHERE id_product like :newsid";

    } elseif (isset($_GET['name']) && !empty($_GET['name']) && $_GET['multiplicateur_value'] == 1.3) {
        $requete = "UPDATE ps_product INNER JOIN ps_manufacturer ON ps_manufacturer.id_manufacturer = ps_product.id_manufacturer 
    SET wholesale_price=:prix_achat, price= ROUND (:prix_achat*multiplicateur_value) WHERE id_product like :newsid";

    } else {
        $price = $_POST['price'];
        $requete = "UPDATE ps_product INNER JOIN ps_manufacturer ON ps_manufacturer.id_manufacturer = ps_product.id_manufacturer 
    SET wholesale_price=:prix_achat, price=:prix_vente WHERE id_product like :newsid";
    }
    $query = $bdd->prepare($requete);
    $query->bindParam(':newsid', $productid, PDO::PARAM_STR);
    $query->bindParam(':prix_achat', $wholesale_price, PDO::PARAM_STR);
    $query->bindParam(':prix_vente', $price, PDO::PARAM_STR);

    $query->execute();
    
    
    // echo "<script> window.location.href='produit_marque.php'</script>";
}


?>

<!DOCTYPE html>


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification du prix du produit</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" type="image/png" href="/img/w3cam-logo.jpg" />
</head>

<body>



    <h1>Modification du prix du produit</h1>
    <?php
    $nom = $_GET['name'];
    $productid = intval($_GET['id_product']);
    $requete = "SELECT ps_product.id_product, name, price, wholesale_price FROM ps_product INNER JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product WHERE ps_product.id_product=:nouvelleid";

    $query = $bdd->prepare($requete);
    $query->bindParam(':nouvelleid', $productid, PDO::PARAM_STR);
    $query->execute();

    $resultat = $query->fetchAll(PDO::FETCH_OBJ);

    foreach ($resultat as $product) {



    ?>
        <div class="container">
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-1">ID</div>
                    <div class="col col-2">Nom du Produit</div>
                    <div class="col col-3">Prix d'achat</div>
                    <div class="col col-3">Prix de vente</div>

                </li>
                <form action="" method="POST">
                    <li class="table-row">
                        <div class="col col-1" data-label="id_product"><?php echo $product->id_product; ?></div>
                        <div class="col col-2" data-label="name"><?php echo $product->name; ?></div>
                        <div class="col col-3" data-label="price_achat"><input type="text" name="wholesale_price" id="" value="<?php echo $product->wholesale_price; ?>"></div>
<?php
                         

                        if (isset($_GET['name']) && !empty($_GET['name']) && $_GET['multiplicateur_value'] == 1) 
                        { ?>
                            <div class="col col-3" data-label="price_vente"><input type="text" name="price" id="" value="<?php echo $product->price; ?>"></div>
                            
                        <?php
                        $requete = "UPDATE ps_product INNER JOIN ps_manufacturer ON ps_manufacturer.id_manufacturer = ps_product.id_manufacturer 
                        INNER JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product
                        SET price=:prix_vente, WHERE id_product like :newsid";
                         } 
                        else 
                        { ?>
                            <div class="col col-3" data-label="price_vente"><?php echo $product->price; ?></div>
                        <?php 
                    }  ?>
                    </li>
                <?php 
            }?>
                </li>
                <li class="table-row">
                    <div class="col col-4" data-label="RETOUR"><input style="height: 50px;" onclick="history.go(-1)" id=button value="Retour"> </div>
                    <div class="col col-4" data-label="RETOUR"><input type="submit" style="margin-right:20%;height: 50px;" name="update" id="button" value="Modifier"></div>
                </li>
                </form>
            </ul>
        </div>
</body>

</html>