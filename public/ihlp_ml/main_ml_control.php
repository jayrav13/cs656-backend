<?php
// Main_ML_control.php   --> Main Control PHP File for the IHLP ML Part
// Script by Ajit Puthenputhussery

//Start time
$time_start = microtime(true);

// Include Files
include 'connect.php'; //Database connect file
include 'ml_download_resume.php'; //Download resume file
include 'ml_feature_extraction.php'; //Extract feature vector
include 'ml_extract_pdf_contents.php'; //Extract pdf contents
include 'ml_extract_feature_req.php'; //Extract feature requirements
include 'ml_compute_ranking.php'; //Compute ranking of candidates
include 'ml_distance.php'; //Distance functions
include 'ml_recruiter_process.php'; // Recruiter process thread
include 'ml_candidate_process.php'; // Candidate process thread 

// Function to check new/updated recruiters in system and start main ML functions  
ml_recruiter();

// Function to check new/updated candidates in system and start main ML functions  
ml_candidate();

//End time
$time_end = microtime(true);
//To get execution time in minutes
$execution_time = ($time_end - $time_start)/60;
//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';



?>