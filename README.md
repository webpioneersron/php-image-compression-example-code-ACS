# php-image-compression-example-code-ACS

The following is sample code for compressing an image using PHP with Accusoft Cloud Services API.

###Overview

The Accusoft Cloud Services image compression API gives you faster image compression, decompression and higher-quality images, saving you space for storing your images and improving the performance of your website and web applications. Compress JPG, PNG, and GIF files. Learn more about [Accusoft Cloud Services image compression here](https://www.accusoft.com/products/accusoft-cloud-services/acs-compression/).

###Installation
The installation is a one-step process, simply requiring to add the sample into your project's structure.

Open config.php and replace everything within the quotes including the curly braces with a valid api key obtained for free from accusoft.com.

{
  "apiKey": "{{ valid key here }}"
}
This code will not function without a valid api key. Please sign up at www.accusoft.com/products/accusoft-cloud-services/portal/ to get your key.


###Usage instructions
From within the subdirectory where you installed this code example, type

php app.php mode=Operation inputFile=source Image outputFile = Output Image after Compression

    OPERATION: mode= reduce | mode = help
    inputFile: path to your image file, including filename
    outputFile: path to your output file, including the filename

###Example

	php app.php mode=reduce inputFile=../console/newimage.jpeg  outputFile=images/reducedImage.jpeg
	
###Explanation
The sample code package is a fully functioning example of the ACS compress service. The call to the API is made within app.php that Walkthrough of the contents and verify if the input file is an image with a correct path.

####Prepare data to pass into CURL using function reduce($input,$output) , Which input is the source image and the output will the image after compression.

    $image = file_get_contents($input);
    $imageType = mime_content_type($input);
    $strippedPath = preg_replace('/\\?.*/', '',  $input);
    $fileName = basename($strippedPath);
    $url = $this->apiUrl.$fileName;
    $header = array('acs-api-key: '.$this->apiKey); 

####API call
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $image );
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch).PHP_EOL;
	curl_close ($ch);

####Create a new image from the API response and echo out to AJAX
	if ($imageType === "image/png") {
		$uri = "data:image/png;base64," . base64_encode($response);
	        echo $uri;
        }else if ($imageType === "image/jpeg")
    	{
        	$image = imagecreatefromstring($response);
	        ob_start();
	        imagejpeg($image);
	        $jpeg = ob_get_clean();
	        $uri = "data:image/jpeg;base64," . base64_encode($jpeg);
	        imagedestroy($image);
	        echo $uri;
    	}else if ($imageType === "image/gif")
    	{
        	$uri = "data:image/gif;base64," . base64_encode($response);
	        echo $uri;
	}
	
    //create the new compressed image.
    $newImage = file_put_contents( $output, file_get_contents($uri));

###Support
If you have questions, please visit our online [help center](https://accusofthelp.zendesk.com/hc/en-us).

