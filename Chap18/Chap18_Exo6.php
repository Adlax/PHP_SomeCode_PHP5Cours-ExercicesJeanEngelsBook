<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Recherche des proprietaires d'un modele </title>
</head>

<body>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend> Entrez un modele </legend>
      <table>
        <tr>
          <td>
            Entrez un modele ;
          </td>
          <td>
            <select name="idmodele">
              <?php
              $objdb=new SQLite3("voitures.db");
              $requete="SELECT id_modele,modele FROM modele ORDER BY modele ASC";
              $result=$objdb->query($requete);
              while($ligne=$result->fetchArray())
              {
                echo "<option name=\"modele\" value=\"$ligne[0]\">$ligne[1]</option>";
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="REC"/>
          </td>
          <td>
            <input type="reset" value="RZT"/>
          </td>
        </tr>
      </table>
    </fieldset>
  </form>
</body>
</html>

<?php
$objdb=new SQLite3("voitures.db");
if( isset($_POST['idmodele']) )
{
  echo "Résultat de la recherche";
  $idmodele=$_POST['idmodele'];
  $requete="SELECT proprietaire.nom,proprietaire.prenom,voitures.immat,modele.modele FROM voitures,modele,proprietaire,cartegrise WHERE voitures.id_modele= '$idmodele' AND proprietaire.id_pers=cartegrise.id_pers AND cartegrise.immat=voitures.immat AND voitures.id_modele=modele.id_modele";
  $result=$objdb->query($requete);
  echo "<table border=\"4\">";
  while($ligne=$result->fetchArray())
  {
    echo "<tr> <td>$ligne[0]</td> <td>$ligne[1]</td> <td>$ligne[2]</td> <td>$ligne[3]</td> </tr>";
  }
  echo "</table>";
  $objdb->close();
}
else
{
  echo "Choisir le modele svp";
}
?>
