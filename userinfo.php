<?php 
session_start();

    $_SESSION;

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

    $id = $user_data['id'];

    if($_SERVER['REQUEST_METHOD'] == "POST")
	{
        //Delete user with id that is logged in 
        $sql = "delete from users where id = $id";

        if ($con->query($sql) === TRUE) {
            echo '<script>alert("User was successfully deleted"); window.location.replace("login.php");</script>';
        } else {
            echo '<script>alert("Something went wrong :( Please contact us at the help page");</script>';
        }

        
    }

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="index.css">
    <style><?php include "index.css"; ?></style>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<title>User Info</title>
</head>


<body>

    <center>
        <div id="bigbox">
            <a class="logout" href="logout.php">Logout</a>
            <button id="backbuttonuserinfo" type="button" onclick="location.href = 'index.php'">Go back</button>
            <div id="userinfoicon">
                <a class="material-icons" style="font-size:150px">person</a>
            </div>
            <div id="alltextuserinfo">
                <div id="textuserinfo"><strong>Email: </strong><?php echo $user_data['user_name'] ?></div>
                <div id="textuserinfo"><strong>Password: </strong>Request to view password at: <a class="link" href="help2.php">10.2.2.78/help2.php</a></div>
                <div id="textuserinfo"><strong>Id: </strong><?php echo $user_data['id'] ?></div>
                <div id="textuserinfo"><strong>Hidden Game Score: </strong><?php echo $user_data['gamescore'] ?></div>
            </div>
            
            <!--Checkbox and delete button-->
        <form method="post">
            <div id="areyousuredelete">
                    <input id="checkBoxuser" type="checkbox" onclick="areyousure()">
                    <label for="checkBoxuser" id="checkboxtextuser"><p class="agree">Are you sure you want to delete this user?</p></label>
            </div>

            <button id="deleteuserbutton" type="submit" value="DeleteUser" disabled>Delete this user</button>
        </form>

        </div>
        
    </center>

</body>
    <script>
        
        //"Are you sure you want to delete this user?" checkbox
        function areyousure()
        {
            var checkBoxuser = document.getElementById("checkBoxuser");
            var deleteuserbutton = document.getElementById("deleteuserbutton")

            document.getElementById("deleteuserbutton").onclick = function () {
            location.href = "index.php";
            };

            if(checkBoxuser.checked == true)
            {
                document.getElementById("deleteuserbutton").disabled = false; 
            }else
            {
                document.getElementById("deleteuserbutton").disabled = true; 
            }

        }



    </script>
</html>
