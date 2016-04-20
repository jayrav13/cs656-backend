<?php
// ml_extract_feature_req --> To extract feature requirements from the recruiter
// Returns variable (skills)
// Script by Ajit Puthenputhussery

// Function for primary skills
function ml_extract_p_skills($r_id){
	$sql = "SELCT skill FROM primary_skills WHERE recruiter_id=".$r_id;
	$result = mysql_query($sql, $dbh1);
	$count = mysql_num_rows($result);
	$p_skills='';
	for ($i=0; $i<$count; $i++){
		$data = mysql_fetch_array($result))
		if ($i == ($count-1) )
			$p_skills = $p_skills.$data['skill'];
		else $p_skills = $p_skills.$data['skill'].',';
	}// for
	return $p_skills;
	
}// function ml_extract_p_skills()


// Function for secondary skills
function ml_extract_s_skills($r_id){
	$sql = "SELCT skill FROM secondary_skills WHERE recruiter_id=".$r_id;
	$result = mysql_query($sql, $dbh1);
	$count = mysql_num_rows($result);
	$s_skills='';
	for ($i=0; $i<$count; $i++){
		$data = mysql_fetch_array($result))
		if ($i == ($count-1) )
			$s_skills = $s_skills.$data['skill'];
		else $s_skills = $s_skills.$data['skill'].',';
	}// for
	return $s_skills;
	
}// function ml_extract_s_skills()

// Function for platforms
function ml_extract_platforms($r_id){
	$sql = "SELCT platform FROM platform WHERE recruiter_id=".$r_id;
	$result = mysql_query($sql, $dbh1);
	$count = mysql_num_rows($result);
	$platforms='';
	for ($i=0; $i<$count; $i++){
		$data = mysql_fetch_array($result))
		if ($i == ($count-1) )
			$platforms = $platforms.$data['platform'];
		else $platforms = $platforms.$data['platform'].',';
	}// for
	return $platforms;
	
}// function ml_extract_platforms()

// Function for additional skills
function ml_extract_a_skills($r_id){
	$sql = "SELCT * FROM additional_skills WHERE recruiter_id=".$r_id;
	$result = mysql_query($sql, $dbh1);
	$data = mysql_fetch_array($sql);
	
	$r_index = $data['research_exp'];
	$e_index = $data['industry_exp'];
	$l_index = $data['leadership'];
	$gpa_req = $data['gpa_required'];
	$gpa_t = $data['gpa_threshold'];
	
	return (array($r_index, $e_index, $l_index, $gpa_req, $gpa_t));
	
	
}// function ml_extract_a_skills()

?>