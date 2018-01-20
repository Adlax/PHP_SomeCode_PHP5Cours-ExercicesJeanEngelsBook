<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Enregistrement d'un vehicule </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" />
    <fieldset>
      <legend> Enregistrement d'un véhicule </legend>
      <table border="4">

        <tr colspan="2">
          <td> <b>Proprietaire</b> </td>
        </tr>
        <tr>
          <td> Nom : </td> <td> <input type="text" name="nom" size="40" maxlength="30"/> </td>
        </tr>
        <tr>
          <td> Prenom : </td> <td> <input type="text" name="prenom" size="40" maxlength="30"/> </td>
        </tr>
        <tr>
          <td> Adresse : </td> <td> <input type="text" name="adresse" size="40" maxlength="30"/> </td>
        </tr>
        <tr>
          <td> Ville : </td> <td> <input type="text" name="ville" size="40" maxlength="30"/> </td>
        </tr>
        <tr>
          <td> CodePostal : </td> <td> <input type="text" name="Codepostal" size="40" maxlength="30"/> </td>
        </tr>

        <tr colspan="2">
          <td> <b>Voiture</b> </td>
        </tr>
        <tr>
          <td> Marque ; </td> <td> <input type="text" name="marque" size="40" maxlength="30"/> </td>
        </tr>
        <tr>
          <td> Faire la recherche suivant la marque entrée ; </td>
          <td> <input type="submit" name="cherchmod" value="Chercher le modele"/> </td>
          <?php
          if(isset($_POST['marque']))
          {
            include_once('connexpdo.inc.php');
            $idcom=connexpdo("voitures","myparam");
            $marque=$_POST['marque'];
            $requete="SELECT DISTINCT id_modele,modele FROM modele WHERE modele LIKE '%$marque%'";
            $result=$idcom->query($requete);
            echo "<tr> <td>les modeles de la marque entrée sont ; </td> <td><select name=\"id_modele\">";
            while($ligne=$result->fetch(PDO::FETCH_BOTH))
            {
              echo "<option value=\"$ligne[0]\">$ligne[1]</option>";
            }
            echo "</select>";
          }
          ?>
        </tr>
        <tr>
          <td> Couleur ; </td>
          <td>
            <select name="couleur">
              <option value="claire">Claire</option>
              <option value="moyenne">Moyenne</option>
              <option value="foncee">Foncee</option>
            </select>
          </td>
        </tr>
        <tr>
          <td> Carburant ; </td>
          <td>
            <select name="carburant">
              <option value="essence">Essence</option>
              <option value="diesel">Diesel</option>
              <option value="electrique">Electrique</option>
              <option value="gpl">GPL</option>
            </select>
          </td>
        </tr>
        <tr>
          <td> Immatriculation : </td>
          <td>
            <input type="text" name="immat" size="40" maxlength="30"/>
          </td>
        </tr>

        <tr colspan="2">
          <td> <b>Dates</b> </td>
        </tr>
        <tr>
          <td> Date acquisition voiture format AAAA.MM.JJ </td>
          <td> <input type="text" name="datevoiture" size="40" maxlength="30"/> </td>
        </tr>
        <tr>
          <td> Date carte grise format AAAA.MM.JJ </td>
          <td> <input type="text" name="datecarte" size="40" maxlength="30"/> </td>
        </tr>
        <tr>
          <td> <input type="submit" value="REC" /> </td>
          <td> <input type="reset" value="RESET"/> </td>
        </tr>
      </table>
    </fieldset>
  </form>
</body>

</html>

<?php
include_once('connexpdo.inc.php');
$idcom=connexpdo("voitures","myparam");
if(isset($_POST['REC']))
{
  $nom=$_POST['nom'];
  $prenom=$_POST['prenom'];
  $adresse=$_POST['adresse'];
  $ville=$_POST['ville'];
  $Codepostal=$_POST['Codepostal'];
  $id_modele=$_POST['id_modele'];
  $couleur=$_POST['couleur'];
  $carburant=$_POST['carburant'];
  $datevoiture=$_POST['datevoiture'];
  $datecarte=$_POST['datecarte'];
  $immat=$_POST['immat'];
  $idcom->beginTransaction();
  $requete1="INSERT INTO voiture VALUES('$immat','$id_modele','$couleur','$datevoiture')";
  $valid=$idcom->exec($requete1);
  $requete2="INSERT INTO proprietaire VALUES('','$nom','$prenom','$adresse','$ville','$Codepostal')";
  $valid+=$idcom->exec($requete2);
  $id=$idcom->lastInsertId();
  $requete3="INSERT INTO cartegrise VALUES('$id','$immat','$datecarte')";
  $valid+=$idcom->exec($requete3);
  $requete4="INSERT INTO modele VALUES('$id_modele','$modele','$carburant')";
  $valid+=$idcom->exec($requete4);
  if($valid==4)
  {
    $idcom->commit();
    echo "<script type=\"text/javascript\">alert('Nouvelle voiture bien enregistrée')</script>";
  }
  else
  {
    $idcom->rollback();
    $error=$idcom->errorInfo();
    echo "<script type=\"text/javascript\">alert('Erreur numéro".$error[2]."')</script>";
  }
}
else
{
  echo "<h3> Veuillez remplir les champs </h3>";
}
?>
