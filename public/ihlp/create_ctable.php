<?php
	// Script to create dynamic company table based on get variables cname and pass
	ob_start();

	$cname = $_GET['cname'];
	$pass = $_GET['pass'];

	if ($pass=='rxz532')
	{
		// Connect to DB
		include "connect.php";
		$company = "c_".$cname;
		
		$sql = 'CREATE TABLE IF NOT EXISTS '.$company.' ( r_id INT(11) NOT NULL, s_id INT(11) NOT NULL, PRIMARY KEY(r_id,s_id)  )';
		mysql_query($sql);
		mysql_close(); // Close DB connection

		echo 'Complete';
		
	}
	else
	{
		echo 'Invalid Pass';
	}

	ob_flush();
?>
