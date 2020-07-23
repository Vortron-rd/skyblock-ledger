<?php



		$curl = curl_init();
	curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.hypixel.net/skyblock/profile?key=yourKey&profile=${profile_id}",
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
	
$array = ($response['profile']['members']);


#echo '<pre>';
#print_r (array_values($array));
#echo '</pre>';
#$array = array_values($array);


$array_keys = array_keys($array);

if (!empty($array_keys[0])) {
	$p1r = $array_keys[0];
	$json = file_get_contents('https://api.mojang.com/user/profiles/' . $p1r . '/names');
	$data = json_decode($json, true);
	$get_last = array_key_last($data);
	$p1 = $data[$get_last]['name'];
} else {
	$p1 = "";
}
if (!empty($array_keys[1])) {
	$p2r = $array_keys[1];
	$json = file_get_contents('https://api.mojang.com/user/profiles/' . $p2r . '/names');
	$data = json_decode($json, true);
	$get_last = array_key_last($data);
	$p2 = $data[$get_last]['name'];
} else {
	$p2 = "";
}
if (!empty($array_keys[2])) {
	$p3r = $array_keys[2];
	$json = file_get_contents('https://api.mojang.com/user/profiles/' . $p3r . '/names');
	$data = json_decode($json, true);
	$get_last = array_key_last($data);
	$p3 = $data[$get_last]['name'];
} else {
	$p3 = "";
}
if (!empty($array_keys[3])) {
	$p4r = $array_keys[3];
	$json = file_get_contents('https://api.mojang.com/user/profiles/' . $p4r . '/names');
	$data = json_decode($json, true);
	$get_last = array_key_last($data);
	$p4 = $data[$get_last]['name'];
} else {
	$p4 = "";
}
if (!empty($array_keys[4])) {
	$p5r = $array_keys[4];
	$json = file_get_contents('https://api.mojang.com/user/profiles/' . $p5r . '/names');
	$data = json_decode($json, true);
	$get_last = array_key_last($data);
	$p5 = $data[$get_last]['name'];

} else {
	$p5 = "";
}







if (!empty($array[0])) {
	$profile0 = $array[0];

	print_r ("<a href=index.php?profile_id=$profile0>" .$profile0);
	echo "<br>";
}			

if (!empty($array[1])) {
	$profile1 = $array[1];

	echo ("<a href=index.php?profile_id=$profile1>" .$profile1);
	echo "<br>";
}

if (!empty($array[2])) {
	$profile2 = $array[2];

	echo ("<a href=index.php?profile_id=$profile2>" .$profile2);
	echo "<br>";
}

if (!empty($array[3])) {
	$profile3 = $array[3];

	echo ("<a href=index.php?profile_id=$profile3>" .$profile3);
	echo "<br>";
}









	


	




