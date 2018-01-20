<?php
include_once("en_tete.php")
?>

<h2> Enrichissez le dico des citations </h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
  <fieldset>
    <legend> Entrez une nouvelle citation </legend>
    <table>
      <tbody>
        <tr>
          <td>
            Nom de l'auteur :
          </td>
          <td>
            <input type="text" name="nom" size="40" maxlength="256">
            <br/>
          </td>
        </tr>
        <tr>
          <td>
            Prénom de l'auteur :
          </td>
          <td>
            <input type="text" name="prenom" size="40" maxlength="256">
            <br/>
          </td>
        </tr>
        <tr>
          <td>
            Choix du siècle :
          </td>
          <td>
            <select name="siecle" size="1">
              <option value="16">16ième siècle</option>
              <option value="17">17ième siècle</option>
              <option value="18">18ième siècle</option>
              <option value="19">19ième siècle</option>
              <option value="20">20ième siècle</option>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            Ecrivez la citation ci dessous
          </td>
          <td>
            <textarea name="texte" cols="70" rows="7"> </textarea>
            <br/>
          </td>
        </tr>
        <tr>
          <td><input type="submit" name="REC" value="Enregistrer">&nbsp;&nbsp;&nbsp;<input type="reset" value="Effacer"></td>
        </tr>
      </tbody>
    </table>
  </fieldset>
</form>

<?php
if(isset($_POST['REC']))
{
  $nom=$_POST['nom'];
  $prenom=$_POST['prenom'];
  $siecle=$_POST['siecle'];
  $texte=$_POST['texte'];

  include_once('connex.inc.php');
  $idcom=connex("dico","myparam");

  $reqaut="SELECT idauteur,siecle FROM auteurs WHERE nom='$nom'";
  $result=mysql_query($reqaut,$idcom) or DIE("ERREUR RESULTAT");
  $tabid=mysql_fetch_row($result);

  if($tabid)
  {
    $idaut=$tabid[0];
    $siecle=$tabid[1];
    $req="INSERT INTO citations (texte,idauteur) VALUES('$texte','$idaut')";
    mysql_query($req,$idcom) or DIE("ERREUR D INSERTION");
  }
  else
  {
    $reqaut="INSERT INTO auteurs (nom,prenom,siecle) VALUES('$nom','$prenom','$siecle')";
    mysql_query($reqaut,$idcom) or DIE("ERREUR D INSERTION");
    $idaut=mysql_insert_id();
    $reqcit="INSERT INTO citations (texte,idauteur) VALUES('$texte','$idaut')";
    mysql_query($reqcit,$idcom) or DIE("ERREUR D INSERTION");
  }

}
include_once("pied.php");
?>
