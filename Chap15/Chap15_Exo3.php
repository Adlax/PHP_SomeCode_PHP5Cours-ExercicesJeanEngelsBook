<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html:charset=UTF-8">
  <title> Saisissez les caractéristiques du modele </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
    <fieldset>
      <legend> <b>Enregistrement d'un véhicule</b> </legend>
      <tr> <td><b>Proprietaire</b></td> </tr>
      <tr>
        <td>Nom : </td> <td><input type="text" name="nom" size="40" maxlength="10"/></td>
      </tr>
      <tr>
        <td>Prenom : </td> <td><input type="text" name="prenom" size="40" maxlength="30"/></td>
      </tr>
      <tr>
        <td>Adresse : </td> <td><input type="text" name="adresse" size="40" maxlength="30"/></td>
      </tr>
      <tr>
        <td>Ville : </td> <td><input type="text" name="ville" size="40" maxlength="30"/></td>
      </tr>
      <tr>
        <td>Code Postal : </td> <td><input type="text" name="codepostal" size="40" maxlength="5"/></td>
      </tr>
      <tr colspan="2">
        <td>Modele</td>
      </tr>
      <tr>
        <td>Marque : </td> <td><input type="text" name="marque" size="40" maxlength="30"/></td>
        <td>Envoyer: </td> <input type="submit" name="cherchemod" value="Chercher les modeles"/></td>
      </tr>
      <?php
      if(isset($_POST['cherchemod']))
      {
        include_once('connex.inc.php');
        $marque=($_POST['marque']);
        $requete="SELECT DISTINCT id_modele,modele FROM modele WHERE modele LIKE '%$marque%'";
        $idcom=connex('voitures','myparam');
        $result=@mysql_query($requete,$idcom);
        echo "<tr> <td>Les modeles</td> <td><select name=\"id_modele\">";
        while($ligne=mysql_fetch_array($result,MYSQL_NUM))
        {
          echo "<option value=\"$ligne[0]\">$ligne[1]</option>";
        }
        echo "</select>";
        echo "</tr>";
      }
      ?>
      <tr>
        <td>Carburant</td>
        <td>
          <select name="carburant">
            <option value="essence">Essence</option>
            <option value="diesel">Diesel</option>
            <option value="electrique">Electrique</option>
          </select>
        </td>
      </tr>
      <tr colspan="2"> <td><b>Voiture</b></td> </tr>
      <tr>
        <td> Numero d immatriculation </td>
        <td> <input type="text" name="immat"/> </td>
      </tr>
      <tr>
        <td> couleur </td>
        <td>
          <select name="couleur">
            <option value="claire">Claire</option>
            <option value="moyenne">Moyenne</option>
            <option value="foncee">Foncee</option>
          </select>
        </td>
      </tr>
      <tr>
        <td> Annee d immatriculation format AAAA-MM-JJ </td>
        <td> <input type="text" name="datevoiture"/> </td>
      </tr>
      <tr>
        <td> Annee de la carte grise </td>
        <td> <input type="text" name="datecarte"/> </td>
      </tr>
      <tr>
        <td><input type="submit" value="Enregistrer" name="enreg"/></td>
        <td><input type="reset" value="Reset"/></td>
      </tr>
    </table>
  </fieldset>
</form>


<?php
include_once('connex.inc.php');
if(isset($_POST['enreg']))
{
  $nom=($_POST['nom']);
  $prenom=($_POST['prenom']);
  $adresse=($_POST['adresse']);
  $ville=($_POST['ville']);
  $codepostal=($_POST['codepostal']);
  $carburant=($_POST['carburant']);
  $immat=($_POST['immat']);
  $couleur=($_POST['couleur']);
  $datevoiture=($_POST['datevoiture']);
  $datecarte=($_POST['datecarte']);
  $id_modele=($_POST['id_modele']);

  $idcom=connex('voitures','myparam');
  $requete="INSERT INTO voiture VALUES('$immat','$id_modele','$couleur','$datevoiture')";
  $result1=@mysql_query($requete,$idcom);
  $requete="INSERT INTO proprietaire VALUES('','$nom','$prenom','$adresse','$ville','$codepostal')";
  $result2=@mysql_query($requete,$idcom);

  $id_pers=mysql_insert_id();

  $requete="INSERT INTO cartegrise VALUES('$id_pers','$immat','$datecarte')";
  $result3=@mysql_query($requete,$idcom);

  if(!$result1)
  {
    echo mysql_errno();
    echo mysql_error();
    echo "<script type=\"text/javascript\">alert('Erreur : ".mysql_error()."')</script>";
  }
  else
  {
    echo "<script type=\"text/javascript\">alert('Carte grise enregistree')</script>";
  }
}
else
{
  echo "<h3> Veuillez remplir le formulaire </h3>";
}
?>
</body>

</html>
