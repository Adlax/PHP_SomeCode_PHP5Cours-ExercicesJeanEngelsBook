<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Recherche Proprietaire d'un modele</title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" />
    <fieldset>
      <legend> Entrez le modele </legend>
      <table border="4">
        <tr colspan="3">
          <td>
            Modele ;
          </td>
          <td>
            <input type="text" name="modele" size="40" maxlength="30"/>
          </td>
        </tr>
        <tr>
          <td><input type="submit" value="Chercher le proprietaire"/></td>
        </tr>
      </table>
    </fieldset>
  </form>
</body>

</html>

  <?php
  include_once('connexpdo.inc.php');
  $idcom=connexpdo("voitures","myparam");
  if(isset($_POST['modele']))
  {
    $modele=$_POST['modele'];
    $requete="SELECT proprietaire.nom,proprietaire.prenom FROM proprietaire,cartegrise,voitures,modele WHERE proprietaire.id_pers=cartegrise.id_pers AND cartegrise.immat=voitures.immat AND voitures.id_modele=modele.id_modele AND modele LIKE '%$modele%'";
    $result=$idcom->query($requete);
    echo "<table border=\"4\">";
    while($ligne=$result->fetch(PDO::FETCH_BOTH))
    {
      echo "<tr> <td>$ligne[0]</td> <td>$ligne[1]</td> </tr>";
    }
    echo "</table>";
  }
  else
  {
    echo "Veuillez remplir les champs";
  }
  ?>
