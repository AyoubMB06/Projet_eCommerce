<?php 

session_start();
include_once("fonctions-panier.php");
include ('config.php');

if(!isset($_SESSION["session_login"])){
        header("location: login.php");
        exit;
    }

$date = date("F j, Y, g:i a");
$total_nb=$_GET['total_nb'];
$total=$_GET['total'];
$DetailsCommande=" ";

for ($i=0 ;$i < $total_nb ; $i++)
          {
          	$DetailsCommande.= " ".$_SESSION['panier']['qteProduit'][$i] ."*".$_SESSION['panier']['libelleProduit'][$i]." + ";
          }

        $query="select * from client where email='".$_SESSION['session_login']."' ";
        $result=mysqli_query($BD,$query);
        $row=mysqli_fetch_assoc($result);
        $nom=$row["nom"];
        $prenom=$row["prenom"];
        $email=$row["email"];

        $query1 = "INSERT into `panier` (email, DetailsCommande, dateAchat, total) 
                   VALUES ('$email', '$DetailsCommande', '$date', '$total')";
        $result1=mysqli_query($BD,$query1);

        unset($_SESSION['panier']);

?>

<!DOCTYPE html>
 
		 <head>
				  <meta charset="utf-8">
				  <title>Finalisation Commande</title>
				  <link rel="shortcut icon" type="image/png" href="logo1.png">
				  <meta content="width=device-width, initial-scale=1.0" name="viewport">
				  <meta content="" name="keywords">
				  <meta content="" name="description">
				  <link href="css/style.css" rel="stylesheet">
				  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
				  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
				  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
				  <link href="lib/animate-css/animate.min.css" rel="stylesheet">
		            <style>
					  		body{
					          background-image: url(img/wallpaper1.jpg);
					      	}
		            </style>
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
		          <li><a href="Contact.php" >Contactez nous</a></li>
		          <li><a href="logout.php" style="color:red;">Se déconnecter</a></li>
		        </ul>
		      </nav>
		    </div>
		</header>

<body>

	<?php if($result1){ ?>

		 	 <section id="hero1">
			    <div class="hero1-container">
			      <div class="wow fadeIn">
			        <div class="hero1-logo">
			          <img class="" src="img/confirmedlogo.png" alt="Imperial">
			        </div>

			        <h1>Merci <?php if (! empty($prenom)) echo $prenom; ?> pour votre commande!</h1>
			        
			        <h2>Nos marchandises sont déjà en route, A très bientôt,  :)</span></h2>
			        <div class="actions">
			          <a href="logout.php" class="btn-get-started"><b>Se déconnecter</b>/a>
			          <a href="Contact.php" class="btn-services">Nous Contacter</a>
			        </div>
			      </div>
			    </div>
  			</section>

	<?php }else{ ?>



		 	 <section id="hero1">
			    <div class="hero1-container">
			      <div class="wow fadeIn">
			        <div class="hero1-logo">
			          <img class="" src="img/erreurlogo.jpg" alt="Imperial">
			        </div>

			        <h1>Oops <?php if (! empty($prenom)) echo $prenom; ?>, une erreur s'est produite.<br> 
			        Veuillez contacter un administrateur!</h1>
			        
			        <h2>On est vraiment DESOLE</span></h2>

			        <div class="actions">
			          <a href="panier.php" class="btn-get-started">Mon Panier</a>
			          <a href="Contact.php" class="btn-services">Nous Contacter</a>
			        </div>
			      </div>
			    </div>
  			</section>


	<?php } ?>

	
</body>
</html>