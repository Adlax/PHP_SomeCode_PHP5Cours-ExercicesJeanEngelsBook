<?php
include_once('connexobject.inc.php');
$idcom=connexobject("magasin","myparam");
$requete="SELECT * FROM article ORDER BY categorie";
$result=$idcom->query($requete);
//print_r($result);
//var_dump($result);
echo "<hr/>";
if(!$result)
{
  echo "Lecture impossible";
}
else
{
  while($ligne=$result->fetch_array(MYSQLI_NUM))
  {
    //print_r($ligne);
    //echo "<hr/>";
    foreach($ligne as $data)
    {
      echo "$data &nbsp; / ";
    }
    echo "<hr/>";
  }
}
$result->free();
$idcom->close();
?>
