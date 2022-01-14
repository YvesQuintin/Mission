<?php
session_start();
if(isset($_SESSION['email'])){
    header("Location: index.php");
    exit;
}
?>
<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=bddpres_1_w3cam_fr', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

if(isset($_POST['email']) && isset($_POST['passwd']))
{
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $email = htmlspecialchars($_POST['email']); 
    $passwd = htmlspecialchars($_POST['passwd']);

    $check = $bdd->prepare('SELECT email, passwd FROM ps_employee WHERE email = ?');
    $check->execute(array($email));
    $data = $check->fetch();
    $row = $check->rowCount(); 
 if($row == 1)
   {   
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
      {
        $password = hash('SHA256',$password);
         if($data['passwd'] === $passwd)
         {
               $_SESSION['email'] = $data['email'];
               header('Location:index.php');

         }else header('Location: login.php?login_err=passwd');
    
      } else header('Location: login.php?login_err=email'); 

   } else header('Location: login.php?err=already'); 

} else header('Location: login.php');

mysqli_close($bdd); // fermer la connexion
?>