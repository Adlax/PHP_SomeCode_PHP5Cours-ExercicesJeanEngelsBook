<?php
if(empty($_POST['code']))
{
  header('Location:Chap16_Page488.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Modifiez Vos Coordonnées </title>
</head>

<body>
  <?php
  include('connexobject.inc.php');
  $idcom=connexobject("magasin","myparam");

  if(!isset($_POST['modif']))
  {
    $code=($_POST['code']);
    $requete="SELECT * FROM client WHERE id_client='$code'";
    $result=$idcom->query($requete);
    $coord=$result->fetch_row();
    //Formulaire
    echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\"/>";
    echo "<fieldset>";
    echo "<legend> Modif de vos Coordonnées </legend>";
    echo "<table>";
    echo "<tr> <td>Nom : </td> <td><input type=\"text\" name=\"nom\" size=\"40\" value=\"$coord[1]\"/></td> </tr>";
    echo "<tr> <td>Prenom : </td> <td><input type=\"text\" name=\"prenom\" size=\"40\" value=\"$coord[2]\"/></td> </tr>";
    echo "<tr> <td>Age : </td> <td><input type=\"text\" name=\"age\" size=\"40\" value=\"$coord[3]\"/></td> </tr>";
    echo "<tr> <td>Adresse : </td> <td><input type=\"text\" name=\"adresse\" size=\"40\" value=\"$coord[4]\"/></td> </tr>";
    echo "<tr> <td>Ville : </td> <td><input type=\"text\" name=\"ville\" size=\"40\" value=\"$coord[5]\"/></td> </tr>";
    echo "<tr> <td>e-mail : </td> <td><input type=\"text\" name=\"mail\" size=\"40\" value=\"$coord[6]\"/></td> </tr>";
    echo "<tr> <td>Reset</td> <td><input type=\"reset\" value=\"Effacer!\"/></td> </tr>";
    echo "<tr> <td>Enregistrer</td> <td><input type=\"submit\" name=\"modif\" value=\"Enregistrer!\"/></td> </tr>";
    echo "</table>";
    echo "</fieldset>";
    echo "<input type=\"hidden\" name=\"code\" value=\"$code\"/>";
    echo "</form>";
    $result->free();
    $idcom->close();
  }
  elseif(isset($_POST['nom']) && isset($_POST['ville']) && isset($_POST['adresse']))
  {
    //Enregistrement
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $age=$_POST['age'];
    $adresse=$_POST['adresse'];
    $ville=$_POST['ville'];
    $mail=$_POST['mail'];
    $code=$_POST['code'];
    $requete="UPDATE client SET nom='$nom',prenom='$prenom',age='$age',adresse='$adresse',ville='$ville',mail='$mail' WHERE id_client='$code'";
    $result=$idcom->query($requete);
    if(!$result)
    {
      echo "<script type=\"text/javascript\">alert('Erreur: ".$idcom->errno()."')</script>";
    }
    else
    {
      echo "<script type=\"text/javascript\">alert('Bien enregistré!')</script>";
    }
  }
  else
  {
    echo "Veuillez remplir les champs importants";
  }
  $result->free();
  $idcom->close();
  ?>
</body>

</html>
