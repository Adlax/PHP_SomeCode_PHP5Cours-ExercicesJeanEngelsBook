<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Insertion de données </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> <b>Vos Coordonnées?</b> </legend>
      <table>
        <tr> <td>Nom ; </td> <td><input type="text" name="nom" maxlength="30" size="30"/></td> </tr>
        <tr> <td>Prenom ; </td> <td><input type="text" name="prenom" maxlength="30" size="30"/></td> </tr>
        <tr> <td>Age ; </td> <td><input type="text" name="age" maxlength="2" size="40"/></td> </tr>
        <tr> <td>Adresse ; </td> <td><input type="text" name="adresse" maxlength="30" size="40"/></td> </tr>
        <tr> <td>Ville ; </td> <td><input type="text" name="ville" maxlength="30" size="40"/></td> </tr>
        <tr> <td>e-mail ; </td> <td><input type="text" name="mail" maxlength="30" size="40"/></td> </tr>
        <tr>
          <td><input type="submit" value="OK!"/></td>
          <td><input type="reset" value="Effacer"/></td>
        </tr>
      </table>
    </fieldset>
  </form>

  <?php
  include('connexobject.inc.php');
  $idcom=connexobject("magasin","myparam");
  if(!empty($_POST['nom']) && !empty($_POST['adresse']) && !empty($_POST['ville']))
  {
    //$id_client="\N";
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $age=$_POST['age'];
    $adresse=$_POST['adresse'];
    $ville=$_POST['ville'];
    $mail=$_POST['mail'];
    $requete="INSERT INTO client VALUES('$id_client','$nom','$prenom','$age','$adresse','$ville','$mail')";
    $result=$idcom->query($requete);
    if(!$result)
    {
      echo "Chiotte";
      echo $idcom->errno;
      echo $idcom->error;
      echo "<script type=\"text/javascript\">alert('Erreur : ".$idcom->error."')</script>";
    }
    else
    {
      echo "<script type=\"text/javascript\">alert('Vous etes bien enregistré et votre numéro client est ; ".$idcom->insert_id."')</script>";
      $idcom->close();
    }
  }
  else
  {
    echo "Remplissez le formulaire svp";
  }
  ?>
</body>

</html>
