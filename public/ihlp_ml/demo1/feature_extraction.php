<?php

// Script to extract features for resume based on the job requirements posted by recruiter
// Ajit Puthenputhussery

// Connection files
include('connect.php');

$text = 'jay h. ravaliya 27 hinchman avenue unit 2-c ¤? wayne, nj 07470 ¤? (973) 896-7552 ¤? jayrav13@gmail.com ¤? jayravaliya.com education new jersey institute of technology, college of computing sciences m.s., computer science, december 2016 (expected). gpa: 3.500. rutgers, the state university of new jersey, school of engineering b.s., biomedical engineering, january 2014. certificates introduction to computer science, harvardx via edx. july 2015. technical skills projects find my health, university of pennsylvania?s pennapps hackathon. september 2015 ? proficient: python, swift, sql, php, vba. familiar: c, java, objective-c, javascript, ruby, matlab. flask, cocoa touch, cocoapods, silex, bootstrap, jquery, laravel. sublime, xcode, vim, git, windows, os x, linux, unix, ms excel. sap business objects, tableau, oracle apex, sap r/3. languages: frameworks/libraries: software: enterprise software: research ?find my health? is an ios swift app that uses historical data on wait times at emergency rooms across the nation to help users with non-life-threating emergencies determine which hospital in their area will best help them see a doctor as fast as possible. led the backend development of the application, including page scraping for er wait times, constructing a restful api atop python?s flask microframework, and integrating google api?s to generate results. constructed ios views relevant to the backend application. ? ? our hack won venture for america?s ?best social innovation hack ? building something that matters? award! midloc, apple app store, google play. available on github. june 2015 ? ? ? user base grew to 100 users, invited an android developer to build the app for google play, anticipating future versions! built my first ios swift app that uses google?s places api to help users find places to meet their friends half way between two zip codes. iterated through code base 3 times, implementing improved approaches such as: parse sdk, ios mvc, cocoapods, restful api. industry experience april 2014 ? may 2015 supply chain analyst, pepsico ? pepsi beverages company championed a new role responsible for building data analytics tools that could support raw material procurement for north america. ? ? developed a series of automated, user-friendly excel vba applications that helped me execute my job function in 6 hours per week. applications continue to be used by sr. leadership (coo/vp-level), middle management, strategy teams and front-line employees. led the development of our term?s first algorithm-driven tools, which helped us identify $300,000+ cost savings for our team. served as a liaison between it and the business, assumed associate manager-level responsibilities within 6 months of joining. ? ? contract manufacturing planner, l?oréal usa ? piscataway manufacturing july 2013 ? april 2014 ? hired as an associate of the management development program, responsible for managing 3 contract manufacturers. ? ? led the production of 1 million units of l?oreal products per month across 3 global contract manufacturers. strengthened relationships with and developed process improvement strategies with both business partners and internal support teams. led software development in c++ and matlab for the laboratory of vision research and sensory-motor integration laboratory. undergraduate research associate, rutgers university center for cognitive science june 2010 ? july 2013 ? ? developed visual illusions using matlab?s psychtoolbox, such as the reverse phi or multiple attributes illusions. ? architected a mechanical apparatus, controlled with an arduino microprocessor, used to record motions from a human participant. ? advocated for undergraduate research by representing our lab at multiple conferences, recruiting students to join our lab and more! publications jillian nguyen, ushma madmujar, jay h. ravaliya, thomas v. papathomas, elizabeth b. torres. a novel, objective, statistical framework to characterize contributions of the sensory-motor system during perceptual state changes under a physical depth inversion illusion. psychological science. 2015. jillian nguyen, thomas v. papathomas, jay h. ravaliya, elizabeth b. torres. methods to explore the influence of top-down visual processes on motor behavior. journal for visualized experiments. 2013. leadership president, engineering governing council (egc) may 2010 ? may 2013 ? i was elected to serve as the student body president of the school of engineering, during which time i was responsible for leading 10 executive board members and 80 general members. collectively, we represented the 3,500 engineering students at the university-level. honors cap & skull senior honor society, rutgers university. initiated may 2012. tapped for membership as one of eighteen members during junior year. more information: capandskull.com.';

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

echo '<br>-------------------- Candidate 1 -- Jay Ravaliya -----------------------------<br>';
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