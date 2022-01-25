<?php if(isset($_GET['s']) AND !empty($_GET['s'])) {
    $s = htmlspecialchars($_GET['s']);
    $req1="SELECT ps_product.id_product,multiplicateur_value, ps_manufacturer.name as name_manu,ps_product_lang.name as name_pro, price, wholesale_price FROM ps_product INNER JOIN ps_manufacturer ON ps_product.id_manufacturer = ps_manufacturer.id_manufacturer INNER JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product WHERE ps_product_lang.name LIKE '%$s%' AND ps_product.active = 1 AND ps_manufacturer.active = 1 GROUP BY id_product";
    $productStatement = $bdd->query($req1);
}
?> 

<form class="search" method="GET">
<input class="send" type="search" name="s" placeholder="Rechercher un nom de produit" required >
<button type="submit" value="envoyer">Rechercher</button>
</form>