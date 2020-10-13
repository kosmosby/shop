<?php
$arr = array('key'=>array(
        'count' => 1,
));

$x = 5 + 2;
$x *= 2;
$x += 2;

for ($i=0;$i<10;$i++){
    $arr['key']['count']=$x+$i;
}
echo $x;