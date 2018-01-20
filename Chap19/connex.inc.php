<?php
function connex($base,$auth)
{
  include_once($auth.".inc.php");
  $idcom=@mysql_connect(MYHOST,MYUSER,MYPASS);
  $idbase=@mysql_select_db($base);
  if(!$idcom|!$idbase)
  {
    echo "<script type=\"text/javascript\">alert('Connection impossible')</script>";
  }
  return $idcom;
}
?>
