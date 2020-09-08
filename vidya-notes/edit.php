<?php
session_start();
$email=$_SESSION['Email'];
$title=$_REQUEST['title'];

if(isset($_REQUEST['delete']))
{
	print_r($_REQUEST);
	include("../nuznotes/db_connect.php");
	$query1="delete from notes where email='$email' and title='". $_REQUEST['title']."' ;";
	if ($con->query($query1) === TRUE) 
			    {
					echo "Deleted successfully";
					//header("location: home.php");
				} 
			else 
				{
					echo "Error: " . $query1 . "<br>" . $con->error;
				}
		

			
}

if(isset($_REQUEST['edit']))
{
	
	include("../nuznotes/db_connect.php");
	$query="select * from notes where email='$email' and title='$title';";
	$result=mysqli_query($con,$query);
	$notebody='';

	if($result->num_rows>0)
	{
			$row=$result->fetch_assoc();
			$notebody=$row['notebody'];

	}
	
	echo '
<html>
<form method="post">
<table>
<tr>
<td><input type="text" name="date" value="'.$_REQUEST['date'].'"></td>
</tr>
<tr>
<td><input type="text" name="title" value="'.$_REQUEST['title'].'"></td>
</tr>
<tr>
<td><textarea name="notebody" rows="10" cols="100" >'.$notebody.'</textarea></td>
</tr>
<tr>
<td><input type="submit" name="save" value="save"></td>
</tr>
</table>
</form>
</html>	';

print_r($_REQUEST);

}

if(isset($_REQUEST['save']))
{
	print_r($_REQUEST);
	$notebody=$_REQUEST['notebody'];
	$date=$_REQUEST['date'];
	$title=$_REQUEST['title'];
	include("../nuznotes/db_connect.php");
	$query1="update notes set notebody='$notebody' where email='$email' and title='$title' ;";
	if ($con->query($query1) === TRUE) 
			    {
					echo "New record created successfully";
					//header("location: home.php");
				} 
			else 
				{
					echo "Error: " . $query1 . "<br>" . $con->error;
				}
			
}
//, datecreated=".$_REQUEST['date'].", title=".$title."
?>


