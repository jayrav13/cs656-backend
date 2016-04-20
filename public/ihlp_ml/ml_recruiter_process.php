<?php
// ml_recruiter_process --> To start the ML recruiter thread
// Script by Ajit Puthenputhussery


function ml_recruiter()
{
	// Check if any new recruiter added or updates added 
	$sql = 'SELECT id FROM users WHERE role=2 AND status=0';
	$result = mysql_query($sql, $dbh1);
	$count = mysql_num_rows($result);
	if ($count!=0){
		
		while ( $data = mysql_fetch_array($result) ){
			// Get recruiter ID
			$r_id = $data['id'];
			
			// Find candidates with the recruiter id specified
			$sql1 = 'SELECT student_id from student_recruiter WHERE recruiter_id='.$r_id;
			$result1 = mysql_query($sql1, $dbh1);
			$count1 = mysql_num_rows($result1);
			
			// if r_id changes entire candidate data has to be recalculated, therefore no if statement
			while ( $data1 = mysql_fetch_array($result1) ){
				$s_id = $data1['student_id']; // Get student id
				
				// Check if resume downloaded 
				$sql2 = 'SELECT * FROM users WHERE id='.$s_id; $result2 = mysql_query($sql2, $dbh1); $data2 = mysql_fetch_array($result2);
				$r_check = $data2['status'];
				if ($r_check==0){
					// Download resume from url provided
					$resume_url = $data2['resume'];
					ml_download_resume($resume_url, $s_id); // To download resume and save as s_id.pdf
					// Change s_id status to 1
					$sql3 = 'UPDATE users SET status=1 WHERE id='.$s_id; mysql_query($sql3, $dbh1);
					// Compute feature vector for unique r_id, s_id and store in database 
					ml_extract_feature($r_id, $s_id);
				} //if
				
				elseif ($r_check==1){
					// Compute feature vector for unique r_id, s_id and store in database 
					ml_extract_feature($r_id, $s_id);	
				}
								
			} // while (student)
			
			// Compute ranking of features 
			ml_compute_ranking($r_id);
			
			// Change r_id status to 1
			$sql4 = 'UPDATE users SET status=1 WHERE id='.$r_id; mysql_query($sql4, $dbh1);
			
		} // while (recruiter)
	
	}// if
	
}// function
	

?>

