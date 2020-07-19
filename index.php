<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
	<title>History Viewer</title>
</head>
<body>
  <div class="search">
	<!--<a href="flipping.php">FLIPS</a>-->


<h1 class="s">Search for a player to begin!</h1>
<p>NOTE: The profile must have the <strong>Banking API</strong> enabled!</p>
<form method="POST" action="get_player.php">
		<input type="text" name="name" class="input">
<input type="submit" name="search" value="GO >" class="submit">
	</form><br>

</div>
<?php
if (!empty($_GET['profile_id'])) {
  $profile_id = $_GET['profile_id'];


      




//get request for player
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.hypixel.net/skyblock/profile?key=3e11b120-a63e-4162-9cb9-765439694f47&profile=${profile_id}",
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

curl_close($curl);


$response = json_decode($response, true);

if (empty($response['profile']['banking'])) {
  print "<p class=error>This player's profile does not have their banking API enabled!</p>";

} else {

include 'get_coop.php';
$balance = $response['profile']['banking']['balance'];
$print = (number_format($balance, 2, '.', ','));

?>


<span class="bar">
<h1 class="h">Viewing banking history until: 
          <?php          
          if (isset($_GET['i'])) {
            $i = $_GET['i'];
          } else {
            $i = 0;
          }

          $timestamp = $response['profile']['banking']['transactions'][$i]['timestamp'];
          $rtime = $timestamp / 1000;
          $time = date("F j, g:i a, Y", $rtime);
          echo $time;
          echo " | Current balance: ";
          echo $print;?>  </h1></span><div class="bg">


<?php
#print $print;

/**
foreach($response['profile']['banking']['transactions'] as $response) {
    echo $response, '<br>';
}
**/
$array = $response['profile']['banking']['transactions'];
?>

<a href="#overview" class=ov><strong>< Go to the overview > </strong></a><br><p>To start the calculations/history from a transactions simply click on the transaction.</p>
<br>
<?php

if (isset($_GET['i'])) {
   $i=$_GET['i'];
} else {
	$i = 0;
}
   $p1_total = 0;
   $p2_total = 0;
   $p3_total = 0;
   $p4_total = 0;
   $p5_total = 0;
   $bankI_total = 0;
   $cl = "</a>";
   $total = 0;
   


   foreach($array as $y){
          	if (!empty($response['profile']['banking']['transactions'][$i])) {
          $ramount = $response['profile']['banking']['transactions'][$i]['amount'];
          $amount = number_format($ramount);
          $ruser = $response['profile']['banking']['transactions'][$i]['initiator_name'];
          $user = preg_replace(array('/\W/','/^[a-z]/'), "", $ruser);
          $action = $response['profile']['banking']['transactions'][$i]['action'];
          $timestamp = $response['profile']['banking']['transactions'][$i]['timestamp'];
          $rtime = $timestamp / 1000;
          $time = date("F j, g:i a, Y", $rtime);	
     	  $add = " added by ";
     	  $remove = " removed by ";
     	  $blank = " ";
        $url = "";
        $url .= "?profile_id=$profile_id"; 
        $url .= "&i=$i";

		  $ola = "<a href=$url class=add>";
      $olr = "<a href=$url class=remove>";

		  //construct add message
		  $add_message = "";
		  $add_message .= $ola;
		  $add_message .= $amount;
		  $add_message .= $add;
		  $add_message .= $user;
		  $add_message .= $blank;
		  $add_message .= $time;
		  $add_message .= $cl;

		  //construct remove message 

		  $remove_message = "";
		  $remove_message .= $olr;
		  $remove_message .= $amount;
		  $remove_message .= $remove;
		  $remove_message .= $user;
		  $remove_message .= $blank;
		  $remove_message .= $time;
		  $remove_message .= $cl;
          if ($user == $p1) {
          
          	if ($action == "DEPOSIT") {
          		echo $add_message;
          		$p1_total = $p1_total + $ramount;
          		$total = $total + $ramount;
          	} else {
				echo $remove_message;
          		$p1_total = $p1_total - $ramount;
          		$total = $total - $ramount;
          	}

          } elseif ($user == $p2) {
          	if ($action == "DEPOSIT") {
          		echo $add_message;
          		$p2_total = $p2_total + $ramount;
          		$total = $total + $ramount;
          	} else {
				echo $remove_message;
          		$p2_total = $p2_total - $ramount;
          		$total = $total - $ramount;
          	}
          } elseif ($user == $p3) {
          	if ($action == "DEPOSIT") {
          		echo $add_message;
          		$p3_total = $p3_total + $ramount;
          		$total = $total + $ramount;
          	} else {
          		echo $remove_message;
          		$p3_total = $p3_total - $ramount;
          		$total = $total - $ramount;
          	}
          } elseif ($user == $p4) {
            if ($action == "DEPOSIT") {
              echo $add_message;
              $p4_total = $p4_total + $ramount;
              $total = $total + $ramount;
            } else {
              echo $remove_message;
              $p4_total = $p4_total - $ramount;
              $total = $total - $ramount;
            }
          } elseif ($user == $p5) {
            if ($action == "DEPOSIT") {
              echo $add_message;
              $p5_total = $p5_total + $ramount;
              $total = $total + $ramount;
            } else {
              echo $remove_message;
              $p5_total = $p5_total - $ramount;
              $total = $total - $ramount;
            }
          } elseif ($user == "BankInterest") {
          		echo $add_message;
          	$bankI_total = $bankI_total + $ramount;
          	$total = $total + $ramount;
                      } 
          	echo "<br>";
                 $i++;     
          }
	}


echo "<h1 id=overview>Overview</h1>";
$i_r = $i - 1;
$reset = "";
$reset .= "?profile_id=$profile_id";
$reset .= "&i=$i_r";
echo ("<a href=$reset>Start History</a>");
echo "<br>";
if (!empty($p1)) {
echo ("Money to $p1: ". number_format($p1_total, 2, '.', ','));
echo "<br>";
}
if (!empty($p2)) {
echo ("Money to $p2: ". number_format($p2_total, 2, '.', ','));
echo "<br>";
}

if (!empty($p3)) {
echo ("Money to $p3: ". number_format($p3_total, 2, '.', ','));
echo "<br>";
}

if (!empty($p4)) {
echo ("Money to $p4: ". number_format($p4_total, 2, '.', ','));
echo "<br>";
}

if (!empty($p5)) {
echo ("Money to $p5: ". number_format($p5_total, 2, '.', ','));
echo "<br>";
}

echo ('Money from Bank Intereset: '. number_format($bankI_total, 2, '.', ','));
echo "<br>";
echo ('Total: '. number_format($total, 2, '.', ','));
echo '<br>';

#echo print_r($array[4]['amount']);
#echo '<pre>'; print_r($array); echo '</pre>';
#echo '<pre>'; print_r(array_reverse($response['profile']['banking']['transactions'][1]['amount'])); echo '</pre>';
}
} else {
  echo "<br>";
}

?>
</div>
<?php include 'bar.php';?>

</body>
</html>