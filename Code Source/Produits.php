
<?php 

session_start(); 
require 'config.php';

        $query="select * from produit";
        $result=mysqli_query($BD,$query);


?>


<!DOCTYPE html>
 
 <head>
      <meta charset="utf-8">
      <title>Nos Produits</title>
      <link rel="shortcut icon" type="image/png" href="logo1.png">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="" name="keywords">
      <meta content="" name="description">
      <link href="css/style.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
      <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
              <li><a href="#" >Nos Produits</a></li>
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
              <li><a href="Contact.php" >Contactez nous</a></li>
            </ul>
          </nav>
          <!-- #nav-menu-container -->
        </div>
    </header>



    <section id="portfolio">
        <div class="container wow fadeInUp">
          <div class="row">
            <div class="col-md-12">
              <h3 class="section-title">Nos Produits</h3>
              <div class="section-title-divider"></div>
              <p class="section-description"><FONT size="4">Ci-dessous, vous pouvez voir les produits les plus appréciés. Vous trouverez tout d'entre eux dans notre store.</FONT></p>
            </div>
          </div>

          <?php  
            
            while($data=$result->fetch_assoc()){ 
                $promo = $data['prix']+40;
             ?>
              
              
    <div class="col-md-3 col-sm-6 my-3 my-md-0">
                    <form action="Panier.php\" method="get">
                        <div class="card shadow">
                            <div>
                                <img src="<?php echo $data['image'] ?>" alt="Image1" class="img-fluid card-img-top">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title"><b><?php echo $data['nomProd'] ?></b></h3>
                                <h4>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </h4>
                                
                                <h3>
                                    <small><s class="text-secondary"><?php echo $promo ?> MAD</s></small>
                                    <span class="price"><?php echo $data['prix'] ?> MAD</span>
                                </h3>
                                <!-- <input type="text" name="qte" value="1" class="qteprod" style="height:30px; width: 50px; size: 2em;"> -->
                                <!-- <button type="submit" class="btn btn-warning my-3"><h5>Ajouter au panier </h5><i class="fas fa-shopping-cart"></i></button> -->
                                <a href="panier.php?action=ajout&amp;l=<?php echo $data['nomProd'] ?>&amp;q=1&amp;p=<?php echo $data['prix'] ?>&amp; i=<?php echo $data['numProd'] ?>" class="btn btn-warning my-3"><h5>Ajouter au panier </h5><i class="fas fa-shopping-cart"></i></a>
                                 <input type='hidden' name='id' value='<?php echo $data['numProd'] ?>'>
                            </div>
                        </div>
                    </form>
                </div>

          <?php } ?>

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