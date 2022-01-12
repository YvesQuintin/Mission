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
    <div class="liste">
        <div>
            <div>

            <?php

            $orderid = intval ($_GET['id_order']);
            $requete ="SELECT id_order, product_name, total_price_tax_incl FROM ps_order_detail WHERE id_order=:nouvelleid";
            
            $query = $bdd ->prepare($requete);
            $query->bindParam(':nouvelleid', $orderid, PDO::PARAM_STR);
            $query->execute();

            $resultat= $query->fetchAll(PDO::FETCH_OBJ);

            foreach($resultat as $order) {

                

            ?>

                <form action="" method="POST">
                    ID Commande : 
                    <?php echo $order ->id_order; ?> </br> </br>
                    Nom Commande :
                    <?php echo $order->product_name; ?> </br> </br>
                    Prix Commande :     <input type="text" name="total_price_tax_incl" id="" value="<?php echo $order->total_price_tax_incl; '</br>' ?>">
                    <input type="submit" style="margin-right:20%;" name="update" id="button" value="Modifier">
                    <?php } ?>

                </form>
            </div>
        </div>
    </div>
</body>
</html>