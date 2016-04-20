<?php
// ml_compute_ranking --> To compute ranking of candidates based on r_id
// Script by Ajit Puthenputhussery

// Function for primary skills
function ml_compute_ranking($r_id){
	$sql = 'SELECT student_id FROM student_recruiter WHERE recruiter_id='.$r_id;
	$result = mysql_query($sql, $dbh1);
	$rank_dist = [];
	
	while ($data = mysql_fetch_array($result)){
		$s_id = $data['student_id'];
		// Extract feature vector from s_id
		$sql1 = 'SELECT feature FROM ml_feature_vectors WHERE recruiter_id='.$r_id.' AND student_id='.$s_id;
		$result1 = mysql_query($sql1, $dbh2);
		$data1 = mysql_fetch_array($result1);
		$feature = $data1['feature'];
		
		// Convert feature vector string to array of integers
		$feature_array = array();
		for($i=0;$i<strlen($feature);$i++){
			$feature_array[$i] = (int)$feature[$i];
		}
		
		// Create best array --> For Comparison
		$best_array = array();
		for($i=0;$i<strlen($feature);$i++){
			$best_array[$i] = 5;
		}
		// Calculate distance between feature vector and best vector based on Cosine similarity distance
		$cdist = cosinus($feature_array, $best_array);
		$rank_dist[$s_id] = $cdist;
			
	} //while (student)
	
	// Sort $rank_dist array
	arsort($rank_dist);
	$rank_dist_keys = array_keys($rank_dist);
	
	$rank_id = '';
	for($i=0; $i<count($rank_dist_keys); $i++){
		if($i==(count($rank_dist_keys)-1) )
			$rank_id = $rank_id.$rank_dist_keys[i];
		else $rank_id = $rank_id.$rank_dist_keys[i].',';
	}
	
	$sql2 = 'SELECT * FROM ml_rank WHERE recruiter_id='.$r_id; 
	$result2 = mysql_query($sql2, $dbh2);
	$count2 = mysql_num_rows($result2);
	
	if ($count2==0)
		$sql3 = 'INSERT INTO ml_rank VALUES('.$r_id.',"'.$rank_id.'")';
	else
		$sql3 = 'UPDATE ml_rank SET rank_id="'.$rank_id.'" WHERE recruiter_id='.$r_id;
	mysql_query($sql3, $dbh2);
		

}// function