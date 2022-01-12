<!DOCTYPE html>
<html>
 <head>
  <title>Prix HikVision</title>
 </head>
 <body>

 <?php
$row = 1;
if (($handle = fopen("W3CAM.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
        echo "<p> $num champs à la ligne $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}
?>


 </body>
</html>