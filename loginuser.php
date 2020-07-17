<?php 
$db_name = 'daccess';
$db_user = 'root';
$db_pass = '';
$db_host = 'localhost'; 
$response = array();
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array
$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	
$username = $input['uname1'];      //changes from the android 
$password = $input['pass1'];
if (!$conn ) 
{
    $response["status"] = 3;
	$response["message"] = "Login Error";	
}
else
{
		$query = "SELECT * FROM  arch WHERE username = '$username' AND password ='$password'";		
		$retval = mysqli_query($conn,$query);
		
		
		if(mysqli_num_rows($retval)<=0)
		{
			$response["status"] = 0;
			$response["message"] = "Email or passWord is incorrect";
		}
		else
		{
		    while($row = mysqli_fetch_assoc($retval)) 
			{ 
			    $username=$row['username'];
			    $password=$row['password'];
				
			}
			$response["status"] = 1;
			$response["username"] = $username;
			$response["password"] = $password;
			$response["message"] = "Login successful";
			
		}				
					mysqli_close($conn);
}
echo json_encode($response);
?>