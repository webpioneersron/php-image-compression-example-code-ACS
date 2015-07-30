<?php

class CompressImage {
    var $apiUrl = 'https://api.accusoft.com/v1/imageReducers/';
    var $apiKey;

    function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

//calling function reduce for image compression.
function reduce($input, $output) {
    $image = file_get_contents($input);
    $imageType = mime_content_type($input);
    $strippedPath = preg_replace('/\\?.*/', '',  $input);
    $fileName = basename($strippedPath);
    $url = $this->apiUrl.$fileName;
    $header = array('acs-api-key: '.$this->apiKey);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $image );
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch).PHP_EOL;
    $responseObj = json_decode($response);
    $HTTPCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (is_object($responseObj) && property_exists($responseObj,'errorCode')) {
        echo "Please Enter a Valid ACS Key.\n";
        return false;
    }
    else if (is_object($responseObj) && $responseObj -> message ) {
        print_r($responseObj -> message."\n");
        return false;
    }
    curl_close ($ch);
    if ($imageType === "image/png") {
        $uri = "data:image/png;base64," . base64_encode($response);
    }else if ($imageType === "image/jpeg") {
        $image = imagecreatefromstring($response);
        ob_start();
        imagejpeg($image);
        $jpeg = ob_get_clean();
        $uri = "data:image/jpeg;base64," . base64_encode($jpeg);
        imagedestroy($image);
    }else if ($imageType === "image/gif") {
        $uri = "data:image/gif;base64," . base64_encode($response);
        }
     //create the new compressed image.
     $newImage = file_put_contents( $output, file_get_contents($uri));
     echo "Image Compressed Successfully.\n You can find your new image at this path : ".dirname(__FILE__)."/".$output."\n";
    }
}
?>
