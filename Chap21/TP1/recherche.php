<?php
include_once('en_tete.php');
?>
<h3>Le site de rencontres sportives chaudes</h3>
<form method="post" action="recherche.php">

  <!-- PREMIER GROUPE -->
  <fieldset>
    <legend>Recherche de mating partner</legend>
    <table>
      <tbody>
        <!-- Premiere ligne -->
        <tr>
          <td>
            Sport pratiqué ;
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
        <!-- Deuxieme ligne -->
        <tr>
          <td>
            Choix du niveau :
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
        <!-- Troisieme ligne -->
        <tr>
          <td>
            Choix du departement ;
          </td>
          <td>
            <select name="choix_depart">
              <option value="NULL"> CHOIX </option>
              <?php
              $objdb=new SQLite3("sportifs.sqlite");
              $req_depart="SELECT depart FROM personnes";
              $result=$objdb->query($req_depart);
              while($ligne=$result->fetchArray(SQLITE3_NUM))
              {
                $tabdepart[]=$ligne[0];
              }
              $tabdepart=array_unique($tabdepart);
              sort($tabdepart);
              $count=count($tabdepart);
              for($i=0;$i<$count;$i++)
              {
                echo "<option value=\"$tabdepart[$i]\">$tabdepart[$i]</option>";
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td><input type="submit" value="envoyer" name="REC"/></td>
          <td><input type="reset" value="raz" name="RAZ"/></td>
        </tr>
      </tbody>
    </table>
  </fieldset>
</form>

<!-- CODE PHP -->
<?php
if(isset($_POST['REC']))
{
  $objdb=new SQLite3("sportifs.sqlite");
  $choix_sport=$_POST['choix_sport'];
  $choix_niveau=$_POST['choix_niveau'];
  $choix_depart=$_POST['choix_depart'];
  $requete="SELECT nom,prenom,mail,design FROM personnes,pratiques,sports WHERE personnes.id_pers=pratiques.id_pers AND sports.id_sport=pratiques.id_sport AND pratiques.niveau='{$choix_niveau}' AND sports.id_sport='{$choix_sport}' AND personnes.depart='{$choix_depart}'";
  $result=$objdb->query($requete);
  echo "<table border=\"4\" rules=\"rows\" width=\"100%\">";
  echo "<tr>";
  echo "<th colspan=\"3\">Liste des mates; </th>";
  echo "</tr>";
  while($ligne=$result->fetchArray())
  {
    echo "<tr> <td>{$ligne['prenom']}</td> <td>{$ligne['nom']}</td> <td>{$ligne['mail']}</td> </tr>";
    //echo "<tr> <td>".$ligne['prenom']."</td> <td>".$ligne['nom']."</td> <td>".$ligne['mail']."</td> </tr>";

  }
  echo "</table>";
}
?>
<a href="index.php" title="Accueil"><button type="button">ACCUEIL</button></a>
&nbsp;&nbsp;&nbsp;
<a href="ajout.php" title="Ajout"><button type="button">AJOUT/INSCRIPTION</button></a>

</body>

</html>
