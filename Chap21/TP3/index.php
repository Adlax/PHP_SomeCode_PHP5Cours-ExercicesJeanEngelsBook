<?php
session_start();
include_once("en_tete.php");
echo "<br/>";
echo "<hr/>";
echo "<br/>";
include_once("connex.inc.php");
$idcom=connex("magazin_en_ligne","myparam");
?>
<div class="bord">
  <form action="index.php" method="post">
    <fieldset>
      Rechercher un article ; <input type="text" name="mot_cle" size="30" maxlength="256"/>
      Catégorie ;
      <select name="categorie" size="1">
        <option value="tout">TOUT</option>
        <option value="video">Vidéos</option>
        <option value="photo">Photos</option>
        <option value="informatique">Informatique</option>
        <option value="divers">Divers</option>
      </select>
      Trier par ; marque <input type="radio" name="tri" value="designation" checked="checked"/> prix <input type="radio" name="tri" value="prix"/>&nbsp;&nbsp;<input type="submit" name="REC" value="OK"/>
    </fieldset>
  </form>

  <br/>

  <?php
  if(isset($_POST['REC']))
  {
    $mot_cle=$_POST['mot_cle'];
    $categorie=$_POST['categorie'];
    $tri=$_POST['tri'];
    $requete="SELECT id_article,designation,prix FROM magazin_en_ligne.articles WHERE ";
    if(isset($mot_cle))
    {
      $requete.="designation LIKE '%$mot_cle%'";
    }
    if($categorie!="tout")
    {
      $requete.=" AND categorie LIKE '%$categorie%'";
    }
    $requete.=" ORDER BY $tri";
    echo $requete;
    $result=mysql_query($requete,$idcom);
    $nbarts=mysql_num_rows($result);
    echo "<h3>Il y a $nbarts articles résultats de votre recherche</h3>";
    while($tab=mysql_fetch_assoc($result))
    {
      echo "<form action=\"panier.php\" method=\"post\">";
      echo "<div class=\"bord\"><b>".$tab['designation']."</b> <br/>";
      echo "Prix unitaire ; ".$tab['prix']." &euro; <br/>";
      echo "Référence ; ".$tab['id_article']."<br/>";
      echo "Choisir la quantité ; <input type=\"text\" name=\"quantite\" size=\"2\" maxlength=\"2\" value=\"0\"/>";
      echo "<input type=\"submit\" value=\"COMMANDER\"/>";
      echo "<input type=\"hidden\" name=\"id_article\" value=\"{$tab['id_article']}\"/>";
      echo "<input type=\"hidden\" name=\"designation\" value=\"{$tab['designation']}\"/>";
      echo "<input type=\"hidden\" name=\"prix\" value=\"{$tab['prix']}\"/>";
      echo "</div>";
      echo "</form>";
    }
  }
  ?>

</div>

<?php
echo "<br/>";
echo "<hr/>";
echo "<br/>";
include_once('pied.php');
?>
