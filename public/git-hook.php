<?php 
$output=array();

//exec('git reset --hard  2>&1', $output);
//var_dump ($output);


exec('git pull 2>&1', $output);
var_dump ($output);
?>