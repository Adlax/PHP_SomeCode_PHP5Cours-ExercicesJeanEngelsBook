<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Enregistrement d'un véhicule </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> <b>Saisissez l'ensemble des données</b> </legend>
      <table>
        <tr colspann="4">
          <td>
            <b>PROPRIETAIRE</b>
          </td>
        </tr>
        <tr>
          <td>
            Nom ;
          </td>
          <td>
            <input type="submit" name="nom" size="40" maxlength="30"/>
          </td>
        </tr>
        <tr>
          <td>
            Prenom ;
          </td>
          <td>
            <input type="submit" name="prenom" size="40" maxlength="30"/>
          </td>
        </tr>
        <tr>
          <td>
            Adresse ;
          </td>
          <td>
            <input type="submit" name="adresse" size="40" maxlength="30"/>
          </td>
        </tr>
        <tr>
          <td>
            Ville ;
          </td>
          <td>
            <input type="submit" name="ville" size="40" maxlength="30"/>
          </td>
        </tr>
        <tr>
          <td>
            Code Postal ;
          </td>
          <td>
            <input type="submit" name="codepostal" size="40" maxlength="30"/>
          </td>
        </tr>
        <tr colspann="4">
          <td>
            <b>MODELE</b>
          </td>
        </tr>
        <tr>
          <td>
            Nom du modele ;
          </td>
          <td>
            <select name="idmodele">
              <?php
              if($idbase=sqlite_open("C:\wamp64\www\Chap18\voitures\voitures.sqlite",0666,$erreur))
              {
                $requete="SELECT id_modele,modele FROM modele ORDER BY modele ASC";
                $result=sqlite_query($idbase,$requete);
                while($ligne=sqlite_fetch_object($result))
                {
                  echo "<option value=\"id_modele\">$ligne->modele</option>";
                }
                sqlite_close($idbase);
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            Carburant ;
          </td>
          <td>
            <select name="carburant">
              <option value="essence">Essence</option>
              <option value="electrique">Electrique</option>
              <option value="gpl">GPL</option>
              <option value="diesel">Diesel</option>
            </select>
          </td>
        </tr>
        <tr colspann="4">
          <td>
            <b>VOITURE</b>
          </td>
        </tr>
        <tr>
          <td>
            Numéro d'immatriculation ;
          </td>
          <td>
            <input type="text" name="immat" size="40" maxlength="30"/>
          </td>
        </tr>
        <tr>
          <td>
            Date d'immatriculation format AAAA-MM-JJ ;
          </td>
          <td>
            <input type="text" name="datevoiture" size="40" maxlength="30"/>
          </td>
        </tr>
        <tr>
          <td>
            Numéro de carte grise format AAAA-MM-JJ ;
          </td>
          <td>
            <input type="text" name="dategrise" size="40" maxlength="30"/>
          </td>
        </tr>
        <tr>
          <td>
            Couleur ;
          </td>
          <td>
            <select name="couleur">
              <option value="foncee">Foncée</option>
              <option value="moyenne">Moyenne</option>
              <option value="claire">Claire</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="REC!" name="REC"/>
          </td>
        </tr>
        <tr>
          <td>
            <input type="reset" value="RZT!"/>
          </td>
        </tr>
      </table>
    </fieldset>
  </form>

  <?php
  if($_POST['REC'])
  {
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $adresse=$_POST['adresse'];
    $ville=$_POST['ville'];
    $codepostal=$_POST['codepostal'];
    $immat=$_POST['immat'];
    $dategrise=$_POST['dategrise'];
    $datevoiture=$_POST['datevoiture'];
    $couleur=$_POST['couleur'];
    $id_modele=$_POST['idmodele'];
    $carburant=$_POST['carburant'];
    $idbase=sqlite_open("C:\wamp64\www\Chap18\voitures\voitures.sqlite",0666,$erreur);
    $requete="BEGIN;";
    $requete.="INSERT INTO proprietaire VALUES(NULL,'$nom','$prenom','$adresse','$ville','$codepostal')";
    $result=sqlite_exec($idbase,$requete);
    $id_pers=sqlite_last_insert_rowid($idbase);
    $requete="INSERT INTO cartegrise VALUES('$id_pers','$immat','$datecarte')";
    $requete.="INSERT INTO voiture VALUES('$immat','$idmodele','$couleur','$datevoiture')";
    $requete.="COMMIT;"
    sqlite_exec($idbase,$requete);
  }
  ?>

</body>
</html>
