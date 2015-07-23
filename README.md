# php-image-compression-example-code-ACS

The following is sample code for compressing an image using PHP with Accusoft Cloud Services API.

###Overview

The Accusoft Cloud Services image compression API gives you faster image compression, decompression and higher-quality images, saving you space for storing your images and improving the performance of your website and web applications. Compress JPG, PNG, and GIF files. Learn more about [Accusoft Cloud Services image compression here](https://www.accusoft.com/products/accusoft-cloud-services/acs-compression/).

###Installation
The installation is a one-step process, simply requiring to add the sample into your project's structure.

###Usage instructions
To run the demo, point the URL your webroot, followed by `/ACS_PHP_Compress_Sample`. On step 2, a valid ACS API key is required for the API to work. 

###Example
	http://localhost/ACS_PHP_Compress_Sample
	
###Explanation
The sample code package is a fully functioning example of the ACS compress service. The call to the API is made within compress.php. Walkthrough of the contents.
####Check for a file upload
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $image );
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch);
	curl_close ($ch);



