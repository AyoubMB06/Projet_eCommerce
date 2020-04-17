
<?php 

session_start();

      if(isset($_SESSION["session_login"])){
        
        require('config.php');
        $query="select * from client where email='".$_SESSION['session_login']."' ";
        $result=mysqli_query($BD,$query);
        $row=mysqli_fetch_assoc($result);
        $nom=$row["nom"];
        $prenom=$row["prenom"];

       }


 ?>





<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <title>The MB Store</title>
        <link rel="shortcut icon" type="image/png" href="logo1.png">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="" name="keywords">
      <meta content="" name="description">

      <link href="favicon.ico" rel="shortcut icon">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
      <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <link href="lib/animate-css/animate.min.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <div id="preloader"></div>


  <section id="hero">
    <div class="hero-container">
      <div class="wow fadeIn">
        <div class="hero-logo">
          <img class="" src="img/logo1.png" alt="Imperial">
        </div>

        <h1>Welcome <?php if (! empty($prenom)) echo $prenom; ?> to MB store</h1>
        
        <h2>On offre <span class="rotating">nouvelle collection, prix raisonnables, livraison gratuite</span></h2>
        <div class="actions">
          <a href="Produits.php" class="btn-get-started">Commander</a>
          <a href="Contact.php" class="btn-services">Nous Contacter</a>
        </div>
      </div>
    </div>
  </section>

  
  <section id="subscribe">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-8">
          <h3 class="subscribe-title">Abonnez-vous pour recevoir les nouveautés.</h3>
          <p class="subscribe-text">Rejoignez nos +1000 abonnés et accédez aux derniers outils, cadeaux, annonces de produits et bien plus encore!</p>
        </div>
        <div class="col-md-4 subscribe-btn-container">
          <a class="subscribe-btn" href="#">Abonnez-vous maintenant!</a>
        </div>
      </div>
    </div>
  </section>




  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="#hero"><img src="img/logo1.png" alt="" title="" /></img></a>
 
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#hero">Acceuil</a></li>
          <li><a href="#about">A propos de nous</a></li>
          <li><a href="Produits.php" >Nos Produits</a></li>
          <li class="menu-has-children"><a href="#about">Mon Profil</a>
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
          <li><a href="Contact.php" >Contactez nous</a></li>
        </ul>
      </nav>

    </div>
  </header>

  <section id="about">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">A propos de nous</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Une société d'eCommerce qui vient parcourir le monde fashion</p>
        </div>
      </div>
    </div>
    <div class="container about-container wow fadeInUp">
      <div class="row">

        <div class="col-lg-6 about-img">
          <img src="img/ecomm.jpg" alt="">
        </div>

        <div class="col-md-6 about-content">
          <br></br>
          <br></br>
          <h2 class="about-title">Nous fournissons d'excellents services et promotions.</h2>
          <p class="about-text">
            Il y a plus de 3 ans, j'ai commencé à tout faire pour réaliser mon rêve et devenir créateur de mode. Tout d'abord commencé en tant que blogueur mode sur les réseaux sociaux et après cela, j'ai essayé de créer mon premier design de vêtements. Ceci est mon deuxième pop-up store avec le lancement d'une nouvelle collection.
          </p>
        </div>
      </div>
    </div>
  </section>


  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

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
