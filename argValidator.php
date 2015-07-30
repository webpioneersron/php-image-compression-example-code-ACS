<?php
function validateArgs($args) {
    if(array_key_exists('mode', $args) && $args['mode'] === 'help') {
        echo'Usage: php app.php mode=reduce|help outputFile=<file> [options]'.PHP_EOL;
        echo'Perform reduce operation and store results in the outputFile'.PHP_EOL;
        echo'Options'.PHP_EOL;
        echo'  mode="reduce" The function to compress the inputFile'.PHP_EOL;
        echo'  inputFile=<file> a png, jpg, or gif file required for compression'.PHP_EOL;
        echo'  outputFile=<file> a png, jpg, or gif file required to save compressed image'.PHP_EOL;
        echo'  Example of usage : php app.php mode=reduce inputFile=image.jpeg outputFile=newimage.jpeg'.PHP_EOL;
        return false;
    }

    if (!array_key_exists('mode', $args) || ($args['mode'] !== 'reduce' )) {
        echo 'Please enter a valid mode ("reduce") for image compression.'.PHP_EOL;
        echo 'Type "php app.php mode=help" for help.'.PHP_EOL;
        return false;
    }

    if(!array_key_exists('outputFile', $args)) {
        echo 'Please enter a valid output filename.'.PHP_EOL;
        return false;
    }

    if(!array_key_exists('inputFile', $args) || !file_exists($args['inputFile'])) {
        echo 'Please enter a valid input filename.'.PHP_EOL;
        return false;
    }

     return $args;
}
?>
