<?php

// Script to extract features for resume based on the job requirements posted by recruiter
// Ajit Puthenputhussery

function ml_extract_feature($r_id,$s_id){
	global $dbh1, $dbh2; // Global variables for database connections
	// Extract resume in text format(php variable) from the resume pdf
	$text = ml_extract_pdf_contents($s_id);
	// echo strtolower($text);
	// Extract feature requirements for unique r_id
	$p_skills = ml_extract_p_skills($r_id);
	$s_skills = ml_extract_s_skills($r_id);
	$platforms = ml_extract_platforms($r_id);
	$a_skills = ml_extract_a_skills($r_id);
	$r_index = $a_skills[0];
	$e_index = $a_skills[1];
	$l_index = $a_skills[2];
	$gpa_req = $a_skills[3];
	$gpa_t = $a_skills[4];

	// Feature vector
	$feature = '';

	// Get unigram data and unigram score from the extracted resume
	$words = str_word_count($text, 1);
	$frequency = array_count_values($words);
	unset($words);

	// Extract email from resume
	$pattern = '/[a-z0-9_\-\+]+@[a-z0-9\-]+\.([a-z]{2,3})(?:\.[a-z]{2})?/i';
	// preg_match_all returns an associative array
	preg_match_all($pattern, $text, $matches);
	$email = $matches[0][0];

	// Feature Score for primary skills --> 1 skill results in 5 features of feature vector  --> Scaling grade from 0-5
	// If skill found in resume 1 time --> 3
	// if skill found in resume 2 times --> 4
	// if skill found more than 2 times --> 5
	// Maximum skills allowed --> 10
	$p_skills = strtolower($p_skills);
	$p_skills_arr = explode(",",$p_skills);

	if(count($p_skills_arr)<=10){
		for($i=0;$i<count($p_skills_arr);$i++){
			$p_skl = $p_skills_arr[$i];
			$p_skl = trim($p_skl);
			if (array_key_exists($p_skl, $frequency)){
				$p_skl_count = $frequency[$p_skl];
				if($p_skl_count == 1)
					$feature = $feature."33333";
				elseif($p_skl_count == 2)
					$feature = $feature."44444";
				elseif($p_skl_count >=3)
					$feature = $feature."55555";			
			}
			else
				$feature = $feature."00000";
		}
	}
	else {
			for($i=0;$i<10;$i++){
			$p_skl = $p_skills_arr[$i];
			$p_skl = trim($p_skl);
			if (array_key_exists($p_skl, $frequency)){
				$p_skl_count = $frequency[$p_skl];
				if($p_skl_count == 1)
					$feature = $feature."33333";
				elseif($p_skl_count == 2)
					$feature = $feature."44444";
				elseif($p_skl_count >=3)
					$feature = $feature."55555";			
			}
			else
				$feature = $feature."00000";
		}
	}
			

	// Feature Score for secondary skills --> 1 skill results in 2 features of feature vector  --> Scaling grade from 0-5
	// If skill found in resume 1 time --> 3
	// if skill found in resume 2 times --> 4
	// if skill found more than 2 times --> 5
	// Maximum skills allowed --> 10
	$s_skills = strtolower($s_skills);
	$s_skills_arr = explode(",",$s_skills);

	if(count($s_skills_arr)<=10){
		for($i=0;$i<count($s_skills_arr);$i++){
			$s_skl = $s_skills_arr[$i];
			$s_skl = trim($s_skl);
			if (array_key_exists($s_skl, $frequency)){
				$s_skl_count = $frequency[$s_skl];
				if($s_skl_count == 1)
					$feature = $feature."33";
				elseif($s_skl_count == 2)
					$feature = $feature."44";
				elseif($s_skl_count >=3)
					$feature = $feature."55";			
			}
			else
				$feature = $feature."00";
		}
	}
	else {
			for($i=0;$i<10;$i++){
			$s_skl = $s_skills_arr[$i];
			$s_skl = trim($s_skl);
			if (array_key_exists($s_skl, $frequency)){
				$s_skl_count = $frequency[$s_skl];
				if($s_skl_count == 1)
					$feature = $feature."33";
				elseif($s_skl_count == 2)
					$feature = $feature."44";
				elseif($s_skl_count >=3)
					$feature = $feature."55";			
			}
			else
				$feature = $feature."00";
		}
	}		

	// Feature Score for platforms --> 1 skill results in 2 features of feature vector  --> Scaling grade from 0-5
	// If skill found in resume 1 time --> 3
	// if skill found more than 2 times --> 5
	// Maximum skills allowed --> 10
	$platforms = strtolower($platforms);
	$platforms_arr = explode(",",$platforms);

	if(count($platforms_arr)<=10){
		for($i=0;$i<count($platforms_arr);$i++){
			$plf = $platforms_arr[$i];
			$plf = trim($plf);
			if (array_key_exists($plf, $frequency)){
				$plf_count = $frequency[$plf];
				if($plf_count == 1)
					$feature = $feature."33";
				elseif($plf_count >=2)
					$feature = $feature."55";			
			}
			else
				$feature = $feature."00";
		}
	}
	else {
			for($i=0;$i<10;$i++){
			$plf = $platforms_arr[$i];
			$plf = trim($plf);
			if (array_key_exists($plf, $frequency)){
				$plf_count = $frequency[$plf];
				if($plf_count == 1)
					$feature = $feature."33";
				elseif($plf_count >=2)
					$feature = $feature."55";			
			}
			else
				$feature = $feature."00";
		}
	}		

	// Feature score for Research based on r_index --> results in 5 features of feature vector --> Scaling grade from 0-5
	if($r_index==0) // No research experience required
		$feature = $feature."00000";
	else{
		$research_array = array('research','publications','publication');
		for($i=0;$i<count($research_array);$i++){
			$r_key = $research_array[$i];
			if (array_key_exists($r_key, $frequency)){
				//Logic based on name --> To figure out no. of publications
				$feature = $feature.(string)$r_index.(string)$r_index.(string)$r_index.(string)$r_index.(string)$r_index;
				break;
			}
			else{
				if ($i == (count($research_array)-1))	
					$feature = $feature."00000";
			}
		}
		
	}


	// Feature score for Experience based on e_index --> results in 5 features of feature vector --> Scaling grade from 0-5
	if($e_index==0) // No experience required
		$feature = $feature."00000";
	else{
		$exper_array = array('industry','experience','work');
		for($i=0;$i<count($exper_array);$i++){
			$e_key = $exper_array[$i];
			if (array_key_exists($e_key, $frequency)){
				//Logic based on name --> To figure out no. of publications
				$feature = $feature.(string)$e_index.(string)$e_index.(string)$e_index.(string)$e_index.(string)$e_index;
				break;
			}
			else{
				if ($i == (count($exper_array)-1))	
					$feature = $feature."00000";
			}
		}
		
	}

	// Feature score for Leadership based on l_index --> results in 5 features of feature vector --> Scaling grade from 0-5
	if($l_index==0) // No leadership experience required
		$feature = $feature."00000";
	else{
		$leader_array = array('industry','experience','work');
		for($i=0;$i<count($leader_array);$i++){
			$l_key = $leader_array[$i];
			if (array_key_exists($l_key, $frequency)){
				//Logic based on name --> To figure out no. of publications
				$feature = $feature.(string)$l_index.(string)$l_index.(string)$l_index.(string)$l_index.(string)$l_index;
				break;
			}
			else{
				if ($i == (count($leader_array)-1))	
					$feature = $feature."00000";
			}
		}
		
	}

	// GPA Requirement --> results in results in 2 features of feature vector --> Scaling grade from 0-5
	if($gpa_req==1){ // GPA check required
		$gpa_array = array('gpa','cgpa','gpa:','cgpa:');
		for($i=0;$i<count($gpa_array);$i++){
			$gpa_key = $gpa_array[$i];
			if (array_key_exists($gpa_key, $frequency)){
				$g_index = strpos($text, $gpa_key);
				$g_substr = substr($text, $g_index, 11);
				preg_match('/((?:[0-9]+,)*[0-9]+(?:.[0-9]+)?)/', $g_substr, $g_match);
				if (array_key_exists(0,$g_match)){
				  // GPA found in resume
				  $gpa_val = $g_match[0];
				  if ($gpa_val >= $gpa_t){
					$feature = $feature."55";
					break;
				  }
				  else{
					$feature = $feature."00";
					break;
				  } 				
				}
				else{ 
					if ($i == (count($gpa_array)-1))
						$feature = $feature."00"; // GPA not found in resume
				}				
			}
			else{ 
				if ($i == (count($gpa_array)-1))
					$feature = $feature."00"; // GPA not found in resume
			}
		
		}
		
	}
	

	
	
	// Check if old feature vectors exist else create new feature vector
	$sql = "SELECT feature FROM ml_feature_vectors WHERE recruiter_id=".$r_id." AND student_id=".$s_id;
	$result = mysql_query($sql, $dbh2);
	$count = mysql_num_rows($result);
	if ($count==0)
		$sql = 'INSERT INTO ml_feature_vectors VALUES('.$r_id.','.$s_id.',"'.$feature.'")'; // Save new feature vectors to database
	else 
		$sql = 'UPDATE ml_feature_vectors SET feature="'.$feature.'" WHERE recruiter_id='.$r_id.' AND student_id='.$s_id;
	mysql_query($sql, $dbh2);	

}// function

// Unit Testing
// ml_extract_feature(2, 4);

//******************************** NEXT SECTION ***************************************************************

// // Print feature vector
// echo '<br>-----------------------------------------------------------------------------------------------------<br>';
// echo 'Feature Vector <br>';
// echo $feature.'<br>';
// echo 'Feature Vector Length<br>';
// echo strlen($feature).'<br>';

// // Convert feature vector string to array of integers
// $feature_array = array();
// for($i=0;$i<strlen($feature);$i++){
	// $feature_array[$i] = (int)$feature[$i];
// }
// echo 'Feature Vector (Array) <br>';
// print_r($feature_array);
// echo '<br> Feature Vector Array Length<br>';
// echo count($feature_array).'<br>';

// // Create best array --> For Comparison
// $best_array = array();
// for($i=0;$i<strlen($feature);$i++){
	// $best_array[$i] = 5;
// }

// // Calculate distance between feature vector and best vector based on Euclidean and Cosine similarity distance
// $edist = euclidean($feature_array, $best_array);
// $cdist = cosinus($feature_array, $best_array);
// echo '<br>-----------------------------------------------------------------------------------------------------<br>';
// echo '<br> Euclidean Distance (for ranking): '.$edist.'<br>';
// echo '<br> Cosine Similarity Distance (for ranking): '.$cdist.'<br>';



?>