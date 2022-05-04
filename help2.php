
<!DOCTYPE html>
<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
			$email = $_POST['email']; 
        	$text = $_POST['text']; 
		echo $email;
        //if inputs is not empty
		if(!empty($email) && !empty($text))
		{

            $help_id = random_num(20);
			$query = "insert into help (id,email,text) values ('$help_id','$email','$text')";

			$con->query($query);

			header("Location: login.php");
			die;
		}elseif (empty($email) || empty($text))
		{
			echo '<script>alert("Please enter some valid information")</script>';
		}
	}

//test
?>
<html>
<head>
    <link rel="stylesheet" href="index.css">
    <style><?php include "index.css"; ?></style>
	<title>Help Page</title>
</head>
<body>

        <div id="boxhelp">
        <input id="backbutton" type="button" value="Go back to login" onclick="location.href = 'login.php'">
            <form method="post">
                <br>
                <div class="headertexthelp">Help</div>

                <div class="inputboxes">

                    <div class="inPuts">
                      <input id="titlehelp" type="email" name="email" placeholder="Email" maxlength="100"><br><br>
                        <textarea id="texthelp" type="text" name="text" placeholder="Text" maxlength="1000"></textarea>
                	</div>                       
			<p id="the-count">0 / 1000</p>
                       
                   <input id="buttonhelp" type="submit" value="Submit">

                </div>

		</form>
	</div>
	<script>
		let myText = document.getElementById("texthelp");
		myText.addEventListener("input", () => {
		    let count = (myText.value).length;
		    document.getElementById("the-count").textContent = `${count} / 1000`;
		});
	</script>
</body>


</html>
