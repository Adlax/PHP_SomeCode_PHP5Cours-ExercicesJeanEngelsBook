<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Saisissez vos Coordonnées </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> <b>Vos Coord</b> </legend>
      <table>
        <tr> <td>Nom ; </td> <td><input type="text" name="nom"/></td> </tr>
        <tr> <td>Prenom ; </td> <td><input type="text" name="prenom"/></td> </tr>
        <tr> <td>Departement ; </td> <td><input type="text" name="depart"/></td> </tr>
        <tr> <td>Mail ; </td> <td><input type="text" name="mail"/></td> </tr>
        <tr> <td><input type="submit" value="Envoyer"/></td> </tr>
        <tr> <td><input type="reset" value="Reset"/></td> </tr>
      </table>
    </fieldset>
  </form>

  <?php
  if( isset($_POST['nom']) && isset($_POST['depart']) && isset($_POST['mail']) )
  {
    $objdb=new SQLite3('Sportifeuzes.db');
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $depart=$_POST['depart'];
    $mail=$_POST['mail'];
    $requete="INSERT INTO personne VALUES(NULL,'$nom','$prenom','$depart','$mail')";
    $result=$objdb->exec($requete);
    if(!$result)
    {
      echo "<h2>Erreur d'insertion \n n°".$objdb->lastErrorCode()."</h2>";
    }
    else
    {
      echo "<script type=\"text/javascript\">alert('Vous etes enregistré et votre numéro de client est ;".$objdb->lastInsertRowId()."')</script>";
    }
    $objdb->close();
  }
  else
  {
    echo "Form a completer";
  }
  ?>

</body>

</html>
