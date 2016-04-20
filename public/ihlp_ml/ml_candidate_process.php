<?php
// ml_candidate_process --> To start the ML candidate thread
// Script by Ajit Puthenputhussery


function ml_candidate(){
	global $dbh1, $dbh2; // Global variables for database connections
	$urid_rank=[];
	$urid_c = 0;
	// Check if any new candidate added or updates added 
	$sql = 'SELECT * FROM users WHERE role=1 AND status!=2';
	$result = mysql_query($sql, $dbh1);
	while($data = mysql_fetch_array($result)){
		$s_id = $data['id'];
		$s_check = $data['status'];
		
		if($s_check==0){
			// Download resume from url provided
			$resume_url = $data2['resume'];
			ml_download_resume($resume_url, $s_id); // To download resume and save as s_id.pdf
			// Change s_id status to 1
			$sql1 = 'UPDATE users SET status=1 WHERE id='.$s_id; mysql_query($sql1, $dbh1);			
			// Find all recruiters that candidate has applied to
			$sql2 = 'SELECT recruiter_id FROM student_recruiter WHERE student_id='.$s_id;
			$result2 = mysql_query($sql2,$dbh1);
			$count2 = mysql_num_rows($result2);
			if($count2!=0){
				while($data2 = mysql_fetch_array($result2) ){
					$r_id = $data2['recruiter_id'];
					// Compute feature vector for unique r_id, s_id and store in database 
					ml_extract_feature($r_id, $s_id);
					// Update urid_rank to compute ranking for updated r_id
					$urid_rank[$urid_c] = $r_id;
					$urid_c = $urid_c + 1;
				
				} // while
			}//if
			
		}// if
		elseif($s_check==1){
			// Check if student applied to new recruiters
			$sql3 = 'SELECT recruiter_id FROM student_recruiter WHERE student_id='.$s_id;
			$result3 = mysql_query($sql3,$dbh1);
			$rid_sr=[]; $rid_src = 0;
			while($data3 = mysql_fetch_array($result3) ){
				$rid_sr[$rid_src] = $data3['recruiter_id'];
				$rid_src = $rid_src + 1;
			}
			
			$sql4 = 'SELECT recruiter_id FROM ml_feature_vectors WHERE student_id='.$s_id;
			$result4 = mysql_query($sql4,$dbh2);
			$rid_ml=[]; $rid_mlc = 0;
			while($data4 = mysql_fetch_array($result4) ){
				$rid_ml[$rid_mlc] = $data4['recruiter_id'];
				$rid_mlc = $rid_mlc + 1;
			}
			
			if (count($rid_sr)>count($rid_ml))
			{
				$new_rid = 	array_values(array_diff($rid_sr, $rid_ml));
				for( $i=0; $i<count($new_rid); $i++ ){
					// Compute feature vector for unique r_id, s_id and store in database 
					ml_extract_feature($r_id, $s_id);
					// Update urid_rank to compute ranking for updated r_id
					$urid_rank[$urid_c] = $r_id;
					$urid_c = $urid_c + 1;
				}
			}
			
		}//else-if
		
	}//while (student)
		
	// Update ranking based on changes to r_ids
	for( $i=0; $i<count($urid_rank); $i++ ){
		$r_id = $urid_rank[$i];
		ml_compute_ranking($r_id);
	}//for
		
} // fucnction ml_candidate()