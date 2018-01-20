<!DOCTYPE html>

<html lang="fr">
<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
  <title> Enregistrement etudiant </title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
      <legend> <b>Enregistrement d un etudiant</b> </legend>
      <table>
        <tbody>
          <tr colspann="4"> <th>ETUDIANT</th> </tr>
          <tr>
            <td>
              Id etudiant ;
            </td>
            <td>
              <input type="text" name="id_et"/>
            </td>
          </tr>
          <tr>
            <td>
              Mom ;
            </td>
            <td>
              <input type="text" name="nom_et"/>
            </td>
          </tr>
          <tr colspann="4"> <th>UV1</th> </tr>
          <tr>
            <td>
              Non de l UV ;
            </td>
            <td>
              <input type="text" name="non_uv1"/>
            </td>
          </tr>
          <tr>
            <td>
              Duree de l UV ;
            </td>
            <td>
              <input type="text" name="duree_uv1"/>
            </td>
          </tr>
          <tr>
            <td>
              Note de l UV ;
            </td>
            <td>
              <input type="text" name="note_uv1"/>
            </td>
          </tr>
          <tr colspann="4"> <th>UV2</th> </tr>
          <tr>
            <td>
              Non de l UV ;
            </td>
            <td>
              <input type="text" name="non_uv2"/>
            </td>
          </tr>
          <tr>
            <td>
              Duree de l UV ;
            </td>
            <td>
              <input type="text" name="duree_uv2"/>
            </td>
          </tr>
          <tr>
            <td>
              Note de l UV ;
            </td>
            <td>
              <input type="text" name="note_uv2"/>
            </td>
          </tr>
          <tr>
            <td>
              <input type="submit" name="REC" value="Envoi"/><a href="Chap19_Exo2.php"><button type="button"> VOIR </button> </a>
            </td>
          </tr>
        </tbody>
      </table>
    </fieldset>
  </form>
</body>

</html>

<?php_
if(isset($_POST['REC']))
{
  $non=$_POST['nom_et'];
  $id=$_POST['id_et'];
  $nom_uv1=$_POST['nom_uv1'];
  $duree_uv1=$_POST['duree_uv1'];
  $note_uv1=$_POST['note_uv1'];
  $nom_uv2=$_POST['nom_uv2'];
  $duree_uv2=$_POST['duree_uv2'];
  $note_uv2=$_POST['note_uv2'];
  $xml=simplexml_load_file("iut.xml");
  $chxml=$xml->asxml();
  $chxml=str_replace("</iut>","",$chxml);
  $chxml.="<etudiant id=\"$id\" nom=\"$nom\"> \n";
  $chxml.="\t <uv> \n";
  $chxml.="\t \t <nom> $nom_uv1 </nom> \n";
  $chxml.="\t \t <duree> $duree_uv1 </duree> \n";
  $chxml.="\t \t <note> $note_uv1 </note> \n";
  $chxml.="\t </uv> \n";
  $chxml.="\t <uv> \n";
  $chxml.="\t \t <nom> $nom_uv2 </nom> \n";
  $chxml.="\t \t <duree> $duree_uv2 </duree> \n";
  $chxml.="\t \t <note> $note_uv2 </note> \n";
  $chxml.="\t </uv> \n";
  $chxml.="</etudiant> \n";
  $chxml.="</iut> \n";
  $verif=file_put_contents("iut.xml",$chxml);
}
?>
