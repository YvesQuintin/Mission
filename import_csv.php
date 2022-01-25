<?php
  // Connect to database
  $bdd = new PDO('mysql:host=localhost;dbname=bddpres_1_w3cam_fr',
  'root',
  ''
  );

  if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
      
      $file = fopen($fileName, "r");
      
      while (($column = fgetcsv($file, 100000, ";")) !== FALSE) {
      
        $name = $column[0];
        $wholesale_price = $column[1];
        $price = str_replace(',', '.', $wholesale_price);
        $sql ="UPDATE ps_product INNER JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product  SET ps_product.wholesale_price = '$price' WHERE ps_product_lang.name LIKE'%$name'";

          $result = $bdd->query($sql);

        if (! empty($result)) {
          $type = "success";
          $message = "Les Données sont importées dans la base de données";
        } else {
          $type = "error";
          $message = "Problème lors de l'importation de données CSV";
        }
      }
    }
  }
  //Retourner à la page index.php
  header('Location: prixHikvision.php');
  exit;
?>