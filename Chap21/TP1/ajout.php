<?php
include_once('en_tete.php');
?>
<form action="ajout.php" method="post">

  <!-- PREMIER GROUPE -->
  <fieldset>
    <legend> Entrez vos Coordonnees </legend>
    <table>
      <tbody>
        <tr>
          <td>
            Entrez votre nom ;
          </td>
          <td>
            <input type="text" name="nom" size="30"/>
          </td>
        </tr>
        <tr>
          <td>
            Entrez votre prenom ;
          </td>
          <td>
            <input type="text" name="prenom" size="30"/>
          </td>
        </tr>
        <tr>
          <td>
            Entrez votre departement ;
          </td>
          <td>
            <input type="text" name="depart" size="30"/>
          </td>
        </tr>
        <tr>
          <td>
            Entrez votre mail ;
          </td>
          <td>
            <input type="text" name="mail" size="30"/>
          </td>
        </tr>
      </tbody>
    </table>
  </fieldset>

  <!-- DEUXIEME GROUPE -->
  <fieldset>
    <legend> Vos pratiques sportives </legend>
    <table>
      <tbody>
        <tr>
          <td>
            Sport pratique ;
          </td>
          <td>
            <select name="choix_sport">
              <option value="NULL">Choix</option>
              <?php
              $objdb=new SQLite3("sportifs.sqlite");
              $requete="SELECT id_sport,design FROM sports ORDER BY design ASC";
              $result=$objdb->query($requete);
              if($result)
              {
                while($ligne=$result->fetchArray(SQLITE3_NUM))
                {
                  echo "<option value=\"{$ligne[0]}\">{$ligne[1]}</option>";
                }
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            OU ; Ajouter un de vos sport a la liste <input type="text" name="neo_sport" size="30"/>
            <input type="submit" name="ajout" value="Ajout d un sport"/>
          </td>
        </tr>
        <tr>
          <td>
            Votre niveau ;
          </td>
          <td>
            <select name="choix_niveau">
              <option value="1">Debutant</option>
              <option value="2">Confirme</option>
              <option value="3">Pro</option>
              <option value="4">Supporter</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><input type="submit" value="Envoi" name="REC"/></td>
          <td><input type="reset" value="RAZ"/></td>
        </tr>
      </tbody>
    </table>
  </fieldset>

</form>
<a href="index.php" title="Accueil"><button type="button"> Accueil </button></a>

<!-- CODE PHP -->
<?php
$objdb=new SQLite3('sportifs.sqlite');
if(isset($_POST['REC']))
{
  $nom=$_POST['nom'];
  $prenom=$_POST['prenom'];
  $depart=$_POST['depart'];
  $mail=$_POST['mail'];
  $choix_sport=$_POST['choix_sport'];
  $choix_niveau=$_POST['choix_niveau'];
  $req_pers="INSERT INTO personnes VALUES(NULL,'$nom','$prenom','$depart','$mail')";
  $objdb->query($req_pers);
  $id_pers=$objdb->lastInsertRowID();
  $req_pratique="INSERT INTO pratiques VALUES('$id_pers','$choix_sport','$choix_niveau')";
  $objdb->query($req_pratique);
  echo "<a href=\"recherche.php\" title=\"recherche de partenaires\"><button type=\"button\"> RECHERCHE MATING PARTNER </button></a>";
  echo "<br/>";
  echo "Votre identifiant sans-dents ; ".$id_pers."<br/>";
}
if(isset($_POST['ajout']))
{
  $neo_sport=$_POST['neo_sport'];
  $req_sports="INSERT INTO sports VALUES(NULL,'$neo_sport')";
  $verif=$objdb->query($req_sports);
  if($verif)
  {
    echo "Sport bien inséré <br/>";
  }
}
?>

</body>

</html>
