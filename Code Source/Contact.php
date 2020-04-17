<?php
session_start();
require('config.php');


if (isset($_REQUEST['nom'], $_REQUEST['email'], $_REQUEST['sujet'], $_REQUEST['message'])){

    //supprimer les antislashes ajoutés par le formulaire
    $nom = stripslashes($_REQUEST['nom']);
    $nom = mysqli_real_escape_string($BD, $nom);
    $email = stripslashes($_REQUEST['email']); 
    $email = mysqli_real_escape_string($BD, $email);
    $sujet = stripslashes($_REQUEST['sujet']);
    $sujet = mysqli_real_escape_string($BD, $sujet);
    $message = stripslashes($_REQUEST['message']);
    $message = mysqli_real_escape_string($BD, $message);
    

    $query = "INSERT into `commentairesClient` ( nomClient ,  emailClient ,  sujetClient , Message) 
              VALUES ('$nom', '$email', '$sujet', '$message')";
    mysqli_query($BD,$query);

}

?>


 <!DOCTYPE html>
 
 <head>
      <meta charset="utf-8">
      <title>Contactez-nous</title>
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="" name="keywords">
      <meta content="" name="description">

      <link href="css/style.css" rel="stylesheet">
      <link href="favicon.ico" rel="shortcut icon">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
      <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <link href="lib/animate-css/animate.min.css" rel="stylesheet">
</head>

<body>
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
              <li class="menu-has-children"><a href="">Mon Profil</a>
                <?php  
                  if(isset($_SESSION["session_login"])){
                ?>  
                <ul>
                  <li><a href="panier.php">Mon Panier</a></li>
                  <li><a href="logout.php" style="color:red;"><b>Se déconnecter</b></a></li>
                </ul>
                <?php } 
                    else{   ?>  
                <ul>
                  <li><a href="login.php" style="color:green;"><b>Se connecter</b></a></li>
                  <li><a href="panier.php">Mon Panier</a></li>
                </ul>
                <?php } ?>
              </li>
              <li><a href="#" >Contactez nous</a></li>
            </ul>
          </nav>
        </div>
      </header>


      <section id="contact">
        <div class="container wow fadeInUp">
          <div class="row">
            <div class="col-md-12">
              <h3 class="section-title">Contactez nous</h3>
              <div class="section-title-divider"></div>
              <p class="section-description">Laissez nous vos commentaires!</p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-md-push-2">
              <div class="info">
                <div>
                  <i class="fa fa-map-marker"></i>
                  <p>N°107 Quartier Rmel <br>V Tarrast, Inezgane</p>
                </div>

                <div>
                  <i class="fa fa-envelope"></i>
                  <p>info@exemple.com</p>
                </div>

                <div>
                  <i class="fa fa-phone"></i>
                  <p>+212(6) 78 35 31 66</p>
                </div>

              </div>
            </div>

            <div class="col-md-5 col-md-push-2">
              <div class="form">
                <div id="sendmessage">Ton message a été envoyé, Merci!</div>
                <div id="errormessage"></div>
                <form action="#" method="POST">
                  <div class="form-group">
                    <input type="text" name="nom" class="form-control" id="name" placeholder="Nom" data-rule="minlen:4" data-msg="Entrez au moins 4 caractères" />
                    <div class="validation"></div>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Entrez un email valide" />
                    <div class="validation"></div>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="sujet" id="subject" placeholder="Sujet" data-rule="minlen:4" data-msg="Entrez au moins 8 caractères à propos du sujet" />
                    <div class="validation"></div>
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Ecrivez quelque chose pour nous" placeholder="Message"></textarea>
                    <div class="validation"></div>
                  </div>
                  <div class="text-center">
                      <button type="submit">Envoyez le commentaire</button>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </section> 


    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/superfish/hoverIntent.js"></script>
    <script src="lib/superfish/superfish.min.js"></script>
    <script src="lib/morphext/morphext.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/stickyjs/sticky.js"></script>
    <script src="lib/easing/easing.js"></script>
    <script src="js/custom.js"></script>
    <script src="contactform/contactform.js"></script>

</body>

</html>