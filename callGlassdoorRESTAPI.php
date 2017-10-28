<?php

/* * *****************************************************************************
 * File Name: callGlassdoorRESTAPI.php
 * Project: company lookup
 * Author: Matt Nutsch
 * Date Created: 10-27-2017
 * Description: This code starts with an array containing company names.
 * It then looks up each company in the Glassdoor API and outputs the results to an HTML table.
 * Notes: 
 * Get the Glassdoor API user and key from this URL: https://www.glassdoor.com/developer/register_input.htm
 * Update $apiUser and $apiKey with the values provided by Glassdoor.
 * **************************************************************************** */

//array of company names
$arrayOfCompanies[0] = "Capital One";
$arrayOfCompanies[1] = "Bank of America";
$arrayOfCompanies[2] = "Verizon";
$arrayOfCompanies[3] = "Walmart eCommerce";
$arrayOfCompanies[4] = "Vista Proppants";

$numberOfCompanies = 5;
 
//echo the start of the output table
echo '<table border="1">';
echo "<tr><th>Name</th><th>Website</th><th>Industry</th><th>Overall Rating</th><th>Rating Desc</th><th>Culture and Val. Rating</th><th>Leadership Rating</th><th>Comp and Benefits Rating</th><th>Career Opps Rating</th><th>Work Life Bal Rating</th><th>Recommend Rating</th></tr>";
 
//loop through the array and query for each
for($i = 0; $i < $numberOfCompanies; $i++)
{
	$apiUser ="12345";
	$apiKey = "abcde";
	$apiCity = "Dallas";
	$apiUserIP = "192.168.1.1";
	
	$url = "http://api.glassdoor.com/api/api.htm?v=1&format=json&t.p=" . $apiUser . "&t.k=" . $apiKey . "=employers&q=" . urlencode($arrayOfCompanies[$i]) . "&l=" . $apiCity . "&userip=" . $apiUserIP . "&useragent=Mozilla/%2F4.0";

	//echo $url . "<br/>";
	//echo $arrayOfCompanies[$i] . "<br/>";
	
	//pause briefly, so that we do not get banned from the API
	sleep(0.5);
	
	$result = file_get_contents($url);

	//echo "RAW API OUTPUT:<br/>";
	//echo $result;
	//echo "<br/><br/>";

	//decode the JSON into an object
	$jsonResult = json_decode($result);
	
	$name = $jsonResult->response->employers[0]->name;
	$website = $jsonResult->response->employers[0]->website;
	$industry = $jsonResult->response->employers[0]->industry;
	$overallRating = $jsonResult->response->employers[0]->overallRating;
	$ratingDescription = $jsonResult->response->employers[0]->ratingDescription;
	$cAndVRating = $jsonResult->response->employers[0]->cultureAndValuesRating;
	$seniorLeadershipRating = $jsonResult->response->employers[0]->seniorLeadershipRating;
	$compAndBenefitsRating = $jsonResult->response->employers[0]->compensationAndBenefitsRating;
	$careerOpportunitiesRating = $jsonResult->response->employers[0]->careerOpportunitiesRating;
	$workLifeBalanceRating = $jsonResult->response->employers[0]->workLifeBalanceRating;
	$recommendToFriendRating = $jsonResult->response->employers[0]->recommendToFriendRating;

	//echo a table row
	echo "<tr><td>$name</td><td>$website</td><td>$industry</td><td>$overallRating</td><td>$ratingDescription</td><td>$cAndVRating</td><td>$seniorLeadershipRating</td><td>$compAndBenefitsRating</td><td>$careerOpportunitiesRating</td><td>$workLifeBalanceRating</td><td>$recommendToFriendRating</td></tr>";

}

//echo the end of the table
echo "</table>";


//====================================================================== END PHP
?>