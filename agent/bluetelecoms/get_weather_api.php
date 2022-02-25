<?php

	$city = $_GET["city"];
	$lat = $_GET["lat"];
	$long = $_GET["long"];


 	#Defining the basic cURL function
    function curl($url) {
        $ch = curl_init();  // Initialising cURL
        #Setting cURL's URL option with the $url variable passed into the function
        curl_setopt($ch, CURLOPT_URL, $url);
        #Setting cURL's option to return the webpage data   
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        #Executing the cURL request and assigning the returned data to the $data variable
        $data = curl_exec($ch); 
        #Closing cURL 
        curl_close($ch); 
        #Returning the data from the function  
        return $data;
    }

    if($city){
    	$scraped_website = curl("http://api.openweathermap.org/data/2.5/weather?q=".$city."&APPID=3c8fb1fc2b345b9b93ac2dd01541cfc2&units=metric");
    } else {
    	$scraped_website = curl("http://api.openweathermap.org/data/2.5/weather?lat=".$lat."&lon=".$long."&APPID=3c8fb1fc2b345b9b93ac2dd01541cfc2&units=metric");
    }


    echo ($scraped_website);
?>