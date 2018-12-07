<?php
$dia_actual=date('d');
$mes=date('m');
$anio=date('Y');
$dias_mes=date('t');
$dia=1;

$seg_dia1=mktime(0,0,0,$mes,1,$anio);
$array_dia1=getdate($seg_dia1);
$dia1=$array_dia1['wday'];
if($dia==0)
	$dia1=7;

echo "<table border='1'>";
echo "<tr>";
echo "<td>L</td><td>M</td><td>X</td><td>J</td><td>V</td><td>S</td><td>D</td>";
echo "</tr>";
echo "<tr>";

for($i=1;$i<$dia1;$i++)
{
	echo "<td>&nbsp;</td>";
}

for($i=$dia1;$i<8;$i++)
{
	echo "<td>".$dia."</td>";
	$dia++;
}
echo "</tr>";

$num=ceil(($dias_mes-$dia+1)/7);


for($i=1;$i<=$num;$i++)
{
	echo "<tr>";
	for($j=1;$j<8;$j++)
	{
		if($dia>$dias_mes)
		{
			echo "<td>&nbsp;</td>";
		}
		else
		{
			echo "<td>".$dia."</td>";
			$dia++;
		}
	}
	echo "</tr>";	
}
echo "</table>";

?>