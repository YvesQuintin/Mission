<html>
<head>
  <title>W3CAM</title>
  <link rel="stylesheet" href="css/style.css"/>
  <link rel="icon" type="image/png" href="/img/w3cam-logo.jpg" />
  <img src="/img/w3cam-logo.jpg" alt="logo W3CAM" class="logo"/>
</head> 
<body>
</div>
<div class="bar-navigation">
        <nav class="main-navigation">
            <div class="nav-menu">
                <ul>
                    <li>
                        <a href="#">Info commande</a>
                        <ul class='children'>
                            <li><form name="commandeAxis" action="commandeAxis.php" method="GET">
                                <input id="tete" type ="submit" value = "Commande AXIS"></form></li>
                            <li><form name="commandeHikvision" action="commandeHikvision.php" method="GET">
                                <input id="tete" type ="submit" value = "Commande HikVision"></form></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Marque Produit</a>
                        <ul class='children'>
                            <li><form name="selection par marque" action="produit_marque.php" method="GET">
                                <input id="tete" type ="submit" value = "Modification des prix pour une marque"></form></li>
                        </ul>
                        </li>
                    <li>
                        <a href="#">Modification Prix HikVision</a>
                        <ul class='children'>
                            <li><form name="prixHikvision" action="prixHikvision.php" method="GET">
                                <input id="tete" type ="submit" value = "Modification Prix HIKVISION"></form></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Produit en Stock</a>
                        <ul class='children'>
                            <li>
                                <form name="produitStock" action="produitStock.php" method="GET">
                                <input id="tete" type ="submit" value = "Produit en Stock"></form></li>
                            <li> 
                                <form name="produitQuantiteLimite" action="produitQuantiteLimite.php" method="GET">
                                <input id="tete" type ="submit" value = "Produit en Stock Limite"></form></li>
                        </ul>
                    </li>
                    <li>
                        <a href="Deconnexion.php">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>