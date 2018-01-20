<?php
session_start();
include_once('en_tete.php');
?>

<h2>Votre Compte Client</h2>
<br/>
<hr/>
<h4>Vous etes deja enregistré</h4>
<form action="saisie_client.php" method="post">
  <fieldset>
    <legend><b>Vos Coordonnées</b></legend>
    <table>
      <tbody>
        <tr>
          <td> Votre mail ; </td>
          <td> <input type="text" name="mail_1" size="60" maxlength="60"/><br/> </td>
        </tr>
        <tr>
          <td> Votre Code Personnel : </td>
          <td> <input type="password" name="code_1" size="10" maxlength="8"/><br/> </td>
        </tr>
        <tr>
          <td colspan="2"> <input type="submit" name="REC" value="Verifier"/> </td>
        </tr>
      </tbody>
    </table>
  </fieldset>
  <h4>Vous n'etes pas encore client</h4>
  <fieldset>
    <legend><b>Vos Coordonnées</b></legend>
    <table>
      <tbody>
        <tr>
          <td>
            Votre nom ;
          </td>
          <td>
            <input type="text" name="nom" size="40" maxlength="40"/>
          </td>
        </tr>
        <tr>
          <td>
            Votre prénom ;
          </td>
          <td>
            <input type="text" name="prenom" size="40" maxlength="40"/>
          </td>
        </tr>
        <tr>
          <td>
            Votre age ;
          </td>
          <td>
            <input type="text" name="age" size="2" maxlength="2"/>
          </td>
        </tr>
        <tr>
          <td>
            Votre adresse ;
          </td>
          <td>
            <input type="text" name="adresse" size="40" maxlength="40"/>
          </td>
        </tr>
        <tr>
          <td>
            Votre ville ;
          </td>
          <td>
            <input type="text" name="ville" size="40" maxlength="40"/>
          </td>
        </tr>
        <tr>
          <td>
            Votre mail ;
          </td>
          <td>
            <input type="text" name="mail_2" size="40" maxlength="40"/>
          </td>
        </tr>
        <tr>
          <td>
            Votre code personnel ;<br/>
            (8 caracteres maxi)
          </td>
          <td>
            <input type="password" name="code_2" size="10" maxlength="8"/>
          </td>
        </tr>
        <tr>
          <td colspan="2"> <input type="submit" name="REC" value="Enregistrer"/> </td>
        </tr>
      </tbody>
    </table>
  </fieldset>
</form>

<?php
if($_POST['REC']=="verifier")
{
  $code1=$_POST['code_1'];
  $mail1=$_POST['mail_1'];
  include_once('connex.inc.php');
  $idcom=connex("magasin_en_ligne","myparam");
  $requete="SELECT id_client,nom,prenom,age,adresse,ville,mail,code FROM clients WHERE mail='$mail1' AND code='$code1'";
  $result=mysql_query($requete,$idcom);
  if(mysql_num_rows($result)!=0)
  {
    echo "Vous etes bien déja client";
    $ligne=mysql_fetch_array($result,MYSQL_ASSOC);
    mysql_close($idcom);
    $_SESSION['id_client']=$ligne['id_client'];
    $_SESSION['nom']=$ligne['nom'];
    $_SESSION['prenom']=$ligne['prenom'];
    $_SESSION['age']=$ligne['age'];
    $_SESSION['adresse']=$ligne['adresse'];
    $_SESSION['ville']=$ligne['ville'];
    $_SESSION['mail']=$ligne['mail'];
    echo "<script type=\"text/javascript\">window.location='paiement.php'</script>";
  }
}
elseif($_POST['REC']=="Enregistrer")
{
  $nom=$_POST['nom'];
  $prenom=$_POST['prenom'];
  $age=$_POST['age'];
  $adresse=$_POST['adresse'];
  $ville=$_POST['ville'];
  $mail2=$_POST['mail_2'];
  $code2=$_POST['code_2'];
  $_SESSION['nom']=$nom;
  $_SESSION['prenom']=$prenom;
  $_SESSION['age']=$age;
  $_SESSION['adresse']=$adresse;
  $_SESSION['ville']=$ville;
  $_SESSION['mail']=$mail2;
  $_SESSION['code']=$code2;
  $_SESSION['NOUVEAU']=TRUE;
  echo "<script type=\"text/javascript\">window.location='paiement.php'</script>";
}
else
{
  echo "<script type=\"text/javascript\">alert('Erreur de Saisie');</script>";
}

include_once('pied.php')
?>
