<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html:charset=UTF-8" />
  <title> Saisissez les tous! </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="application/x-www-form_urlencoded" >
    <fieldset>
      <legend> <b>Vos Coordonnees</b> </legend>
      <table>
        <tr> <td>Nom: </td> <td><input type="text" name="nom" size="40" maxlength="30" /></td> </tr>
        <tr> <td>Prenom: </td> <td><input type="text" name="prenom" size="40" maxlength="30" /></td> </tr>
        <tr> <td>Age: </td> <td><input type="text" name="age" size="40" maxlength="2" /></td> </tr>
        <tr> <td>Adresse: </td> <td><input type="text" name="adresse" size="40" maxlength="60" /></td> </tr>
        <tr> <td>Ville: </td> <td><input type="text" name="ville" size="40" maxlength="30" /></td> </tr>
        <tr> <td>Mail: </td> <td><input type="text" name="mail" size="40" maxlength="50" /></td> </tr>
        <tr> <td><input type="reset" value="Effacer"/></td> <td><input type="submit" value="Enregistrer"/></td> </tr>
      </table>
    </fieldset>
  </form>

  <?php
  include('connex.inc.php');

  if(!empty($_POST['nom']) && !empty($_POST['adresse']) && !empty($_POST['ville']))
  {
    $id_client="\N";
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $age=$_POST['age'];
    $adresse=$_POST['adresse'];
    $mail=$_POST['mail'];
    $ville=$_POST['ville'];

    $requete="INSERT INTO client VALUES('$id_client','$nom','$prenom','$age','$adresse','$ville','$mail')";
    $idcom=connex("magasin","myparam");

    $result=@mysql_query($requete,$idcom);
    $num=mysql_insert_id();
    mysql_close($idcom);

    if(!$result)
    {
      echo "<h2>Erreur d'insertion \n n°",mysql_errno(),":",mysql_error(),"</h2>";
    }
    else
    {
      echo $num;
      echo "<script type=\"text/javascript\"> alert('Vous etes bien enregirsté. Votre numéro de client est : ".$num."') </script>";
    }
  }
  else
  {
    echo "Veuillez remplir le formulaire svp";
  }
  ?>

</body>

</html>
