<?php try
{
    $bdd = new PDO('mysql:host=localhost;dbname=bddpres_1_w3cam_fr', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

 if(isset($_GET['a']) AND !empty($_GET['a'])) {
$requete="SELECT ps_product.id_product, ps_manufacturer.name as name_manu,ps_product_lang.name as name_pro, price FROM ps_product INNER JOIN ps_manufacturer ON ps_product.id_manufacturer = ps_manufacturer.id_manufacturer INNER JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product WHERE ps_manufacturer.id_manufacturer=".$_GET['marque']);
 }else{
$requete="SELECT ps_product.id_product, ps_manufacturer.name as name_manu,ps_product_lang.name as name_pro, price FROM ps_product INNER JOIN ps_manufacturer ON ps_product.id_manufacturer = ps_manufacturer.id_manufacturer INNER JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product");
}

