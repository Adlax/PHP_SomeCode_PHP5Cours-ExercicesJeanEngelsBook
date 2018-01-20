<?php
include_once("en_tete.php");
include_once("connex.inc.php");
$idcom=connex("dico","myparam");
//echo var_dump($idcom);
$requete="SELECT idcitation FROM citations";
$result=mysql_query($requete,$idcom) or DIE("enculé");
$nbcit=mysql_num_rows($result);
$tirage=rand(1,$nbcit);
$requeterand="SELECT texte,nom,prenom,siecle FROM citations,auteurs WHERE idcitation='$tirage' AND citations.idauteur=auteurs.idauteur";
$resrand=mysql_query($requeterand,$idcom);
$citrand=mysql_fetch_object($resrand);
mysql_close($idcom);
echo "<hr/>";
echo "<h4>".$citrand->texte."</h4>";
echo "<h4>".$citrand->prenom." ".$citrand->nom." ".$citrand->siecle."<sup>ieme</sup>siecle"."</h4>";
echo "<hr/>";
?>

<form action="affichage.php" method="post">
  <fieldset>
    <legend> <b>Recherche de Citations</b> </legend>
    <table width="100%" border="1" align="left" bordercolor="#800000" summary="Recherche">
      <tr>
        <td colspan="2" align="center">
          <h2> Recherche de Citations </h2>
        </td>
      </tr>
      <tr>
        <td>
          Mot clé ;
        </td>
        <td>
          <input type="text" name="mot_cle" size="40" maxlength="256">
        </td>
      </tr>
      <tr>
        <td>
          Choix de l auteur :
        </td>
        <td>
          <?php
          $idcom=connex("dico","myparam");
          $requete="SELECT nom FROM auteurs ORDER BY nom ASC";
          $result=mysql_query($requete,$idcom);
          echo "<select name=\"choix_auteur\" size=\"1\">";
          echo "<option value=\"tous\"> TOUS </option>";
          while($tab=mysql_fetch_assoc($result))
          {
            echo "<option value=\"{$tab['nom']}\"> {$tab['nom']} </option>";
          }
          echo "</select>";
          mysql_close($idcom);
          ?>
        </td>
      </tr>
      <tr>
        <td>
          Choix du siecle ;
        </td>
        <td>
          <select name="choix_siecle" size="1">
            <option value="0"> TOUS </option>
            <option value="16"> 16 </option>
            <option value="17"> 17 </option>
            <option value="18"> 18 </option>
            <option value="19"> 19 </option>
            <option value="20"> 20 </option>
            <option value="21"> 21 </option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="2"> Trier par auteur <input type="radio" name="tri" value="nom" checked="checked"/> ou par siecle <input type="radio" name="tri" value="siecle"/> </td>
      </tr>
      <tr>
        <td> <input type="reset" value="Effacer"> </td>
        <td> <input type="submit" value="Envoyer la recherche" name="REC"> </td>
      </tr>
      <tr>
        <td colspan="2"> <a href="index.php"><button type="button">Nouvelle Recherche</button></a> &nbsp;&nbsp; <a href="saisie.php"><button type="button">Saisie d une citation</button></a> </td>
      </tr>
    </table>
  </fieldset>
</form>

<?php
include_once("pied.php");
?>
