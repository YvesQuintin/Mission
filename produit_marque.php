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
    <title>Liste des produit par marque</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
	    <?php include('header.php');?>
    

   
    <h1> Liste des produit par marque </h1>

<?php
$bdd = new PDO('mysql:host=localhost;dbname=bddpres_1_w3cam_fr',
'root',
''
);
    
$nbr_commandes = 20;
$TotalesCommandesReq = $bdd->query('SELECT id_manufacturer FROM ps_product');
$TotalesCommandes = $TotalesCommandesReq->rowCount();
$pagesTotales = ceil($TotalesCommandes/$nbr_commandes);

if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] < $pagesTotales){
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
} else { 
    $pageCourante = 1;
}


    $depart = ($pageCourante-1)*$nbr_commandes;

    if(isset($_GET['name_pro']) AND !empty($_GET['name_pro'])) {
        $productStatement = $bdd->query("SELECT ps_product.id_product, ps_manufacturer.name as name_manu,ps_product_lang.name as name_pro, price FROM ps_product INNER JOIN ps_manufacturer ON ps_product.id_manufacturer = ps_manufacturer.id_manufacturer INNER JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product WHERE ps_manufacturer.id_manufacturer=".$_GET['name_pro']." LIMIT $depart, $nbr_commandes");
    }else{
    $productStatement =$bdd->query("SELECT ps_product.id_product, ps_manufacturer.name as name_manu,ps_product_lang.name as name_pro, price FROM ps_product INNER JOIN ps_manufacturer ON ps_product.id_manufacturer = ps_manufacturer.id_manufacturer INNER JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product LIMIT $depart, $nbr_commandes");
}
    ?>

<?php include('barre_recherche_modif.php');?>

<div class="container">
<ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">ID</div>
      <div class="col col-2">Nom de la marque
      <form method="GET" action="" >      
      <select name="name_pro" id="name_pro">
                <option value="">Toutes</option>
                <option value="1">AXIS COMMUNICATIONS</option>
                <option value="2">Camtrace</option>
                <option value="4">Netgear</option>
                <option value="6">Nec</option>
                <option value="7">VERACITY</option>
                <option value="8">HIKVISION</option>
                <option value="10">MILESTONE</option>
                <option value="11">SYNOLOGY</option>
                <option value="12">WESTERN DIGITAL</option>
                <option value="13">UBIQUITI</option>
                <option value="14">RAYTEC</option>
                <option value="15">Micro Connect</option>
                <option value="16">SONY</option>
                <option value="17">BOSCH</option>
                <option value="18">CANON</option>
                <option value="19">ASUS</option>
                <option value="20">POWERWALKER</option>
                <option value="21">EZVIZ</option>
                <option value="22">PLANET</option>
                <option value="23">Non défini</option>
                <option value="24">ATEN</option>
                <option value="25">MikroTik</option>
                <option value="26">Trendnet</option>
                <option value="27">W3CAM</option>
                <option value="28">Logitech</option>
                <option value="29">VIDEOTEC</option>
                <option value="30">MSTronic</option>
                <option value="31">ARLO</option>
                <option value="32">HANWHA</option>
                <option value="33">MOXA</option>
                <option value="34">VIVOLINK</option>
                <option value="36">Samsung</option>
            </select>
            <input type="submit" name="bouton" id="bouton" value="Envoyer"/>
</form>
      </div>
      <div class="col col-2">Nom du produit</div>
      <div class="col col-3">Prix du Produit</div>
      <div class="col col-4">MODIFIER</div>
      
    </li>

         <?php while ( $product =  $productStatement->fetch()){?>
                                     
    <li class="table-row">
        <div class="col col-1" data-label="id_product"><?php echo $product['id_product'] ?></div>
        <div class="col col-2" data-label="ps_manufacturer.name"><?php echo $product['name_manu'] ?></div>
        <div class="col col-2" data-label="ps_product_lang.name"><?php echo $product['name_pro'] ?></div>
        <div class="col col-3" data-label="price"><?php echo '&emsp;'.'&emsp;'.  $product['price'] ?></div>
        <div class="col col-4" data-label="MODIFIER"><a href="modif_marque.php?id_product=<?php echo $product['id_product'];?>"><span id=button>Modifier</span id=button> </a>                                      
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
     echo '<a href="produit_marque.php?page='.$i.'">'.$i.'</a>&nbsp &nbsp';
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