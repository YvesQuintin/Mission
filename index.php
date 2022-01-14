<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
}
?>
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
                                <input id="tete" type ="submit" value = " Commande AXIS"></li>
                            <li><form name="commandeHikvision" action="commandeHikvision.php" method="GET">
                                <input id="tete" type ="submit" value = " Commande HikVision"></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Ubitech</a></li>
                    <li>
                        <a href="#">Modification Prix HikVision</a>
                        <ul class='children'>
                            <li><form name="prixHikvision" action="prixHikvision.php" method="GET">
                                <input id="tete" type ="submit" value = "Modification Prix HIKVISION"></form></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Document Forcast JC</a>
                    </li>
                    <li>
                    <a href="Deconnexion.php">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>