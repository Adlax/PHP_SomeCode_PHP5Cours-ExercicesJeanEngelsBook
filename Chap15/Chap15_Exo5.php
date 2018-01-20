<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/REC-html40/strict.dtd">
<html lang="fr">

<head>
  <title> Recherche des voitures d'un personne </title>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
      <legend> <b>Saisie d'un proprietaire</b> </legend>
        <tr> <td>Nom : </td> <td><input type="text" name="nom"/></td> </tr>
        <tr> <input type="submit" value="Chercher"/> </tr>
    </fieldset>
  </form>

  <?php
  if(isset($_POST['nom']))
  {
    include_once('connex.inc.php');
    $nom=$_POST['nom'];
    $requete="SELECT voitures.immat,modele.modele FROM voitures,modele,proprietaire,cartegrise WHERE proprietaire.nom='$nom' AND voitures.id_modele=modele.id_modele AND cartegrise.immat=voitures.immat AND proprietaire.id_pers=cartegrise.id_pers";
    $idcom=connex('voitures','myparam');
    $result=mysql_query($requete,$idcom);
    echo "<h3> Liste des vehicules de $nom </h3>";
    echo "<table border=\"1\">";
    while($ligne=mysql_fetch_array($result,MYSQL_NUM))
    {
      echo "<tr> <td>".$ligne[0]."</td> <td>".$ligne[1]."</td> <tr>";
    }
    echo "</table>";
  }
  else
  {
    echo "<h3> Remplissez le formulaire </h3>";
  }
  ?>

</body>

</html>
