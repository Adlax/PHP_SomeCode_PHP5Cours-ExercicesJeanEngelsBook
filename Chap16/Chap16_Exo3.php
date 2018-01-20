<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Saisissez les caracs du modele </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
    <fieldset>
      <legend> Enregistrement d'un véhicule </legend>
      <table>
        <tr colspan="2"> <b><td>Proprietaire</td></b> </tr>
        <tr> <td>Nom ; </td><td><input type="text" name="nom" size="30"></td> </tr>
        <tr> <td>Prenom ; </td><td><input type="text" name="prenom" size="30"></td> </tr>
        <tr> <td>Adresse ; </td><td><input type="text" name="adresse" size="30"></td> </tr>
        <tr> <td>Ville ; </td><td><input type="text" name="ville" size="30"></td> </tr>
        <tr> <td>CodePostal ; </td><td><input type="text" name="Codepostal" size="30"></td> </tr>
        <tr colspan="2"> <b><td>Modele</td></b> </tr>
        <tr> <td>Marque ; </td><td><input type="text" name="marque" size="30"></td> </tr>
        <tr> <td>Faites une recherche de la marque ; </td> <td><input type="submit" name="cherchemod" value="Chercher les modeles"></td> </tr>
        <?php
        if(isset($_POST['cherchemod']))
        {
          include_once('connexobject.inc.php');
          $idcom=connexobject("voitures","myparam");
          $marque=$_POST['marque'];
          $requete="SELECT DISTINCT id_modele,modele FROM modele WHERE modele LIKE '%$marque%'";
          $result=$idcom->query($requete);
          echo "<tr> <td>les modeles semblables : </td> <td><select name=\"id_modele\">";
          while($ligne=$result->fetch_array(MYSQL_NUM))
          {
            echo "<option value=\"$ligne[0]\">$ligne[1]</option>";
          }
          echo "</select></td> </tr>";
        }
        ?>
        <tr>
          <td>Carburant</td>
          <td>
            <select name="carburant">
              <option value="essence">Essence</option>
              <option value="diesel">Diesel</option>
              <option value="gpl">GPL</option>
              <option value="electrique">Electrique la trique</option>
            </select>
          </td>
        </tr>
        <tr colspan=\"2\">
          <td>
            <b>Voiture</b>
          </td>
        </tr>
        <tr>
          <td>Immatriculation</td> <td><input type="text" name="immat" size="30"></td>
        </tr>
        <tr>
          <td>Couleur : </td>
          <td>
            <select name="couleur">
              <option value="claire">Claire la caisse!</option>
              <option value="moyenne">Moyenne</option>
              <option value="foncee">Foncee sa race!</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Date d'immatriculation au format AAAA-MM-JJ: </td>
          <td><input type="text" name="datevoiture"></td>
        </tr>
        <tr>
          <td>Date de carte grise au format AAAA-MM-JJ: </td>
          <td><input type="text" name="datecarte"></td>
        </tr>
        <tr>
          <td><input type="submit" value="Record!" name="record"></td>
          <td><input type="reset" value="Reset au Sarmat!"</td>
        </tr>
      </table>
    </fieldset>
  </form>

  <?php
  include('connexobject.inc.php');
  $idcom=connexobject("voitures","myparam");
  if(isset($_POST['record']))
  {
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $adresse=$_POST['adresse'];
    $ville=$_POST['ville'];
    $codepostal=$_POST['codepostal'];
    $id_modele=$_POST['id_modele'];
    $carburant=$_POST['carburant'];
    $couleur=$_POST['couleur'];
    $immat=$_POST['immat'];
    $datecarte=$_POST['datecarte'];
    $datevoiture=$_POST['datevoiture'];

    $requete1="INSERT INTO proprietaire VALUES('','$nom','$prenom','$adresse','$ville','$codepostal')";
    $result1=$idcom->query($requete1);

    $requete2="INSERT INTO voitures VALUES('$immat','$id_modele','$couleur','$datevoiture')";
    $result2=$idcom->query($requete2);

    $requete3="INSERT INTO cartegrise VALUES('$id_pers','$immat','datecarte')";
    $result=$idcom->query($requete3);

    if(!$result1)
    {
      echo "Pas enregistré";
    }
    else
    {
      echo "Bien enregistré!";
    }
  }
  else
  {
    echo "<h3>Remplir les champs tatata!</h3>";
  }
  ?>

</body>
</html>
