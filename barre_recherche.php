<?php if(isset($_GET['s']) AND !empty($_GET['s'])) {
    $s = htmlspecialchars($_GET['s']);
    $orderStatement = $bdd->query("SELECT ps_orders.id_order, product_name, product_quantity, total_price_tax_incl, date_add, SUM(total_price_tax_incl) AS total_prix FROM ps_order_detail INNER JOIN ps_orders ON ps_order_detail.id_order = ps_orders.id_order WHERE product_name LIKE '%$s%' GROUP BY id_order ");
}
?> 

<form class="search" method="GET">
<input class="send" type="search" name="s" placeholder="Rechercher une commande" >
<button type="submit" value="envoyer">Rechercher</button>
</form>