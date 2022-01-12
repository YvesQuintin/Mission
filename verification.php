<?php
session_start();
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=bddpres_1_w3cam_fr', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

if(isset($_POST['username']) && isset($_POST['password']))
{
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = htmlspecialchars($_POST['username']); 
    $password = htmlspecialchars($_POST['password']);

    $check = $bdd->prepare('SELECT username, password FROM user_connexion WHERE username = ?');
    $check->execute(array($username));
    $data = $check->fetch();
    $row = $check->rowCount();
    echo("0"); 
 if($row == 1)
   {   
        echo("1");
    if(filter_var($username, FILTER_VALIDATE_USERNAME))
      {
        echo("2");
         $password = hash('SHA256',$password);
         if($data['password'] === $password)
         {
            echo("3");
               $_SESSION['username'] = $data['pseudo'];
               header('Location:index.php');

         }else header('Location: login.php?login_err=password');
    
      } else header('Location: login.php?login_err=username'); 

   } else header('Location: login.php?err=already'); 

} else header('Location: index.php');

mysqli_close($db); // fermer la connexion
?>