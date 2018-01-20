<?php
if(empty($_POST['code']))
{
  header("Location:Chap15_Page460.php");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html:charset=UTF-8" />
  <title> Modifiez vos Coordonnees </title>
</head>

<body>
  <?php
  if(!isset($_POST['modif']))
  {
    include('connex.inc.php');
    $code=mysql_real_escape_string($_POST['code']);
    $requete="SELECT * FROM client WHERE id_client=''$code'";
    $idcom=connex("magasin","myparam");
    $result=@mysql_query($requete,$idcom);
    $coord=mysql_fetch_row($result);
    mysql_close($idcom);

    echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\" enctype=\"application/x-www-form-urlencoded\" >";
    echo "<fieldset>";
    echo "<legend> <b>Modifiez vos Coordonnees</b> </legend>";
    echo "<table>";
    echo "<tr> <td>Nom: </td> <td><input type=\"text\" name=\"nom\" size=\"40\" maxlength=\"30\" value=\"$coord[1]\"/></td> </tr>";
    echo "<tr> <td>Prenom: </td> <td><input type=\"text\" name=\"prenom\" size=\"40\" maxlength=\"30\" value=\"$coord[2]\"/></td> </tr>";
    echo "<tr> <td>Age: </td> <td><input type=\"text\" name=\"age\" size=\"40\" maxlength=\"2\" value=\"$coord[3]\"/></td> </tr>";
    echo "<tr> <td>Adresse: </td> <td><input type=\"text\" name=\"adresse\" size=\"40\" maxlength=\"60\" value=\"$coord[4]\"/></td> </tr>";
    echo "<tr> <td>Ville: </td> <td><input type=\"text\" name=\"ville\" size=\"40\" maxlength=\"20\" value=\"$coord[5]\"/></td> </tr>";
    echo "<tr> <td>e-Mail: </td> <td><input type=\"text\" name=\"mail\" size=\"40\" maxlength=\"50\" value=\"$coord[6]\"/></td> </tr>";
    echo "<tr> <td><input type=\"reset\" value=\"Effacer\"/></td> <td><input type=\"submit\" name=\"modif\" value=\"Enregistrer\"/></td> </tr>";
    echo "</table>";
    echo "</fieldset>";
    echo "<input type=\"hidden\" name=\"code\" value=\"$code\" />";
    echo "</form>";
  }
  elseif(isset($_POST['nom']) && isset($_POST['adresse']) && isset($_POST['ville']))
  {
    include('connex.inc.php');
    $nom=mysql_real_escape_string($_POST['nom']);
    $prenom=mysql_real_escape_string($_POST['prenom']);
    $adresse=mysql_real_escape_string($_POST['adresse']);
    $ville=mysql_real_escape_string($_POST['ville']);
    $mail=mysql_real_escape_string($_POST['mail']);
    $code=mysql_real_escape_string($_POST['code']);

    $requete="UPDATE client SET nom='$nom',prenom='$prenom',adresse='$adresse',ville='$ville',mail='$mail' WHERE id_client='$code'";
    $idcom=connex("magasin","myparam");
    $result=@mysql_query($requete,$idcom);
    mysql_close($idcom);
    if(!$result)
    {
      echo "<script type=\"text/javascript\">alert('Erreur : ".mysql_error()."')</script>";
    }
    else
    {
      echo "<script type=\"text/javascript\">alert('Vos modifs ont bien ete faites');window.location='Chap15_Page460.php';</script>";
    }
  }
  else
  {
    echo "Modifiez vos coordonnees!";
  }
  ?>
</body>

</html>
