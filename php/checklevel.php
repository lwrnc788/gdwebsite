<?php
	$levelid = (int)(htmlspecialchars($_POST["poll_levelid"]));
	
	echo "ID: " . $levelid . "<br/>";
	
	//---
	
	# Client URL
	
	$curl_GD = curl_init();
	
	//set fetch url to be the gdbrowser url using the received level ID
	curl_setopt($curl_GD, CURLOPT_URL, "https://gdbrowser.com/api/level/" . $levelid);
	//get response as the string itself, instead of TRUE or FALSE from if a response is successfully received
	curl_setopt($curl_GD, CURLOPT_RETURNTRANSFER, true);
	
	$response_GD = curl_exec($curl_GD);
	curl_close($curl_GD);
	
	//---
	
	if ($response_GD === -1) {
		echo "Invalid Level ID.";
		
		//todo: add a message for an invalid level ID, which can only be caused by tampering with client-side code
	} else {
		//convert JSON string to PHP variable (array/object?);
		$leveldata_GD = json_decode($response_GD);
		
		//(temp) this is to demonstrate accessing object keys in PHP
		echo $leveldata_GD->name . " by " . $leveldata_GD->author . "<br/>";
		
		//---
		
		if ($leveldata_GD->featured) {
			echo "Level is featured.<br/>";
			
			$url_DB = "https://gdwebsite-1628b.firebaseio.com/" . $levelid . ".json";
			
			//--- Get current level vote data from database
			
			$curl_DB = curl_init();
			
			curl_setopt($curl_DB, CURLOPT_URL, $url_DB);
			curl_setopt($curl_DB, CURLOPT_RETURNTRANSFER, true);
			
			$response_DB = curl_exec($curl_DB);
			
			//--- Add 1 vote
			
			$current_leveldata_DB = json_decode($response_DB);
			
			if (($current_leveldata_DB != null) && (array_key_exists("vote", $current_leveldata_DB))) {
				$current_votes = (int)($current_leveldata_DB->vote);
				
				echo "Votes: " . $current_votes . "<br/>";
			} else {
				$current_votes = 0;
				
				echo "Level has not been voted previously.<br />";;
			}
			
			$new_leveldata_DB = array(
				"vote" => ($current_votes + 1)
			);
			
			//--- Send new level vote data to database
			
			// request to "PUT" JSON data into database
			curl_setopt($curl_DB, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($curl_DB, CURLOPT_POSTFIELDS, json_encode($new_leveldata_DB));

			curl_setopt($curl_DB, CURLOPT_HTTPHEADER, array(
				"Content-Type: application/json",
				// might be necessary for authentication in the future
				//"Authorization: key=" . "AIzaSyC4frRn2JKi3RJr62_oyW8ZcL4pG-Hw3Bw"
			));
			
			$response2_DB = curl_exec($curl_DB);			
			curl_close($curl_DB);
		} else {
			echo "Level is not featured.<br/>";
			
			//todo: add a message for a failed vote, which is always due to tampering with code
			
			/*
				an entry other than a featured level ID can only be submitted if
				the client-side level ID validation fails to work
			*/
		}
	}
?>