<?php
//$a=$_COOKIE['Cookie1'];
session_start();
$a=$_SESSION['Email'];
$arr = explode('@',$a);
$arr1=explode('.',$arr[0]);
echo "Welcome ".$arr1[0];
if (isset($arr1[1]))
{
	echo " " .$arr1[1];
}


$query="select states, stateid from statedetails";
$con = mysqli_connect("localhost","T1082806","#infy123","os_T1082806");
$result = mysqli_query($con,$query);
$statenames=array();
$nr=$result->num_rows;
if($nr>0)
{
  for ($x = 0; $x < $nr; $x+=1)
  {
    $row=$result->fetch_assoc();
    array_push($statenames,$row["states"]);
  }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <form  method="post">
        <table>
          <tr>
            <td> State </td>
            <td><select id="state" name="state">
              <?php
              for ($x = 0; $x < $nr; $x+=1)
                {
                  echo" <option value=" . "'" .$statenames[$x] ."'". ">".$statenames[$x]. "</option>";
                }
               echo"</select>";
             
              ?>
            </td>
          </tr>
         
          <tr id="city">

          </tr>

        <tr>
        <td>
        <input type="submit" name="submit" value="submit">
        </td>
        </tr>



</table>
</form>
<div id=scriptdata></div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>

$(document).ready(function(){
    $("#state").click(function(){
        var x = document.getElementById("state").value;
        $("#city").load("ajax1.php",{
            statename: x
        });
    });
});

</script>
</html>


<?php



if (isset ($_REQUEST['submit']))
{
        $usr_email = $a;
        $state=$_REQUEST['state'];
        $city=$_REQUEST['city'];
        $con = mysqli_connect("localhost","T1082806","#infy123","os_T1082806");
        //$result = mysqli_query($con,"insert into userdetails1 values($usr_email,$state,$city);");
        $sql="insert into userdetails1 values('$usr_email','$state','$city');";
        if ($con->query($sql) === TRUE) {
            echo "New record created successfully";
			header("location: home.php");
          } else {
            echo "Error: " . $sql . "<br>" . $con->error;
          }
       
}
?>
