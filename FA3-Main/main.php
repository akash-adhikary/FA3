<?php
#function_1
function validate_login($username,$password)
{	if(empty($username) || empty($password) || preg_match("/^\s*$/i",$username) ||preg_match("/^\s*$/i",$password))
	{return -1;		}
	else
	{	include('connection.php');
        $query=mysqli_query($con,"select * from login where username='$username';");
               if($query->num_rows>0)
               { 	$row=$query->fetch_assoc();
					  if($row['password']==$password)
					  {  return 1;}
					  else
					  {	  return -2;}

               }
			   else
			   {
				   return -2;
			   }
              
		}         
               	
}
#function_2
function get_session_id()
{	return $_SESSION['user_name'];
}
#function_3
function fetch_grocery_id($grocery_name)
{
	include('connection.php');
	$query="select groceryid from grocerydetails where groceryname='$grocery_name'";
		$result=mysqli_query($con,$query);
		$nr=$result->num_rows;
		$str=array();
		if($nr>0)
		{
				$row=$result->fetch_assoc();
				return $row['groceryid'];
		}
}
#function_4
function validate_qty_ordered($grocery_name,$qty_ordered)
{	if($qty_ordered>0 || $qty_ordered<=25)
	{	include('connection.php');
		$query="select * from  grocerydetails where grocery_name='$grocery_name';";
		$result=mysqli_query($con,$query);
		$nr=$result->num_rows;
			if($nr>0)
			{	$row=$result->fetch_assoc();
				if($row['qtyinstock']>=$qty_ordered)
				{
					return $grocery_name."#".$row['priceperunit'];}
				else
				{return -2;}
			}
			else
			{return -2;}
	}
	else
	{return -1;}
	
}
#function_5
function add_order($grocery_name,$qty_ordered,$total_price,$delivery_address,$phone_no)
{
	#function_6
	
}
#function_6
function place_order($grocery_name,$qty_ordered,$delivery_address,$phone_no)
{
	# Remove the hash-tag and write your Logic
}
#function_7

?>
