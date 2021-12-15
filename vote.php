<?php

$id =  (int) $_GET['id'];
$vote = (int) $_GET['vote']; 

if (file_exists("$id.dat")) {

$data = file("$id.dat");
echo "<p><b><font color=green> Спасибо! </font></b><br /><i>*Показаны результаты до Вашего голосования:</i><p>";
}

echo "<b>$data[0]</b><p>";

for ($i=1;$i<count($data);$i++) 
{
  $votes = explode("~", $data[$i]);
  echo "$votes[0]: <b>$votes[1]</b><br>";
}

$f = fopen("$id.dat","w");
flock($f, 2);
fputs($f, "$data[0]");
for ($i=1;$i<count($data);$i++) 
{
    $votes = explode("~", $data[$i]);
    if ($i==$vote) $votes[0]++;
    fputs($f,"$votes[0]~$votes[1]");
	fflush($f);
    flock($f, 3);
}
fclose($f);
?>