<?php
function luhn($carte)
{
  $total=0;
  $N=array();
  for($i=0;$i<strlen($carte);$i++)
  {
    $N[$i]=(integer) $carte[$i];
    if($i%2==0)
    {
      $N[$i]=2*$N[$i];
      if($N[$i]>9){$N[$i]=$N[$i]-9;}
    }
    $total+=$N[$i];
  }
  var_dump($N);
  echo $total;
  if($total%10==0)
  {
    return TRUE;
  }
  else
  {
    return FALSE;
  }
}
?>
