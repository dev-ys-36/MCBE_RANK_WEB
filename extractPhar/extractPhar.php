<?php

$file = $argv[1];

$folderPath = $file;
$folderPath = str_replace('.phar', '', $folderPath);
$pharPath = 'phar://' . $file;

foreach(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($pharPath)) as $fInfo){

    $path = $fInfo->getPathname();
    
    @mkdir(dirname($folderPath . str_replace($pharPath, '', $path)), 0755, true);
    
	file_put_contents($folderPath . str_replace($pharPath, '', $path), file_get_contents($path));

}

exec('zip -r ' . $folderPath . '.zip ' . $folderPath);

?>