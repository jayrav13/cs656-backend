<?php

// Script to extract features for resume based on the job requirements posted by recruiter
// Ajit Puthenputhussery

// Connection files
include('connect.php');

$text = 'aadesh patel 10 heller court, edison, nj 08817 phone: (732) 646-1414 ? email: aadeshp95@gmail.com ? github: aadeshp education rutgers university bachelor of science in electrical/computer engineering and computer science ? ap exam: computer science (5) work experience wolfpak chief technology officer ? mobile application that allows users to share images and videos anonymously within their current geofence, and displays new brunswick, new jersey expected graduation: may 2017 new brunswick, new jersey march 2015 ? present the images and videos others posted around them in real-time (available in ios/android app store: wolfpak app) ? solely designed and built the rest api server in python using the django framework, which is hosted on amazon web services? elastic compute cloud ubuntu machines, with nginx proxy layers and a haproxy load balancer on top ? configured a postgresql database with a redis server to optimize performance of the server by heavily using caching ? independently developing the ios application with unique features such as: touch blurring, drawing, text, anonymity, and leaderboard ? managing a team of three other developers by having code reviews, assigning deadlines, and providing guidance ooyala professional services developer intern ? developing an apple tv application that retrieves data from a rest api server and allows users to watch live streams new york, new york september 2015 ? present and play different types of videos ? programmed a proxy layer, using python, that retrieves data from a source, alters the data to follow specific standards, logs all changes, and sends the altered data to a remote server. princeton, new jersey socialblood ios engineer may 2015 ? september 2015 ? solely developed a new ios application for socialblood, which is an online network of blood donors where a phone num- ber is linked to a blood type for easy emergency contact when a user is in need of a blood donor ? designed and integrated a backend as a service, called parse, for the mobile application fingertip tech eatontown, new jersey software engineer september 2014 ? november 2014 software engineer intern june 2014 ? august 2014 ? programmed high-end native and cross platform mobile applications for ios and android that queried rest api servers, ? aided in transitioning the company from a cross platform centered organization to a more native centered organization, developed using the ruby on rails framework which resulted in a significant increase in profit ? few from my selected project experience: ? on demand fitness app, developed for ios and android, that allows users to sign up for fitness sessions in real time ? parking rental app, developed as a cross platform application in c# using xamarin, that searches for parking lots within a defined radius around the user?s location, displays their pricing, and offers an option to rent in advance. image sharing app, developed for ios and android, that allows users to customize and share pictures ? personal projects property management platform august 2015 - present ? simplifies communication between a landlord and their tenants, by being able to post any maintenance/repair requests, pay rent, submit/view applications, and keep track of properties owned, all through the app ? designing and programming a real time server using the mqtt protocol to allow tenants and landlords to communicate with one another via messaging and maintenance requests in real time ? developing the server using the java spring framework, which uses the stripe api to handle all payment processing pushcpp ? push notification client for apple?s push notification services and google?s cloud messaging, written in c++ asynckit ? asynchronous library for ios, written in swift, that brings the concurrency concepts of futures and promises to ios august 2015 ? present august 2015 ? present technical skills languages: java, objective-c, swift, c++, c, python, go, ruby, c#, javascript, html, css database related: mysql, postgresql, sqlite, sql, pl/sql, mongodb ? frameworks/libraries: ruby on rails, django, django rest framework, spring framework, asp.net, aws ec2, s3 technologies: xcode, cocoapods, xamarin, git, unix, amazon web services ec2 and s3? networking: tcp, http, nginx, rest api, haproxy, websockets, mqtt ';

//************************ ONLY FOR DEMO
echo '<br>-------------------- DUMMY EXAMPLE -----------------------------<br>';
echo 'Job Title: Lead Project Application  Manager <br>';
echo 'Primary Skills : PHP, Python, SQL<br>';
echo 'Secondary Skills : C, Java, Javascript <br>';
echo 'Platform : Linux, Unix <br>';
echo 'Research Experience Index : 1 <br>';
echo 'Industry Experience Index : 3<br>';
echo 'Leadership Index : 4<br>';
echo 'GPA check required : 1(Yes) <br>';
echo 'GPA Threshold : 3.5';
echo '<br>-------------------- DUMMY EXAMPLE -----------------------------<br>';

echo '<br>-------------------- Candidate 1 -- Aadesh Patel -----------------------------<br>';
echo 'Resume ---- (in text variable)<br>';
echo $text;
echo '<br>-------------------------------------------------<br>';
echo '<br>--------------------- Unigram data with unigram score ----------------------------<br>';
//********************************************


// Extract requirements from the database
$id = 1;
$sql = 'SELECT * FROM feature_ranking WHERE id='.$id ; 
$result = mysql_query($sql);
$data = mysql_fetch_array($result);
$p_skills = $data['p_skills'];
$s_skills = $data['s_skills'];
$platforms = $data['platforms'];
$r_index = $data['r_index'];
$e_index = $data['e_index'];
$l_index = $data['l_index'];
$gpa_req = $data['gpa_req'];
$gpa_t = $data['gpa_t'];

// Feature vector
$feature = '';

// Get word frequency from the resume
$words = str_word_count($text, 1);
$frequency = array_count_values($words);
print_r($frequency);
echo '<br>';
unset($words);

// Extract email from resume
$pattern = '/[a-z0-9_\-\+]+@[a-z0-9\-]+\.([a-z]{2,3})(?:\.[a-z]{2})?/i';
// preg_match_all returns an associative array
preg_match_all($pattern, $text, $matches);
echo '<br>-------------------- Email id -----------------------------<br>';
echo $email = $matches[0][0];

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


//******************************** NEXT SECTION ***************************************************************

// Print feature vector
echo '<br>-----------------------------------------------------------------------------------------------------<br>';
echo 'Feature Vector <br>';
echo $feature.'<br>';
echo 'Feature Vector Length<br>';
echo strlen($feature).'<br>';

// Convert feature vector string to array of integers
$feature_array = array();
for($i=0;$i<strlen($feature);$i++){
	$feature_array[$i] = (int)$feature[$i];
}
echo 'Feature Vector (Array) <br>';
print_r($feature_array);
echo '<br> Feature Vector Array Length<br>';
echo count($feature_array).'<br>';

// Create best array --> For Comparison
$best_array = array();
for($i=0;$i<strlen($feature);$i++){
	$best_array[$i] = 5;
}

// Calculate distance between feature vector and best vector based on Euclidean and Cosine similarity distance
$edist = euclidean($feature_array, $best_array);
$cdist = cosinus($feature_array, $best_array);
echo '<br>-----------------------------------------------------------------------------------------------------<br>';
echo '<br> Euclidean Distance (for ranking): '.$edist.'<br>';
echo '<br> Cosine Similarity Distance (for ranking): '.$cdist.'<br>';

// Function Implementation of Euclidean Distance and Cosine Similarity Distance

/**
 * Euclidean distance
 * d(a, b) = sqrt( summation{i=1,n}((b[i] - a[i]) ^ 2) )
 *
 * @param array $a
 * @param array $b
 * @return boolean
 */
function euclidean(array $a, array $b) {
    if (($n = count($a)) !== count($b)) return false;
    $sum = 0;
    for ($i = 0; $i < $n; $i++)
        $sum += pow($b[$i] - $a[$i], 2);
    return sqrt($sum);
}


/**
 * Euclidean norm
 * ||x|| = sqrt(x·x) // · is a dot product
 *
 * @param array $vector
 * @return mixed
 */
function norm(array $vector) {
    return sqrt(dotProduct($vector, $vector));
}

/**
 * Dot product
 * a·b = summation{i=1,n}(a[i] * b[i])
 *
 * @param array $a
 * @param array $b
 * @return mixed
 */
function dotProduct(array $a, array $b) {
    $dotProduct = 0;
    // to speed up the process, use keys with non-empty values
    $keysA = array_keys(array_filter($a));
    $keysB = array_keys(array_filter($b));
    $uniqueKeys = array_unique(array_merge($keysA, $keysB));
    foreach ($uniqueKeys as $key) {
        if (!empty($a[$key]) && !empty($b[$key]))
            $dotProduct += ($a[$key] * $b[$key]);
    }
    return $dotProduct;
}

/**
 * Cosine similarity for non-normalised vectors
 * sim(a, b) = (a·b) / (||a|| * ||b||)
 *
 * @param array $a
 * @param array $b
 * @return mixed
 */
function cosinus(array $a, array $b) {
    $normA = norm($a);
    $normB = norm($b);
    return (($normA * $normB) != 0)
           ? dotProduct($a, $b) / ($normA * $normB)
           : 0;
}

?>