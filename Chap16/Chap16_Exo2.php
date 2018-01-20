<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Insertion d'une nouvelle entrée dans la table modele </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" metho="post">
    <fieldset>
      <legend> Inserez un nouveau modele </legend>
      <table>
        <tr> <td>Code modele : </td> <td><input type="text" name="id_modele" size="30"></td> </tr>
        <tr> <td>Nom de modele : </td> <td><input type="text" name="modele" size="30"></td> </tr>
        <tr>
          <td>Carburant : </td>
          <td>
            <select name="carburant">
              <option>essence</option>
              <option>gpl</option>
              <option>electrique</option>
              <option>diesel</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><input type="submit" value="Banzai"></td>
          <td><input type="reset" value="Reset"></td>
        </tr>
      </table>
    </fieldset>
  </form>
</body>

<?php
include('connexobject.inc.php');
$idcom=connexobject("voitures","myparam");
if(isset($_POST['id_modele']) && isset($_POST['modele']) && isset($_POST['carburant']))
{
  $id_modele=$_POST['id_modele'];
  $modele=$_POST['modele'];
  $carburant=$_POST['carburant'];
  $requete="INSERT INTO modele VALUES('id_modele','modele','carburant')";
  $result=$idcom->query($requete);
  if(!$result)
  {
    echo $idcom->errno;
    echo $idcom->error;
    echo "<script type=\"text/javascript\">alert('Erreur : ".$idcom->errno."')</script>";
  }
  else
  {
    echo "<script type=\"text/javascript\">alert('Bien enregistré')</script>";
  }
}
else
{
  echo "<h3>Remplissez le formulaire</h3>";
}
?>

</html>
