	<link rel="stylesheet" type="text/css" href="styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
<div class=search>
<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['name'] == "") {
		#header('Location: index.php');
	} else {
		$name = $_POST['name'];


		$curl = curl_init();
	curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.hypixel.net/player?key=your_key&name=$name",
    CURLOPT_RETURNTRANSFER => true,
 	CURLOPT_TIMEOUT => 30,
 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
  	CURLOPT_HTTPHEADER => array(
  	  "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
$response = json_decode($response, true);
curl_close($curl);

if ($response['player'] == "null") {
	echo "The player with the name '$name' was not found. <br>";
	echo "<a class=s href=index.php> << Go back to home</a>";
}	else {
?>	<h1 class="s">Choose a profile</h1><?php
$array = ($response['player']['stats']['SkyBlock']['profiles']);



$array = array_values($array);


if (!empty($array[0])) {
	$profile0 = $array[0]['profile_id'];
	$profile0_name = $array[0]['cute_name'];
	echo ("<a href=index.php?profile_id=$profile0 class=a>" .$profile0_name);
	echo "<br>";
}			

if (!empty($array[1])) {
	$profile1 = $array[1]['profile_id'];
	$profile1_name = $array[1]['cute_name'];
	echo ("<a href=index.php?profile_id=$profile1 class=a>" .$profile1_name);
	echo "<br>";
}

if (!empty($array[2])) {
	$profile2 = $array[2]['profile_id'];
	$profile2_name = $array[2]['cute_name'];
	echo ("<a href=index.php?profile_id=$profile2 class=a>" .$profile2_name);
	echo "<br>";
}

if (!empty($array[3])) {
	$profile3 = $array[3]['profile_id'];
	$profile3_name = $array[3]['cute_name'];
	echo ("<a href=index.php?profile_id=$profile3 class=a>" .$profile3_name);
	echo "<br>";
}
?></div><?php
include 'bar.php';







	


	}




}
}
?>
