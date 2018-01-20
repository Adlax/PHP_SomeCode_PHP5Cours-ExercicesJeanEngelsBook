<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/REC-html40/strict.dtd">
<html>

<head>
  <title> Recherche des proprietaire d\'un modele </title>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
      <legend> <b>Choisir le modele</b> </legend>
      <table>
        <tr> <td>Marque et modele</td> <td><input type="text" name="modele" maxlength=" "/></td> </tr>
        <tr> <td><input type="submit" value="Chercher"/></td> </tr>
      </table>
    </fieldset>
  </form>

  <?php
  if(isset($_POST['modele']))
  {
    include_once('connex.inc.php');
    $modele=($_POST['modele']);
    $requete="SELECT proprietaire.nom,proprietaire.prenom FROM voitures,modele,proprietaire,cartegrise WHERE modele LIKE '%$modele%' AND voitures.id_modele=modele.id_modele AND cartegrise.immat=voitures.immat AND proprietaire.id_pers=cartegrise.id_pers";
    $idcom=connex('voitures','myparam');
    $resultat=@mysql_query($requete,$idcom);
    echo "<table border=\"1\">";
    while($ligne=mysql_fetch_array($resultat,MYSQL_NUM))
    {
      echo "<tr> <td>$ligne[0]</td> <td>$ligne[1]</td> </tr>";
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
