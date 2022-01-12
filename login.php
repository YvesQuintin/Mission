<html>
    <head>
       <meta charset="utf-8">
        <link rel="icon" type="image/png" href="/img/icone.jpg" />
        <link rel="stylesheet" href="css/styleLog.css">
		<title>Se Connecter</title>
    </head>
    <body>
        <div id="container">
      
            <form action="verification.php" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="pseudo" required="required">

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required="required">

                <input type="submit" id='submit' value='Connexion' >
            
            </form>
        </div>
    </body>
</html>