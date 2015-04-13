<?php  


// error_reporting(E_ALL);
// ini_set('display_errors', 1);


$url = 'http://workspace/api/users/7';
$method = 'GET';


// $url = 'http://workspace/api/users';
// $method = 'POST';
// $method = 'PUT';
$method = 'DELETE';

$data['apiKey'] = '100';

// $data['user'] = 'crude';
// $data['pass'] = 'crone';
// $data['email'] = 'crude@one.com';

print_r( CallAPI($method, $url, $data) );

// echo 1;


function CallAPI($method, $url, $data = false) {
	$curl = curl_init();

	switch ($method)
	{
		case "POST":
		curl_setopt($curl, CURLOPT_POST, 1);

		if ($data)
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		break;
		case "PUT":
		// curl_setopt($curl, CURLOPT_PUT, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		break;
		case "DELETE":
		// curl_setopt($curl, CURLOPT_PUT, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
		if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		break;
		default:
		if ($data)
			$url = sprintf("%s?%s", $url, http_build_query($data));
	}

    // Optional Authentication:
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_USERPWD, "username:password");

	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);




	$result = curl_exec($curl);

	curl_close($curl);

	return $result;
}

?>