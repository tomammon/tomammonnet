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
	 CURLOPT_URL => "http://192.168.0.100/api/v2/tanapi.php/$endpoint",
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

function SimpleList($list){
	foreach ($list as $listitem){
		$item .= $listitem.", ";
	}
	return rtrim($item, ", ");
}

function UList($list){
	foreach ($list as $listitem){
		$ulist .= "<li>$listitem</li>\n";
	}
	return $ulist;
}

function LinkList($linkattrs){
	foreach ($linkattrs as $url => $linktext){
		//future code to loop through returned JSON as an associative array and print a list of links
		$linklist .= "<li><a href=\"$url\">$linktext</a></li>\n";
	}
	return $linklist;
}

$personalinfo = GetJsonDataFromAppTier('querypinfo');

$profileinfo = GetJsonDataFromAppTier('querypprofile');

?>
<link type="text/css" rel="stylesheet" href="<?php echo $personalinfo[6]; ?>">
<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300' rel='stylesheet' type='text/css'>
<style>
a {
text-decoration: none;
color: #8b1ca0;
}
</style>
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
			<section>
			<div class="sectionTitle">
				<h1>Experience</h1>
				<h2>Oracle</h2>
				<br/>
				<h2>Principal Network Development Engineer, Oracle Cloud Infrastructure</h2><h2>
						<p class="subDetails">September 2020 - Present</p>
				</h2>	

			</div>

			<div class="sectionContent">
				<article>
					<h2>Technologies</h2>
					
					<p><?php echo SimpleList(GetJsonDataFromAppTier('querykeywords/orcl')); ?></p>
				</article>

				<article>
					<h2>Systems Engineering</h2>
					<p>
						<ul>
							<?php echo UList(GetJsonDataFromAppTier('querybpoints/orcl/systems_engineering')); ?>
						</ul>
					</p>
				</article>

				<article>
					<h2>Communication and Leadership</h2>
					<p>
						<ul>
							<?php echo UList(GetJsonDataFromAppTier('querybpoints/orcl/communication_leadership')); ?>
						</ul>
					</p>
				</article>
			</div>
			<div class="clear"></div>
			</section>
			<section>
			<div class="sectionTitle">
				<h2>Whole Foods Market</h2>
				<br/>
				<h2>Principal Network Development Engineer</h2><h2>
						<p class="subDetails">February 2020 - September 2020</p>
					<br>
					<h2>Senior Network Development Engineer</h2>
						<p class="subDetails">June 2019 - February 2020</p>
				</h2>	

			</div>

			<div class="sectionContent">
				<article>
					<h2>Technologies</h2>
					
					<p><?php echo SimpleList(GetJsonDataFromAppTier('querykeywords/wfm')); ?></p>
				</article>

				<article>
					<h2>Network Engineering</h2>
					<p>
						<ul>
							<?php echo UList(GetJsonDataFromAppTier('querybpoints/wfm/netdev_engineering')); ?>
						</ul>
					</p>
				</article>

				<article>
					<h2>Communication and Leadership</h2>
					<p>
						<ul>
							<?php echo UList(GetJsonDataFromAppTier('querybpoints/wfm/technical_leadership')); ?>
						</ul>
					</p>
				</article>
			</div>
			<div class="clear"></div>
			</section>
			<section>
			<div class="sectionTitle">
				<h2>Hotwire Communications</h2>
				<br/>
				<h2>Senior Network Architect<h2>
					<p class="subDetails">July 2018 - May 2019</p>

			</div>

			<div class="sectionContent">
				<article>
					<h2>Technologies</h2>
					
					<p><?php echo SimpleList(GetJsonDataFromAppTier('querykeywords/hwc')); ?></p>
				</article>

				<article>
					<h2>Architecture</h2>
					<p>
						<ul>
							<?php echo UList(GetJsonDataFromAppTier('querybpoints/hwc/architecture')); ?>
						</ul>
					</p>
				</article>

				<article>
					<h2>Network Engineering</h2>
					<p>
						<ul>
							<?php echo UList(GetJsonDataFromAppTier('querybpoints/hwc/network_engineering')); ?>
						</ul>
					</p>
				</article>

				<article>
					<h2>Communication and Leadership</h2>
					<p>
						<ul>
							<?php echo UList(GetJsonDataFromAppTier('querybpoints/hwc/communication_leadership')); ?>
						</ul>
					</p>
				</article>
			</div>
			<div class="clear"></div>
			</section>
			<section>
			<div class="sectionTitle">
				<h2>Adobe Systems</h2>
				<br/>
				<h2>Senior Network Engineer<h2>
					<p class="subDetails">April 2017 - June 2018</p>

			</div>

			<div class="sectionContent">
				<article>
					<h2>Technologies</h2>
					
					<p><?php echo SimpleList(GetJsonDataFromAppTier('querykeywords/adbe')); ?></p>
				</article>

				<article>
					<h2>Network Engineering</h2>
					<p>
						<ul>
							<?php echo UList(GetJsonDataFromAppTier('querybpoints/adbe/network_engineering')); ?>
						</ul>
					</p>
				</article>

				<article>
					<h2>Communication and Leadership</h2>
					<p>
						<ul>
							<?php echo UList(GetJsonDataFromAppTier('querybpoints/adbe/communication_leadership')); ?>
						</ul>
					</p>
				</article>
			</div>
			<div class="clear"></div>
		</section>
		<section>
			<div class="sectionTitle">
				<h2>The Church of Jesus Christ of Latter-Day Saints</h2>
				<br/>
				<br/>
				<h2>Senior Network Engineer<h2>
					<p class="subDetails">October 2015 - March 2017</p>
				<br/>
				<h2>Network Engineer<h2>
					<p class="subDetails">May 2012 - October 2015</p>
			</div>

			<div class="sectionContent">
				<article>
					<h2>Technologies</h2>
					
					<p><?php echo SimpleList(GetJsonDataFromAppTier('querykeywords/lds')); ?></p>
				</article>

				<article>
					<h2>Network Engineering</h2>
					<p>
						<ul>
							<?php echo UList(GetJsonDataFromAppTier('querybpoints/lds/network_engineering')); ?>
						</ul>
					</p>
				</article>

				<article>
					<h2>Communication and Leadership</h2>
					<p>
						<ul>
							<?php echo UList(GetJsonDataFromAppTier('querybpoints/lds/communication_leadership')); ?>
						</ul>
					</p>
				</article>
			</div>
			<div class="clear"></div>
		</section>
		<section>
			<div class="sectionTitle">
				<h2>University of Utah Center for High Performance Computing</h2>
				<br/>
				<br/>
				<h2>Network Operations Team Lead<h2>
					<p class="subDetails">Nov 2010 - May 2012</p>
				<br/>
				<h2>Network Engineer<h2>
					<p class="subDetails">July 2006 - Nov 2010</p>
			</div>

			<div class="sectionContent">
				<article>
					<h2>Technologies</h2>
					
					<p><?php echo SimpleList(GetJsonDataFromAppTier('querykeywords/chpc')); ?></p>
				</article>

				<article>
					<h2>Network Engineering and Operations</h2>
					<p>
						<ul>
							<?php echo UList(GetJsonDataFromAppTier('querybpoints/chpc/neteng_ops')); ?>
						</ul>
					</p>
				</article>

				<article>
					<h2>Project Management</h2>
					<p>
						<ul>
							<?php echo UList(GetJsonDataFromAppTier('querybpoints/chpc/project_management')); ?>
						</ul>
					</p>
				</article>

				<article>
					<h2>Communication and Presentation</h2>
					<p>
						<ul>
							<?php echo UList(GetJsonDataFromAppTier('querybpoints/chpc/communication_presentation')); ?>
						</ul>
					</p>
				</article>



			</div>
			<div class="clear"></div>
		</section>
		<section>
			<div class="sectionTitle">
				<h1>Education</h1>
			</div>

			<div class="sectionContent">
				<article>
					<h2>Weber State University</h2>
					<p class="subDetails">B.S., Telecommunications Administration</p>
				</article>

			</div>
			<div class="clear"></div>
		</section>

        <section>
            <div class="sectionTitle">
                <h1>Certifications</h1>
            </div>

            <div class="sectionContent">
                <article>
                    <h4>CCIE #57102, Routing &amp; Switching</h4>
					<!--<p class="subDetails">CCIE #57102, Routing &amp; Switching</p>-->
                </article>

            </div>
        	<div class="clear"></div>
        </section>
		<section>
			<div class="sectionTitle">
				<h1>Portfolio</h1>
			</div>

			<div class="sectionContent">
				<article>
					<h2>Other Samples of My Work</h2>
					<p>
					</p><ul><!--<?php //echo LinkList(GetJsonDataFromAppTier('queryportfolio')); ?>-->
					<li><a href="http://packetpushers.net/author/tom-ammon/">Blog at PacketPushers.net</a></li>
<li><a href="https://github.com/tomammon">tomammon @ Github</a></li>
<li><a href="https://hub.docker.com/r/tomammon/">tomammon @ Dockerhub</a></li>
<li><a href="http://packetpushers.net/podcast/podcasts/show-389-using-mpls-in-the-enterprise/">"Using MPLS In The Enterprise" - PacketPushers Show 389</a></li>
<li><a href="https://thenetworkcollective.com/2019/01/ep43-peering-with-providers/">"Peering with Providers" - Network Collective Episode 43</a></li>
<li><a href="https://thenetworkcollective.com/2019/04/ep48-bgp-peering-real-world/">"BGP Peering in the Real World" - Network Collective Episode 48</a></li>
<li><a href="https://rule11.tech/the-hedge-episode-3-derick-winkworth-and-automation/">"Derick Winkworth and Automation" - The Hedge Episode 3</a></li>
<li><a href="https://rule11.tech/the-hedge-episode-5-geoff-huston/">"Geoff Huston on DOH" - The Hedge Episode 5</a></li>
<li><a href="https://rule11.tech/the-hedge-podcast-episode-24-single-source-of-truth/">"Single Source of Truth" - The Hedge Episode 24</a></li>
<li><a href="https://rule11.tech/the-hedge-podcast-30-ethan-banks-and-network-fundamentals/">"Ethan Banks and Network Fundamentals" - The Hedge Episode 30</a></li>
						</ul>
					<p></p>
				</article>

			</div>
			<div class="clear"></div>
		</section>
	</div>
</div>

</body>
</html>
