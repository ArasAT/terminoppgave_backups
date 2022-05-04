<!DOCTYPE html>
<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		$wronguser = '<script>alert("Wrong username or password!")</script>';
		$emptytext = '<script>alert("Please enter some valid information")</script>';
        
        //if inputs is not empty
		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = $con->query($query);
			
			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);

                    $user_hashed_password = "select password from users where user_name = '$user_name' limit 1";
                    

					//check if the password is correct
					if($user_data['password'] == md5($password))
					{
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
					
				}
				
			}
			
			print $wronguser;
		}else
		{
			print $emptytext;
		}
	}

?>
<html>
<head>
    <link rel="stylesheet" href="index.css">
    <style><?php include "index.css"; ?></style>
	<title>Login Page</title>
</head>
<body>

<div id="box">

		<form method="post">
            <br>
			<div class="headertext">Login</div>

                <div class="inputboxes">

                    <div class="inputs">
			            <input id="text" type="email" name="user_name" placeholder="Email"><br><br>
			            <input id="text" type="password" name="password" placeholder="Password"><br><br>
                    </div>

			        <input id="button" type="submit" value="Login">
                        <br><br>
                    <div class="uptextbox">
			            <a class="uptext" href="signup.php">Click to Signup</a>
                    </div>
                        <br><br>
                    <div class="help_box">
						<a class="help_text">Having problems? Click </a><a class="help_text_link" href="help2.php">HERE</a>
                    </div>
                </div>


		</form>

		
			<p class="phpwarning">wrong username or password!</p>
		
</div>
</body>
</html>
