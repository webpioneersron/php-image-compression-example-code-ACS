<?php
require_once('./config.php');
require_once('./argValidator.php');
require_once('./compress.php');

$params = [];
for($i = 0; $i < $argc; $i++) {
    if (strpos($argv[$i], '=') !== FALSE) {
        $argument = explode('=', $argv[$i]);
        $params[$argument[0]] = $argument[1];
    }
}

$params = validateArgs($params);

if($params) {
    $compress = new CompressImage(ACS_API_KEY);
    if($params['mode'] === 'reduce') {
        $compress->reduce($params['inputFile'], $params['outputFile']);
    }
}
?>
