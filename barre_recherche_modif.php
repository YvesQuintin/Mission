<?php if(isset($_GET['s']) AND !empty($_GET['s'])) {
    $s = htmlspecialchars($_GET['s']);
    $productStatement = $bdd->query("SELECT ps_product.id_product, name, price, wholesale_price FROM ps_product INNER JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product WHERE name LIKE '%$s%' GROUP BY id_product");
}
?> 

<form class="search" method="GET">
<input class="send" type="search" name="s" placeholder="Rechercher un nom de produit" required >
<button type="submit" value="envoyer">Rechercher</button>
</form>