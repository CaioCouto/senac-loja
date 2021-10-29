<?php
function logError($e){
    date_default_timezone_set("America/Sao_Paulo");
    $filePath = dirname(dirname(__DIR__)) . '\\log.txt';
    $file = fopen($filePath, 'a');
    $errorStr = '------------------------ Cought Exception: PDOException @ ' . date('Y-m-d H:i', time()) .' ------------------------' . PHP_EOL;
    $errorStr .= 'Message: ' . $e->getMessage() . PHP_EOL;
    $errorStr .= 'Stack Trace: ' . PHP_EOL;
    $errorStr .= $e->getTraceAsString() . PHP_EOL;
    $errorStr .= "thrown " . $e->getFile() . "\n\n";
    fwrite($file, $errorStr);
    fclose($file);
}