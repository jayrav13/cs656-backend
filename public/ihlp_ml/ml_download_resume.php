<?php
// ml_download_resume --> To download the resume from the url and save it as the student_id
// Script by Ajit Puthenputhussery


function ml_download_resume($resume_url,$s_id){
	$path = "resume_candidates/".$s_id.".pdf";

	file_put_contents($path, file_get_contents($resume_url));

	
} // function


// Unit Testing
// ml_download_resume('http://jayravaliya.com/assets/JayRavaliya_Resume.pdf', 2);

?>