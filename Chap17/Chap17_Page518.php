<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Saisissez vos Coordonnées </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> <b>Vos Coordonnées</b> </legend>
      <table>
        <tr> <td>Nom ;</td> <td><input type="text" name="nom" size="40" maxlength="30"/></td> </tr>
        <tr> <td>Prenom ;</td> <td><input type="text" name="prenom" size="40" maxlength="30"/></td> </tr>
        <tr> <td>Age ;</td> <td><input type="text" name="age" size="40" maxlength="30"/></td> </tr>
        <tr> <td>Adresse ;</td> <td><input type="text" name="adresse" size="40" maxlength="30"/></td> </tr>
        <tr> <td>Ville ;</td> <td><input type="text" name="ville" size="40" maxlength="30"/></td> </tr>
        <tr> <td>e-mail ;</td> <td><input type="text" name="mail" size="40" maxlength="30"/></td> </tr>
        <tr>
          <td><input type="submit" value="Envoyer"></td>
          <td><input type="reset" value="Reset"></td>
        </tr>
      </table>
    </fieldset>
  </form>

  <?php
  include('connexpdo.inc.php');
  $idcom=connexpdo("magasin","myparam");
  if( isset($_POST['nom']) && isset($_POST['adresse']) && isset($_POST['ville']) )
  {
    $id_client="\N";
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $age=$_POST['age'];
    $adresse=$_POST['adresse'];
    $ville=$_POST['ville'];
    $mail=$_POST['mail'];
    $requete="INSERT INTO client VALUES($id_client,$nom,$prenom,$age,$adresse,$ville,$mail)";
    $nblignes=$idcom->exec($requete);
    if($nblignes!=1)
    {
      $mes_erreures=$idcom->errorInfo();
      echo "<script type=\"text/javascript\">alert('Erreur : ".$idcom->errorCode()."')</script>";
      echo "Insertion des coord du client impossible, code :".$idcom->errorCode()." correspondant a ;".$mes_erreures[2];
    }
    else
    {
      echo "<script type=\"text/javascript\">alert('Vous etes enregistré et votre code client est ; ".lastInsertId()."')</script>";

    }
  }
  else
  {
    echo "<h3> Remplir le formulaire </h3>";
  }
  $idcom=NULL;
  ?>

</body>

</html>
