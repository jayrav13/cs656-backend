<?php
// ml_extract_pdf_contents --> To extract contents from pdf resume file
// Returns $text (contents in php variable)
// Script by Ajit Puthenputhussery


function ml_extract_pdf_contents($s_id){
	$filename = 'resume_candidates/'.$s_id.'.pdf';
	// Call to Python function to parse pdf file and build necessary objects.
	$text = json_decode(exec('python pdf_python/extract_pdf.py '.$filename), true);
	$text = preg_replace('/(?:(?:\r\n|\r|\n)\s*){2}/s', "\n", $text);
	// Compress large resume
	if (strlen($text)>7500)
	{
		$text = str_replace(array("\r\n", "\n", "\r"),'', $text); 
	}
	
	$text = utf8_decode($text);
	$text = strtolower($text);
	return $text;
}

?>