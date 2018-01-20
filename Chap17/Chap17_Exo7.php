<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Recherche Proprietaire(s) d'un modele</title>
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



<?php
if(isset($_POST['modele']))
{
  include_once('connexpdo.inc.php');
  $idcom=connexpdo("voitures","myparam");
  $modele=$_POST['modele'];
  $reqprep=$idcom->prepare("SELECT proprietaire.nom,proprietaire.prenom FROM proprietaire,cartegrise,voitures,modele WHERE proprietaire.id_pers=cartegrise.id_pers AND cartegrise.immat=voitures.immat AND voitures.id_modele=modele.id_modele AND modele= :modele");
  $reqprep->bindParam(':modele',$modele,PDO::PARAM_STR);
  $reqprep->execute();
  $reqprep->bindColumn('nom',$nom);
  $reqprep->bindColumn('prenom',$prenom);
  echo "<table border=\"4\">";
  while($reqprep->fetch(PDO::FETCH_BOUND))
  {
    echo "<tr> <td>$nom</td> <td>$prenom</td> </tr>";
  }
  echo "</table>";
}
else
{
  echo "<h3> Remplir le form ARBEIT ! schell </h3>";
}
?>

</html>
