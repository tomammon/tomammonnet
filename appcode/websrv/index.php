<!DOCTYPE html>
<html>
<head>
<title>Tom Ammon | Resume</title>

<meta name="viewport" content="width=device-width"/>
<meta name="description" content="Tom Ammon | Resume"/>
<meta charset="UTF-8">

<?php

function GetJsonDataFromAppTier($endpoint){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	 CURLOPT_URL => "http://192.168.0.100/api/v1/tanapi.php/$endpoint",
	 CURLOPT_RETURNTRANSFER => true,  // curl options
	 CURLOPT_ENCODING => "",  // more options
	 CURLOPT_HTTPHEADER => array(
	  "X-DisaggBlog-API-Key: MySecretKey",
	  "content-type: application/json"
	   ),
	   ));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	        // if something goes wrong, print out some diagnostic info but don't try to decode any data
	        echo "THERE WAS AN ERROR\n";
	        echo "cURL Error #:" . $err;
	} else {
	        // if no errors, decode the received JSON data into a
	        // multidimensional array, then print the array
	        $json_dbresults = json_decode($response, true);
			return $json_dbresults;
	}
}

$personalinfo = GetJsonDataFromAppTier('querypinfo');

$profileinfo = GetJsonDataFromAppTier('querypprofile');

?>
<link type="text/css" rel="stylesheet" href="<?php echo $personalinfo[6]; ?>">
<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body id="top">
	<div id="cv" class="instaFade">
		<div class="mainDetails">
			<div id="headshot" class="quickFade">
				<!--photo url--><img src="<?php echo $personalinfo[5]; ?>" alt="<?php echo $personalinfo[0]; ?>" />
			</div>

			<div id="name">
				<!--name--><h1 class="quickFade delayTwo"><?php echo $personalinfo[0]; ?></h1>
				<!--current title--><h2 class="quickFade delayThree"><?php echo $personalinfo[1]; ?></h2>
			</div>

			<div id="contactDetails" class="quickFade delayFour">
				<ul>
					<li><!--email addr--><a href="mailto:<?php echo $personalinfo[2]; ?>" target="_blank"><?php echo $personalinfo[2]; ?></a></li>
					<li><!--website url--><a href="http://<?php echo $personalinfo[4]; ?>"><?php echo $personalinfo[4]; ?></a></li>
					<li><!--phone-->m: <?php echo $personalinfo[3]; ?></li>
				</ul>
			</div>
			<div class="clear">
			</div>
		</div>
		<div id="mainArea" class="quickFade delayFive">
			<section>
				<article>
					<div class="sectionTitle">
						<!--Personal Profile Heading--><h1><?php echo $profileinfo[0]; ?></h1>
					</div>

					<div class="sectionContent">
						<!--profile content--><p><?php echo $profileinfo[1]; ?></p>
					</div>
				</article>

				<div class="clear">
				</div>
			</section>






</body>
</html>
