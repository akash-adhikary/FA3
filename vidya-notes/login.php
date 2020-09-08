<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunflower</title>
</head>
<body>
<form method="post">
<table>
<tr>
<td>Email</td><td><input type="text" name="Email" placeholder="Enter Email" ></td></tr>
<tr><td>Password</td><td><input type="password" name="password" placeholder="Enter Password"></td></tr>
            <!--  -->
            <!-- <tr>
            <td>Gender</td>
            <td>
                    Male<input type="radio" id="male" name="gender" value="male" checked>
                    Female<input type="radio" id="female" name="gender" value="female">
                    Other<input type="radio" id="other" name="gender" value="other">
            </td>
            </tr>  -->
            <!--  -->
&nbsp;&nbsp;
<tr><td><input type="submit" name="submit" value="submit"></td>
</tr>
</table>
</form>
</body>
</html>

<?php

// print_r($_REQUEST);

if (isset ($_REQUEST['submit']))
{
        $usr_email = $_REQUEST['Email'];
        $pwd=$_REQUEST['password'];
        //$radio=$_REQUEST['gender'];

        //print($radio);

        if(empty($usr_email) || empty($pwd))
        {
            echo "Fields cannot be empty";
        }
        else
        {

            $con = mysqli_connect("localhost","T1082806","#infy123","os_T1082806");

            $result = mysqli_query($con,"select *  from nuz_note where email='$usr_email';");
            if ($result->num_rows > 0)
            {      
                $row = $result->fetch_assoc();
                // print_r($row);
                if($row['password'] == $pwd)
                {
                    //setcookie("Cookie1",$_REQUEST['Email'],time()+1200);
                    session_start();
                    $_SESSION["Email"]=$usr_email;
                    $_SESSION["Password"]=$pwd;
                    header("Location: abc.php");
                }
                else
                {
                    print("Incorrect Password");
                }
               
            }
            else
            {
                print("incorrect email");
            }

        }

}
?>
