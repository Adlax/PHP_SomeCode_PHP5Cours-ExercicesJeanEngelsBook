<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <title> Insertion d'une ligne dans la table modele </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> Entrez les caracteristiques du modele </legend>
      <table border="4">
        <tr>
          <td>
            Code modele :
          </td>
          <td>
            <input type="text" name="id_modele" size="40" maxlength="40"/>
          </td>
        </tr>
        <tr>
          <td>
            Descri modele :
          </td>
          <td>
            <input type="text" name="modele" size="40" maxlength="30"/>
          </td>
        </tr>
        <tr>
          <td>
            Choix du carburant :
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

        <tr>
          <td> <input type="submit" value="OK!"/> </td>
          <td> <input type="reset" value="RESET!"/> </td>
        </tr>

      </table>
    </fieldset>
  </form>
</body>

</html>

<?php
include('connexpdo.inc.php');
$idcom=connexpdo("voitures","myparam");
if( isset($_POST['id_modele']) && isset($_POST['modele']) && isset($_POST['carburant']) )
{
  $id_modele=$_POST['id_modele'];
  $modele=$_POST['modele'];
  $carburant=$_POST['carburant'];
  $requete="INSERT INTO modele VALUES('$id_modele','$modele','$carburant')";
  $nb=$idcom->query($requete);
  if($nb!=1)
  {
    echo "<script type=\"text/javascript\">alert('Erreur ;".$idcom->errorInfo()."')</script>";
  }
  else
  {
    echo "<script type=\"text/javascript\">alert('Bien enregistré!')</script>";
  }
}
else
{
  echo "<h3> Veuillez remplir les champs </h3>";
}
?>
