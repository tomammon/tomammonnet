<?php
//MySQL database credentials
//username and password will be loaded into $dbUsername and $dbPassword
require("/var/phplib/dbcreds.php");

// specify the API key
$APIKEY = "MySecretKey";
// find out which http verb was used in the request
$method = $_SERVER['REQUEST_METHOD'];
// get the URL used in the request
// this will be important later on because we will use the URL path to determine
// which API call the user is trying to use.
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
// fetch the headers from the http request and store them in the $headers array
$headers = apache_request_headers();

//set up some canned error messages so that they can be returned as valid json
$methoderr = array("MethodError" => "Method not supported");
$notfound = array("NotFound" => "API Call not supported");
$dbconnecterr = array("DBConnectError" => "App server cannot connect to mysql server");

//database connection
$conn = mysqli_connect('192.168.0.200',$dbUsername,$dbPassword,'tomammonnet');

//add an authentication failed message
$autherr = array("AuthenticationError" => "Authentication failed");

if (in_array($APIKEY, $headers)){ //if the API key is in the http header, continue trying to service the API call
	if ($method == "GET"){ // if the method was GET, its okay to send data back to the requestor
		switch ($request[0]){
			case "testapi": //if the first part of the URL was "testapi"
				//then create an array with some static text in it and send it back to the
				//requestor as JSON
				$statictext = array("Testing" => "Your call to testapi was successful - the app server API endpoint is functional");
				echo json_encode($statictext);
				break;

			case "testdb":
				$testquery = "SELECT * FROM diagnostic";
				$testquery_data = mysqli_query($conn, $testquery);
				$row = mysqli_fetch_row($testquery_data);
				if ($row[1] == "Column A" && $row[2] == "Column B"){
					$statictext = array("DBConnectSuccess" => "Your call to testdb was successful - The app server database connection is functional");
					echo json_encode($statictext);
				} else {
					echo json_encode($dbconnecterr);
				}
				break;

			case "querypinfo":
				$pinfoquery = "SELECT name,position,email,phone,website,photourl,cssurl FROM personalinfo";
				$pinfo_data = mysqli_query($conn, $pinfoquery);
				$row = mysqli_fetch_row($pinfo_data);
				echo json_encode($row);
				break;

			default: //if the first part of the URL was not found in this switch statement
			     //then send back our canned error message
				echo json_encode($notfound);
				}
			} else { // if the method was anything other than GET, send back a JSON block containing our canned error message
				echo json_encode($methoderr);
			}
	} else { // if the API key was not found, return an error
	        echo json_encode($autherr);
	}




?>
