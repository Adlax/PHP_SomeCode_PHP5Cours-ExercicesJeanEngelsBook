<?php
session_start();
$id_article=$_SESSION['id_article']."//".$_POST['id_article'];
$_SESSION['id_article']=$id_article;
$quantite=$_SESSION['quantite']."//".$_POST['quantite'];
$_SESSION['quantite']=$quantite;
$prix=$_SESSION['prix']."//".$_POST['prix'];
$_SESSION['prix']=$prix;
$designation=$_SESSION['designation']."//".$_POST['designation'];
$_SESSION['designation']=$designation;
unset($_POST);
$_POST=array();
include_once('en_tete.php');
include_once('connex.inc.php');
?>

<h3>Votre Panier ;</h3>
<table border="1">
  <tr>
    <th>Code Article</th>
    <th>Designation</th>
    <th>Prix Unitaire</th>
    <th>Quantite</th>
    <th>Prix Total</th>
  </tr>

    <?php
    $idcom=connex("magazin_en_ligne","myparam");
    $total=0;
    $tab_id_art=explode("//",$_SESSION['id_article']);
    $tab_quantite=explode("//",$_SESSION['quantite']);
    $tab_designation=explode("//",$_SESSION['designation']);
    $tab_prix=explode("//",$_SESSION['prix']);

    var_dump($tab_id_art);
    var_dump($tab_quantite);
    var_dump($tab_designation);
    var_dump($tab_prix);


    for($i=0;$i<count($tab_id_art);$i++)
    {
      $requete="SELECT id_article,designation,prix FROM articles WHERE id_article='".$tab_id_art[$i]."'";
      $result=mysql_query($requete,$idcom);
      while($ligne=mysql_fetch_assoc($result))
      {
        echo "<tr> <td>".$ligne['id_article']."</td> <td>".$ligne['designation']."</td> <td>".$ligne['prix']."</td> <td align=\"right\">".$tab_quantite[$i]."</td> <td align=\"right\">".round($ligne['prix']*$tab_quantite[$i],2)."</td> </tr>";
        $total+=round($ligne['prix']*$tab_quantite[$i],2);
      }
    }

    echo "<tr>";
    echo "<td colspan=\"4\"><b>Prix Total TTC</b></td> <td align=\"right\"><b>$total</b></td>";
    echo "</tr>";

    echo "</table>";
    ?>

    <a href="saisie_client.php" onclick="window.location='saisie_client.php'"><button type="button">Finaliser la Commande</button></a>

    <?php
    include_once('pied.php');
    ?>
