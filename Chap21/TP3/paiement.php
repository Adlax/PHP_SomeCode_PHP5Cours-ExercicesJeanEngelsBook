<?php
session_start();
include_once('luhn.inc.php');
include_once('connex.inc.php');
include_once('en_tete.php');
?>

<div class="bord">
  <h2>PAIEMENT</h2>
  <form action="paiement.php" method="post">
    <fieldset>
      Carte bancaire ; <input type="text" name="carte" size="16" maxlength="16"/>
      <input type="submit" name="REC" value="Payer"/>
    </fieldset>
  </form>
</div>

<?php
if(isset($_POST['REC']))
{
  $carte=$_POST['carte'];
  if(luhn($carte))
  {
    $idcom=connex("magazin_en_ligne","myparam");
    $nom=$_SESSION['nom'];
    $prenom=$_SESSION['prenom'];
    $age=$_SESSION['age'];
    $adresse=$_SESSION['adresse'];
    $ville=$_SESSION['ville'];
    $mail=$_SESSION['mail'];
    $code=$_SESSION['code'];
    var_dump($_SESSION);
    if($_SESSION['NOUVEAU'])
    {
      //$id_client="NULL";
      $requete="INSERT INTO clients VALUES(NULL,'$nom','$prenom','$age','$adresse','$ville','$mail','$code')";
      $result=mysql_query($requete,$idcom);
      $id_client=mysql_insert_id($idcom);
      if($result){echo "Client enregistré<br/>";}
    }
    else
    {
      $id_client=$_SESSION['id_client'];
    }
    $date=date("Y-m-d");
    //$id_comm="NULL";
    $requete="INSERT INTO commandes VALUES(NULL,'$id_client','$date')";
    $result=mysql_query($requete,$idcom);
    $id_comm=mysql_insert_id($idcom);
    //echo $id_comm."<br/>";
    $tab_id_article=explode("//",$_SESSION['id_article']);
    $tab_quantite=explode("//",$_SESSION['quantite']);
    $tab_designation=explode("//",$_SESSION['designation']);
    $tab_prix=explode("//",$_SESSION['prix']);
    echo "Nombre d elements dans id_article ; ".count($tab_id_article);
    for($i=1;$i<count($tab_id_article);$i++)
    {
      //echo $tab_id_article[$i]." ".$tab_quantite[$i]." ".$tab_prix[$i]."<br/>";
      $requete="INSERT INTO lignes VALUES('$id_comm','".$tab_id_article[$i]."','".$tab_quantite[$i]."','".$tab_prix[$i]."')";
      $result=mysql_query($requete,$idcom);
      if($result){echo "Ligne $i bien insérée <br/>";}
    }
    $dest="h.videlier@gmail.com";
    $objet="Votre commande";
    $texte="Bonjour ".$_SESSION['prenom']." ".$_SESSION['nom']."<br/>";
    $texte.="a l'adresse ; ".$_SESSION['adresse']."<br/>";
    $texte.="ville ; ".$_SESSION['ville']."<br/>";
    $texte.="Nous vous confirmons la commande de : <br/>";
    $total=0;
    //echo count($_SESSION['id_article']);
    for($i=1;$i<count($tab_id_article);$i++)
    {
      $texte.=$tab_quantite[$i]." ".$tab_designation[$i]." au prix de ; ".$tab_prix[$i]."&euro; soit ;".$tab_quantite[$i]*$tab_prix[$i]."&euro; <br/>";
      $quant=(double) $tab_quantite[$i];
      $prix=(double) $tab_prix[$i];
      $total+=$quant*$prix;
    }
    $texte.="<br/>D'un montant total de ; ".$total."&euro;<br/>";
    $headers='MIME-Version: 1.0' . "\r\n";
    $headers.='From: Hadlax <info@address.com>' . "\r\n";
    $headers.='Content-type: text/html; charset=iso-8859-1' . "\r\n";
    echo "<h4>$texte</h4>";
    mail($dest,$objet,$texte,$headers);
    session_destroy();
  }
  else
  {
    echo "Votre carte n'est pas valide \n";
  }
}

include_once('pied.php');
?>
