<!DOCTYPE html>
<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" href="style1.css" media="screen" type="text/css" />
          <title>Inscription</title>
          <link rel="shortcut icon" type="image/png" href="logo1.png">

          <meta content="width=device-width, initial-scale=1.0" name="viewport">
          <meta content="" name="keywords">
          <meta content="" name="description">
          <link href="css/style.css" rel="stylesheet">
          <link href="favicon.ico" rel="shortcut icon">
          <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
          <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
          <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
          <link href="lib/animate-css/animate.min.css" rel="stylesheet">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <style>
              body{
                      background-image: url(img/wallpaper1.jpg);
                  }
            </style>
    </head>
    <header id="header">
        <div class="container">

          <div id="logo" class="pull-left">
            <a href="#hero"><img src="img/logo1.png" alt="" title="" /></img></a>
          </div>

          <nav id="nav-menu-container">
            <ul class="nav-menu">
              <li class="menu-active"><a href="index.php#hero">Acceuil</a></li>
              <li><a href="index.php#about">A propos de nous</a></li>
              <li><a href="Produits.php" >Nos Produits</a></li>
              <li><a href="Contact.php">Contactez nous</a></li>
              <li><a href="login.php" style="color:green;"><b>Se connecter</b></a>
            </ul>
          </nav>
        </div>
    </header>
 
<body>
        

<?php
session_start();
require('config.php');

    if(isset($_SESSION["session_login"])){
        header("location: index.php");
        exit;
    }

if (isset($_REQUEST['email'], $_REQUEST['password'], $_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['telephone'])){

    //supprimer les antislashes ajoutés par le formulaire
    $email = stripslashes($_REQUEST['email']); 
    $email = mysqli_real_escape_string($BD, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($BD, $password);
    $nom = stripslashes($_REQUEST['nom']);
    $nom = mysqli_real_escape_string($BD, $nom);
    $prenom = stripslashes($_REQUEST['prenom']);
    $prenom = mysqli_real_escape_string($BD, $prenom);
    $telephone = stripslashes($_REQUEST['telephone']);
    $telephone = mysqli_real_escape_string($BD, $telephone);
    

    function verifEmail($email){
        if (preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/im',$email)) 
            return true;
        else 
            return false;
    }

    function verifTelephone($telephone){
        if(preg_match("/^06[0-9]{8}$/im", $telephone))
            return true;
        else
            return false;
    }


    if(verifEmail($email) && verifTelephone($telephone)){

        $email_deja = "select * from client where email = '$email'";
        $telephone_deja = "select * from client where telephone = '$telephone'";

        $checkEmail = mysqli_num_rows(mysqli_query($BD,$email_deja));
        $checkTelephone = mysqli_num_rows(mysqli_query($BD,$telephone_deja));

        if($checkEmail OR $checkTelephone){
            if($checkEmail)
              $verifEmail_already="Adresse e-mail déjà utilisée.";         
            else
              $verifTéléphone_already="Numéro de téléphone déjà utilisé.";
        }
        else{
            $query = "INSERT into `client` (email, password, nom, prenom, telephone) 
                      VALUES ('$email', '$password', '$nom', '$prenom','$telephone')";
            mysqli_query($BD,$query);
            $_SESSION["session_login"] = $email;
            header("location: index.php");
        }

    }else{
        if(verifEmail($email)){
            $verifTelephone_message="Veuillez entrer un numéro de téléphone valide."; 
        }
        else
            $verifEmail_message="Veuillez entrer une adresse e-mail valide.";  
    }
    



    }
    ?>
      <div id="container">
            
                <p align="center" style="color:#FFEFD5"; class="glitch"><FONT size="5pt" backgrou>Bienvenue à MB Store</FONT></p>   
                <form action="register.php#container" method="POST">
                
                <label><b>Adresse e-mail</b></label>
                <input type="text" placeholder="Entrez le nom d'utilisateur" name="email" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrez le mot de passe" name="password" required>

                <label><b>Nom</b></label>
                <input type="text" placeholder="Entrez votre nom" name="nom" required>

                <label><b>Prénom</b></label>
                <input type="text" placeholder="Entrez votre prénom" name="prenom" required>

                <label><b>N° du téléphone (06..)</b></label>
                <input type="text" placeholder="Entrez votre Numéro de téléphone" name="telephone" required>

                <input type="submit" id='submit' value='Inscription' name="submit">
                <h6 align="center">Déjà inscrit? <a href="login.php">Connectez-vous ici</a>.</h6>
                
                <?php if (! empty($verifEmail_message)) { ?>
                    <p class="errorMessage"><?php echo $verifEmail_message; ?></p>
                <?php }else if(! empty($verifTelephone_message)) { ?>
                    <p class="errorMessage"><?php echo $verifTelephone_message; ?></p>
                <?php } ?>
                <?php if (! empty($verifEmail_already)) { ?>
                    <p class="errorMessage"><?php echo $verifEmail_already; ?></p>
                <?php }else if(! empty($verifTéléphone_already)) { ?>
                    <p class="errorMessage"><?php echo $verifTéléphone_already; ?></p>
                <?php } ?>
            </form>
        </div>
    </body>
</html>