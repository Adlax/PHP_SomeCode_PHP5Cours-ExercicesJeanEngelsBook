<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html:charset=UTF-8"/>
  <title> Recherche des voitures d'une personne </title>
</head>

<body>
  <form acton="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> <b> Qui ? </b> </legend>

        Nom : <input type="text" name="nom">
        <input type="submit" value="Cercher!">

    </fieldset>
  </form>

  <?php
  if(isset($_POST['nom']))
  {
    include_once('connex.inc.php');
    $nom=$_POST['nom'];
    $requete="SELECT voitures.immat,modele.modele FROM voitures,modele,proprietaire,cartegrise WHERE proprietaire.nom='$nom' AND proprietaire.id_pers=cartegrise.id_pers AND voitures.id_modele=modele.id_modele AND cartegrise.immat=voitures.immat";
    $idcom=connex('voitures','myparam');
    $result=@mysql_query($requete,$idcom);
    echo "<h3> les voitures de $nom sont : </h3>";
    echo "<table border=\"1\">";
    while($ligne=mysql_fetch_object($result))
    {
      echo "<tr> <td>$ligne->immat</td> <td>$ligne->modele</td> </tr>";
    }
    echo "</table>";
  }
  else
  {
    echo "Remplissez le form";
  }
  ?>

</body>

</html>
