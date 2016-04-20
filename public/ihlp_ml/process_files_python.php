<?php
// Script to process the pdf files, convert to text and store in database
// Ajit Puthenputhussery

// Connection files
include('connect.php');

// This part has to be integrated with the Laravel Framework
// Access resumes in directory

$directory = 'resumes';
$scanned_directory = scandir($directory);
print_r($scanned_directory);

// HTML body tag
echo '<body style="background-color: #63798c; background-image: url(http://www.transparenttextures.com/patterns/45-degree-fabric-light.png);" >';


for ($i=2; $i<sizeof($scanned_directory); $i++){	
	$filename = 'resumes/'.$scanned_directory[$i];
	
	
	// Call to Python function to parse pdf file and build necessary objects.

	$text = json_decode(exec('python pdf_python/extract_pdf.py '.$filename), true);
	
	echo '<div style="width:92%; padding:0.5%; font-family:Helvetica; font-size:16px; border:2px solid black;margin:2% auto; background-color: #fff;">';
	

	
	echo "<br><br>Text<br><br>";
	$text = preg_replace('/(?:(?:\r\n|\r|\n)\s*){2}/s', "\n", $text);
	
	if (strlen($text)>7500)
	{
		$text = str_replace(array("\r\n", "\n", "\r"),'', $text); 
	}
	
	// $text = nl2br($text);
	
	echo utf8_decode(strtolower($text));
	
	echo '<br><br>String Length: '.strlen($text);
	echo '</div>';
	
}



echo '</body>'


?>