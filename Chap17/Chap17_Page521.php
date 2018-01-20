<?php
if(empty($_POST['code']))
{
  header('Location:Chap17_Page520.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Modif des Coordonnées </title>
</head>

<body>
  <?php
  include('connexpdo.inc.php');
  $idcom=connexpdo("magasin","myparam");
  if(!isset($_POST['modif']))
  {
    $code=(integer)$_POST['code'];
    $requete="SELECT * FROM client WHERE id_client='$code'";
    $result=$idcom->query($requete);
    $coord=$result->fetch(PDO::FETCH_NUM);
    echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">";
    echo "<fieldset>";
    echo "<legend> <b>Vos Coordonnées</b> </legend>";
    echo "<table>";
    echo "<tr> <td>Nom;</td> <td><input type=\"text\" name=\"nom\" size=\"40\" maxlength=\"30\" value=\"$coord[1]\" /></td> </tr>";
    echo "<tr> <td>Prenom;</td> <td><input type=\"text\" name=\"prenom\" size=\"40\" maxlength=\"30\" value=\"$coord[2]\" /></td> </tr>";
    echo "<tr> <td>Age;</td> <td><input type=\"text\" name=\"age\" size=\"40\" maxlength=\"30\" value=\"$coord[3]\" /></td> </tr>";
    echo "<tr> <td>Adresse;</td> <td><input type=\"text\" name=\"adresse\" size=\"40\" maxlength=\"30\" value=\"$coord[4]\" /></td> </tr>";
    echo "<tr> <td>Ville;</td> <td><input type=\"text\" name=\"ville\" size=\"40\" maxlength=\"30\" value=\"$coord[5]\" /></td> </tr>";
    echo "<tr> <td>e-Mail;</td> <td><input type=\"text\" name=\"mail\" size=\"40\" maxlength=\"30\" value=\"$coord[6]\" /></td> </tr>";
    echo "<tr> <td><input type=\"submit\" value=\"Envoyer!\" name=\"modif\"/></td> <td><input type=\"reset\" value=\"Reset!\" /></td> </tr>";
    echo "</table>";
    echo "</fieldset>";
    echo "<input type=\"hidden\" name=\"modif\" value=\"$code\" />";
    echo "</form>";
    $result->closeCursor();
    $idcom=NULL;
  }
  elseif( isset($_POST['nom']) && isset($_POST['adresse']) && isset($_POST['ville']) )
  {
    $code=$_POST['code'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $age=$_POST['age'];
    $adresse=$_POST['adresse'];
    $ville=$_POST['ville'];
    $mail=$_POST['mail'];

    $requete="UPDATE client SET nom=$nom,prenom=$prenom,age=$age,adresse=$adresse,ville=$ville,mail=$mail WHERE id_client='$code'";
    $result=$idcom->exec($requete);

    if($result!=1)
    {
      $mes_erreures=$idcom->errorInfo();
      echo "<script type=\"text/javascript\">alert('Impossibilité, due au code ;".$idcom->errorCode()." a cause de ;".$mes_erreures[2]."')</script>";
    }
    else
    {
      echo "<script type=\"text/javascript\">alert('Mise a Jour bien enregistrée!');window.location='Chap17_Page520.php';</script>";
    }
    $idcom=NULL;
  }
  else
  {
    echo "Modifiez vos Coordonnées";
  }
  ?>
</body>

</html>
