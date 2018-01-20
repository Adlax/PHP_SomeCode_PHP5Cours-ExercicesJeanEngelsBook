<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Enregistrement d'un proprietaire </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> <b>Coordonnées de la personne</b> </legend>
      <table border="10">
        <tr>
          <td>
            Nom ;
          </td>
          <td>
            <input type="text" name="nom"/>
          </td>
        </tr>
        <tr>
          <td>
            Prenom ;
          </td>
          <td>
            <input type="text" name="prenom"/>
          </td>
        </tr>
        <tr>
          <td>
            Adresse ;
          </td>
          <td>
            <input type="text" name="adresse"/>
          </td>
        </tr>
        <tr>
          <td>
            Ville ;
          </td>
          <td>
            <input type="text" name="ville"/>
          </td>
        </tr>
        <tr>
          <td>
            CodePostal ;
          </td>
          <td>
            <input type="text" name="codepostal"/>
          </td>
        </tr>
        <tr colspann="5">
          <td>
            <input type="submit" value="REC"/>
          </td>
        </tr>
      </table>
    </fieldset>
  </form>
</body>
</html>
/*
<?php
if( isset($_POST['nom']) && isset($_POST['adresse'] && isset($_POST['ville']) && isset($_POST['codepostal']) )
{
  $objdb=new SQLite3("voitures.sqlite");
  $nom=$_POST['nom'];
  $prenom=$_POST['prenom'];
  $adresse=$_POST['adresse'];
  $ville=$_POST['ville'];
  $codepostal=$_POST['codepostal'];
  $requete="INSERT INTO proprietaire VALUES(NULL,'$nom','$prenom','$adresse','$ville','$codepostal')";
  if($result=$objdb->query($requete))
  {
    echo "<h3> Proprietaire inséré </h3>";
  }
  else
  {
    echo "<h3> Bug dans ta face </h3>";
  }
}
?>
*/
