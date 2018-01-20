<?php
function connexobject($base,$myparam)
{
  include_once($myparam.".inc.php");
  $idcom=new mysqli(MYHOST,MYUSER,MYPASS,$base);
  if(!$idcom)
  {
    echo "<script type=text/javascript>alert('Connexion impossible')</script>";
    exit();
  }
  return $idcom;
}
