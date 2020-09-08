<html>
<form method="post">
<table>
<tr>
<td><input type="text" name="date" placeholder="enter date"></td>
</tr>
<tr>
<td><input type="text" name="title" placeholder="Insert a title"></td>
</tr>
<tr>
<td><textarea name="body" rows="10" cols="100" placeholder="Insert a body"></textarea></td>
</tr>
<tr>
<td><input type="submit" name="submit" value="save"></td>
</tr>
</table>
</form>
</html>
<?php
session_start();
$email=$_SESSION['Email'];
class notes
{
	private $email;
	private $date1;
	private $date2;
	private $title;
	private $body;

	
	function __construct($email,$date1,$title,$body)
	{
		$this->email=$email;
		$this->date1=$date1;
		$this->title=$title;
		$this->body=$body;
		
	}
	
	
	function validate_date()
	{
		$vd=preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/i",$this->date1);
		if($vd)
		{
			$a=explode('/',$this->date1);
			//print_r($a);
			$b=checkdate($a[1],$a[0],$a[2]);//a[0]-day,a[1]=month,a[2]=year;
			if($b)
			{
				$this->date2=$a[2]."-".$a[1]."-".$a[0];
				//print($this->date2);
				return 1;
			}
		    else
			{
				return 0;
			}
			
		}
		else
		{
			return 0;
		}	
	}
	function validate_title()
	{
		$a=preg_match("/([\w\s\.])/i",$this->title);
		if($a)
		{
			if(strlen($this->title)<=30)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	function set_inject()
	{
		$a=$this->validate_date();
		$b=$this->validate_title();
		if($a && $b)
		{
			include("../nuznotes/db_connect.php");
			$query1="insert into notes values('$this->email','$this->date2','$this->title','$this->body');";
			if ($con->query($query1) === TRUE) 
			    {
					echo "New record created successfully";
				} 
			else 
				{
					echo "Error: " . $query1 . "<br>" . $con->error;
				}
		}
		else
		{
			echo "not inserted";
		}
	}
	
	static function load_user_data($email)
	{	//$email=$this->email;
		echo"loading";
		include("../nuznotes/db_connect.php");
		$query="select * from notes where email='$email';";
		$result=mysqli_query($con,$query);
		$nr=$result->num_rows;
		if($nr>0)
		{	
			echo "<form  action='edit.php' method='post'>";
			echo "<table>";
			
			for ($x = 0; $x < $nr; $x+=1)
				{
					$row=$result->fetch_assoc();
					echo "<tr> <td>";
					echo "<input type='text' value=".$row['datecreated']." readonly name='date'>" ;
					echo "</td><td>";
					echo "<input type='text' value=".$row['title']." readonly name='title'>" ;
					echo "</td><td>";
					echo "<input type='submit' value='edit' name='edit'>";
					echo "</td><td>";
					echo "<input type='submit' value='delete' name='delete'>";
				}
			echo "</table>";
			echo "</form>";
		}
		
	}
}

notes::load_user_data($email);

if(isset($_REQUEST['submit']))
{
$date1=$_REQUEST['date'];
$title=$_REQUEST['title'];
$body=$_REQUEST['body'];


$obj=new notes($email,$date1,$title,$body);

$obj->set_inject();
}
?>
