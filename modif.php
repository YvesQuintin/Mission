<?php

$bdd = new PDO('mysql:host=localhost;dbname=bddpres_1_w3cam_fr',
'root',
''
);

if(isset($_POST['update'])) {

    $orderid = intval ($_GET['id_order']);
    $total_price_tax_incl = $_POST['total_price_tax_incl'];

    $requete = "UPDATE ps_order_detail SET total_price_tax_incl=:total_price_tax_in WHERE id_order=:nouvelleid";

    $query = $bdd->prepare($requete);
    $query ->bindParam(':total_price_tax_in',$total_price_tax_incl, PDO::PARAM_STR);
    $query ->bindParam(':nouvelleid',$orderid, PDO::PARAM_STR);
    $query ->execute();

    echo "<script>alert('Vous avez modifier une commande');</script>";
    echo "<script> window.location.href='commandeAxis.php'</script>";
}


?>
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de la Commande</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>

        <h1>Modification de la Commande </h1>
            <?php

            $orderid = intval ($_GET['id_order']);
            $requete ="SELECT id_order, product_name, total_price_tax_incl FROM ps_order_detail WHERE id_order=:nouvelleid";
            
            $query = $bdd ->prepare($requete);
            $query->bindParam(':nouvelleid', $orderid, PDO::PARAM_STR);
            $query->execute();

            $resultat= $query->fetchAll(PDO::FETCH_OBJ); ?>
           
           <div class="container">
<ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">ID</div>
      <div class="col col-2">Nom de la Commande</div>
      <div class="col col-3">Prix taxe inclus</div>
      
    </li> <?php
            foreach($resultat as $order) {

                

            ?>

    <li class="table-row">
                <div class="col col-1" data-label="id_product"><?php echo $order ->id_order; ?></div>
                <div class="col col-2" data-label="name"><?php echo $order->product_name; ?></div> 
                <form action="" method="POST">
                <div class="col col-3" data-label="price"><input type="text" name="price" id="" value="<?php echo $order->total_price_tax_incl;?>"></div>
                </form>  
                <?php } ?>
                </li> 
                <li class="table-row">
                <div class="col col-4" data-label="RETOUR"><input style="height: 50px;" onclick="history.go(-1)" id=button value="Retour"> </div>
                <div class="col col-4" data-label="RETOUR"><input  type="submit" style="margin-right:20%;height: 50px;" name="update" id="button" value="Modifier"></div>
            </li>
            </ul>
            </div>
</body>
</html>