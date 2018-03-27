<?php
ini_set('display_errors', 1);
$myfile = fopen("logs/newfile.txt", "a+") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);
fclose($myfile);
