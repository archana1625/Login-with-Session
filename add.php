<?php 
$db_name = 'daccess';
$db_user = 'root';
$db_pass = '';
$db_host = 'localhost'; 

$response = array();
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array

$username = $input['uname1'];
$password = $input['pass1'];

$conn = mysqli_connect($db_host, $db_user, $db_pass,$db_name);



// mysqli_set_charset($conn, "utf8");

if (!$conn ) 
{
    $response["status"] = 3;
	$response["message"] = "Login Error";	
}
else
{     // $query = "select * from arch";
		$query = "INSERT INTO arch(username,password) VALUES ('$username','$password')";		
		$result = mysqli_query($conn,$query);
		
		
		if(!$result)
		{
			$response["status"] = 0;
			$response["message"] = "Error registering the user";
		}
		else
		{
			$response["status"] = 1;
			$response["message"] = "Registration successful";
			
		}				
				mysqli_close($conn);
}
echo json_encode($response);
?>