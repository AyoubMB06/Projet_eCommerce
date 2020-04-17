<?php 

session_start();
include_once("fonctions-panier.php");
include ('config.php');

    if(!isset($_SESSION["session_login"])){
        header("location: login.php");
        exit;
    }

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Mon Panier</title>
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
            body {
              background-image: url(img/panier.jpg);
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
              <li><a href="logout.php" style="color:red;"><b>Se déconnecter</b></a></li>
            </ul>
          </nav>
          <!-- #nav-menu-container -->
        </div>
    </header>

<?php

$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

   //récupération des variables en POST ou GET
   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;
   $i = (isset($_POST['i'])? $_POST['i']:  (isset($_GET['i'])? $_GET['i']:null )) ;

   $l = preg_replace('#\v#', '',$l);
   $p = floatval($p);

   //On traite $q qui peut être un entier simple ou un tableau d'entiers
    
   if (is_array($q)){
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu){
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
    
}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($l,$q,$p);
         break;

      Case "suppression":
         supprimerArticle($l);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}

echo '<?xml version="1.0" encoding="utf-8"?>';?>


<body>

      <form method="post" action="panier.php">
          <table class="blueTable">
              <tr>
                  <td colspan="4">Votre panier</td>
              </tr>
              <tr>
                  <td>Nom</td>
                  <td>Quantité</td>
                  <td>Prix Unitaire</td>
                  <td>Action</td>
              </tr>


              <?php
              if (creationPanier())
              {
                 $nbArticles=count($_SESSION['panier']['libelleProduit']);
                 if ($nbArticles <= 0)
                 echo "<tr><td style=\"color:red;\"><b>Votre panier est vide! </b></ td></tr>";
                 else
                 {
                    for ($i=0 ;$i < $nbArticles ; $i++)
                    {
                       echo "<tr>";
                       echo "<td><b>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</b></ td>";
                       echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
                       echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
                       echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\" style=\"color:red;\">Supprimer</a></td>";
                       echo "</tr>";
                    }

                    $total_final = MontantGlobal();
                    echo "<tr><td colspan=\"2\"> </td>";
                    echo "<td colspan=\"2\">";
                    echo "<b>Total : $total_final <b>";
                    echo "</td></tr>";
                    echo "<tr><td colspan=\"4\">";
                    echo "<input type=\"submit\" class=\" btn-sm\" value=\"Actualiser\"/>";
                    

                    echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

                    echo "</td></tr>";
                    
                    echo "<h1 align=\"center\"><a href=\"finaliser.php?action=finaliser&amp;total=$total_final&amp;total_nb=$nbArticles\"\" class=\"btn btn-warning\">Valider la commande</a></h1><br>";
                 }
              }
              ?>
          </table>
              <h1 align="center"><a href="produits.php" class="btn btn-primary btn-sm">Ajouter d'autres articles</a></h1>";

      </form>
</body>
</html>