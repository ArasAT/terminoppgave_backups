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

        //hasing the password
        $password = md5($password);

        

        //if inputs is not empty
		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

            $select = mysqli_query($con, "SELECT * FROM users WHERE user_name = '".$_POST['user_name']."'");
            if(mysqli_num_rows($select)) {
                echo '<script>alert("Username already exists")</script>';
            }

			//save to database
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

			$con->query($query);

			header("Location: login.php");
			die;
		}else
		{
			echo '<script>alert("Please enter some valid information")</script>';
		}
	}

    
?>
<html>
<head>
    <link rel="stylesheet" href="index.css">
    <style><?php include "index.css"; ?></style>
	<title>Signup Page</title>
</head>
<body>

        <div id="boxsign">
            
            <form method="post" onkeydown="return event.key != 'Enter';">
            
                <br>
                <div class="headertext">Signup</div>

                <div class="inputboxes">

                    <div class="inputs">
                        <input id="text" type="email" name="user_name" placeholder="Email"><br><br>
                        <input id="text" type="password" name="password" placeholder="Password (DON'T FORGET)"><br><br>
                    </div>
                    <div class="terms">
                    <input id="checkBox" type="checkbox" onclick="checkTerms()">
                    <label for="checkBox" id="checkboxtext"><p class="agree">Agree with <a class="link" href="laws.php">Terms and Conditions</a></p></label>
                    </div>
                        
                        
                    <input id="buttonsign" type="submit" value="Signup">
                        
                    <input id="buttonsignX" type="button" value="Signup">
                        
                        
                    <div class="uptextbox">
                        <a class="uptext" href="login.php">Click to Login</a>
                    </div>
                        <br><br>
                    <div class="help_box">
                        <a class="help_text">Having problems? Click </a><a class="help_text_link" href="help2.php">HERE</a>
                    </div>
                </div>

		</form>
	</div>

    <script>
        function checkTerms()
        {
            var checkBox = document.getElementById("checkBox");
            var buttonsign = document.getElementById("buttonsign")
            var buttonsignX = document.getElementById("buttonsignX");

            if(checkBox.checked == true)
            {
                buttonsign.style.display = "block";
                buttonsignX.style.display = "none";
            }else
            {
                buttonsign.style.display = "none";
                buttonsignX.style.display = "block";
                	//Don't signup with clicking enter
                $(document).on("keydown", "form", function(event) { 
                    return event.key != "Enter";
                });
            }

        }
        

    </script>

</body>
</html>
