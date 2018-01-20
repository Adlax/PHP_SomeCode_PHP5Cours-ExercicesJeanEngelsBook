<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <title> Recherche des propriétés d'un modele </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> <b>Choisir le modele</b> </legend>
      <table>
        <tr> <td>Modele et Marque</td> <td><input type="text" size="30" name="modele"></td> </tr>
        <tr> <td><input type="submit" name="cherchemod" value="Cercher!"></td> </tr>
      </table>
    </fieldset>
  </form>

  <?php
  if(isset($_POST['modele']))
  {
    include('connexobject.inc.php');
    $modele=$_POST['modele'];
    $requete="SELECT proprietaire.nom,proprietaire.prenom FROM proprietaire,cartegrise,voitures,modele WHERE modele LIKE '%$modele%' AND proprietaire.id_pers=cartegrise.id_pers AND cartegrise.immat=voitures.immat AND voitures.id_modele=modele.id_modele";
    $idcom=connexobject("voitures","myparam");
    $result=$idcom->query($requete);
    echo "<table border=\"3\">";
    while($ligne=$result->fetch_array(MYSQLI_NUM))
    {
      echo "<tr> <td>$ligne[0]</td> <td>$ligne[1]</td> </tr>";
    }
    echo "</table>";
  }
  else
  {
    echo "<h3> Remplir le Formulaire svp </h3>";
  }
  ?>

</body>

</html>
