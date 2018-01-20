<?php
include("connex.inc.php");
$idcom=connex("magasin","myparam");
$requete="SELECT * FROM article";
$result=mysql_query($requete,$idcom);
$chxml="<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\" ?> \n <magasin> \n";
while($ligne=mysql_fetch_array($result,MYSQL_ASSOC))
{
  $chxml.="<article id=\"{$ligne['id_article']}\" categorie=\"{$ligne['categorie']}\" > \n";
  $chxml.="<designation>{$ligne['designation']}</designation> \n";
  $chxml.="<prix>{$ligne['prix']}</prix> \n";
  $chxml.="</article> \n";
}
$chxml.="</magasin>";
file_put_contents("db_magasin_table_article.xml",$chxml);
?>
