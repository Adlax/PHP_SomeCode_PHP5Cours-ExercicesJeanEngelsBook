<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Enregistrement total d'un véhicule </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend>Enregistement d'un véhicule</legend>
      <table>
        <tr colspan="2"> <td><b>Proprietaire</b></td> </tr>
        <tr> <td>Nom ; </td> <td><input type="text" name="nom"></td> </tr>
        <tr> <td>Prenom ; </td> <td><input type="text" name="prenom"></td> </tr>
        <tr> <td>Adresse ; </td> <td><input type="text" name="adresse"></td> </tr>
        <tr> <td>Ville ; </td> <td><input type="text" name="ville"></td> </tr>
        <tr> <td>Code Postal ; </td> <td><input type="text" name="Codepostal"></td> </tr>
        <tr colspan="2"> <td><b>Véhicule</b></td> </tr>
        <tr> <td>Modele; </td> <td><input type="text" name="marque"></td> </tr>
        <tr> <td>Lancer la recherche : </td> <td><input type="submit" value="RECHERCHE!"></td> </tr>
        <?php
        if(isset($_POST['marque']))
        {
          include('connexobject.inc.php');
          $idcom=connexobject("voitures","myparam");
          $marque=$_POST['marque'];
          $requete="SELECT  DISTINCT id_modele,modele FROM modele WHERE modele LIKE '%$marque%'";
          $result=$idcom->query($requete);
          echo "<tr> <td>Les différents modeles correspndant a votre mot clef ; </td> <td><select name=\"modele\">";
          while($ligne=$result->fetch_array(MYSQL_NUM))
          {
            echo "<option value=\"$ligne[0]\">$ligne[1]</option>";
          }
          echo "</select></td> </tr>";
        }
        ?>
        <tr>
          <td>Quel carburant?</td>
          <td>
            <select name="carburant">
              <option value="diesel">Diesel</option>
              <option value="essence">Essence</option>
              <option value="gpl">GPL</option>
              <option value="electrique">Electrique</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Quelle couleur?</td>
          <td>
            <select name="couleur">
              <option value="foncee">Foncée</option>
              <option value="moyenne">Moyenne</option>
              <option value="claire">Claire</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Numéro de plaque</td>
          <td><input type="text" name="immat"></td>
        </tr>
        <tr colspan="2"> <td><b>Dates</b></td> </tr>
        <tr> <td>Immatriculation carte grise au format AAAA-MM-JJ</td> <td><input type="text" name="datecarte"></td> </tr>
        <tr> <td>Immatriculation voiture au format AAAA-MM-JJ</td> <td><input type="text" name="datevoiture"></td> </tr>
        <tr> <td>Enregistrer</td> <td><input type="submit" value="Enregistrer" name="REC"></td> </tr>
        <tr> <td>Enregistrer</td> <td><input type="reset" value="Effacer"></td> </tr>
      </table>
    </fieldset>
  </form>

  <?php
  include('connexobject.inc.php');
  $idcom=connexobject("voitures","myparam");
  if(isset($_POST['REC']))
  {
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $adresse=$_POST['adresse'];
    $ville=$_POST['ville'];
    $Codepostal=$_POST['Codepostal'];
    $id_modele=$_POST['id_modele'];
    $carburant=$_POST['carburant'];
    $couleur=$_POST['couleur'];
    $immat=$_POST['immat'];
    $datecarte=$_POST['datecarte'];
    $datevoiture=$_POST['datevoiture'];

    $idcom->autocommit(FALSE);
    $requete1="INSERT INTO proprietaire VALUES('','$nom','$prenom','$adresse','$ville','$Codepostal')";
    $result1=$idcom->query($requete1);
    $id_pers=$idcom->insert_id;
    $nb=$idcom->affected_rows;
    $requete2="INSERT INTO voitures VALUES('$immat','$id_modele','$couleur','$datevoiture')";
    $result2=$idcom->query($requete2);
    $nb+=$idcom->affected_rows;
    $requete3="INSERT INTO cartegrise VALUES('$id_pers','$immat','$datecarte')";
    $result3=$idcom->query($requete3);
    $nb+=$idcom->affected_rows;
    $requete4="INSERT INTO modele VALUES('$id_modele','$modele','$carburant')";
    $result4=$idcom->query($requete4);
    $nb+=$idcom->affected_rows;

    if($nb==4)
    {
      echo "Parfait!";
      $idcom->commit();
    }
    else
    {
      echo "Ca a merdé : rollback";
      $idcom->rollback();
    }
  }
  else
  {
    echo "<h3> Veuillez remplir le formulaire </h3>";
  }
  ?>

</body>

</html>
