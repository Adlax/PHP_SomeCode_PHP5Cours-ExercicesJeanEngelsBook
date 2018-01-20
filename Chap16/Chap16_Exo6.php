<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <title> Recherche des voitures d'une personne </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> Coordonnées d'une personne </legend>
      <table>
        <tr> <td>Nom ; </td> <td><input type="text" name="nom"></td> </tr>
        <tr> <td>Prenom : </td> <td><input type="text" name="prenom"></td> </tr>
        <tr> <td><input type="submit" value="Chercher!"></td> </tr>
      </table>
    </fieldset>
  </form>

  <?php
  if(isset($_POST['nom']) && isset($_POST['prenom']))
  {
    include('connexobject.inc.php');
    $idcom=connexobject("voitures","myparam");
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $requete="SELECT voitures.immat,modele.modele FROM proprietaire,cartegrise,voitures,modele WHERE proprietaire.nom='$nom' AND proprietaire.prenom='$prenom' AND proprietaire.id_pers=cartegrise.id_pers AND cartegrise.immat=voitures.immat AND voitures.id_modele=modele.id_modele";
    $result=$idcom->query($requete);
    echo "<h3> Liste des voitures appartenant a $prenom $nom : </h3>";
    echo "<table border=\"3\">";
    while($ligne=$result->fetch_object())
    {
      echo "<tr> <td>$ligne->immat</td> <td>$ligne->modele</td> </tr>";
    }
    echo "</table>";
  }
  else
  {
    echo "<h3>Remplir le Formulaire</h3>";
  }
  ?>

  </body>

  </html>
