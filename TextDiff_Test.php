<?php
require_once("vendor/autoload.php");

use TextDiff\TextDiff;

$textDiff = new TextDiff();
$diffResult =  $textDiff->diff('ABCD', 'AEBF');

var_dump($diffResult);

echo $textDiff->diff('湖山秋景远，千色变其中', '湖光秋色', true);