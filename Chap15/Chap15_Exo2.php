<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html:charset=UTF-8" />
  <title> Insertion dans modele </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> <b>Vos Coordonnees</b> </legend>
      <table>
        <tr> <td>Par code modele : </td> <td><input type="text" name="id_modele" size="40" maxlength="10"/></td> </tr>
        <tr> <td>Marque et modele : </td> <td><input type="text" name="modele" size="40" maxlength="30"/></td> </tr>
        <tr>
          <td>Carburant</td>
          <td>
            <select name="carburant">
              <option value="diesel">Diesel</option>
              <option value="essence">Essence</option>
              <option value="electrique">Electrique</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><input type="reset" value="Effacer"></td>
          <td><input type="submit" value="Envoyer"></td>
        </tr>
      </table>
    </fieldset>
  </form>

  <?php
  include('connex.inc.php');
  if(isset($_POST['id_modele']) && isset($_POST['modele']) && isset($_POST['carburant']))
  {
    $id_modele=($_POST['id_modele']);
    $modele=($_POST['modele']);
    $carburant=($_POST['carburant']);
    $requete="INSERT INTO modele VALUES('$id_modele','$modele','$carburant')";
    $idcom=connex("voitures","myparam");
    $result=mysql_query($requete,$idcom);
    if(!$result)
    {
      echo mysql_errno();
      echo mysql_error();
      echo "<script type=\"text/javascript\">alert('Erreur : ".mysql_error()."')</script>";
    }
    else
    {
      echo "<script type=\"text/javascript\">alert('Le modele est enregistré')</script>";
    }
  }
  echo "<h3> Veuillez remplir les champs </h3>";
  ?>

</body>

</html>
