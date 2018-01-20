<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Recherche des voitures d'une personne </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> Entrez un nom et un prenom </legend>
      <table>
        <tr>
          <td> Nom ; </td>
          <td> <input type="text" name="nom" size="40" maxlength="30"/> </td>
        </tr>
        <tr>
          <td> Prenom ; </td>
          <td> <input type="text" name="prenom" size="40" maxlength="30"/> </td>
        </tr>
        <tr>
          <td> <input type="submit" value="Chercher!"/> </td>
        </tr>
      </table>
    </fieldet>
  </form>

  <?php
  if( isset($_POST['nom']) && isset($_POST['prenom']) )
  {
    include_once('connexpdo.inc.php');
    $idcom=connexpdo("voitures","myparam");
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $requete="SELECT voitures.immat,modele.modele FROM proprietaire,cartegrise,voitures,modele WHERE proprietaire.id_pers=cartegrise.id_pers AND cartegrise.immat=voitures.immat AND voitures.id_modele=modele.id_modele AND proprietaire.nom=$nom AND proprietaire.prenom=$prenom";
    $result=$idcom->query($requete);
    echo "<h3> Les voitures appartenant a $nom $prenom </h3>";
    echo "<table border=\"4\">";
    while($ligne=$result->fetchObject())
    {
      echo "<tr> <td>$ligne->immat</td> <td>$igne->modele</td> </tr>";
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
