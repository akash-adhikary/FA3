<html>
<form method="post">
<table>
<tr>
<td>Name</td>
<td><input type="text" name="name" ></td>
</tr>
<tr>
<td>Phone no</td>
<td><input type="number" name="phone_no"> </td>
</tr>
<tr>
<td>Email</td>
<td><input type="text" name="email"> </td>
</tr>
<tr>
<td>username</td>
<td><input type="text" name="username"> </td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" name="password"> </td>
</tr>
<tr>
<td>Age</td>
<td><input type="text" name="age" ></td>
</tr>
<tr>
<td style="text-align: center"><input type="submit" name="submit" value="submit" ></td>
</tr>
</table>
</form>
</html>

<?php
class nuznote{
    private $name;
    private $phone_no;
    private $email;
    private $username;
    private $password;
    private $age;
	
	
	//function __construct($name,$phone_no,$email,$password,$age,$username)
	//{
		//print($this->validate_set($name,$phone_no,$email,$password,$age,$username));
	//}
    function __get($var)
       {
			return $this->$var;
       }
    function __set($var,$value)
       {
			$this->$var=$value;
       }
    function validate_name($name)
        { 
            $pattern="/^[A-Za-z]+\s?[A-Za-z]+$/i";
            $a=preg_match($pattern,$name);
            if ($a==1)
                {
                    return 1;
                }
            else
                            {
                    return 0;
                    
                }
        }
    function validate_phone($phone_no)
        { 
            $pattern1="/^[0-9]{10}$/i";
            $b=preg_match($pattern1,$phone_no);
            if ($b==1)
                {
                    return 1;
                }
            else
                {
                    return 0;
                    
                }
        }
    function validate_password($password)
        { 
		if(preg_match("/.{8}.*/i",$password))
			{
           $pattern2="/[A-Z]+/i";
           $c=preg_match($pattern2,$password);
           if ($c)
           {
               $pattern3="/[a-z]+/i";
               $d=preg_match($pattern3,$password);
                        if($d)
                        {
                            $e=preg_match("/[0-9]+/i",$password);
                                    if($e)
                                    {
                                        $f=preg_match("/(\W)+/i",$password);
                                            if($f)
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
		else
		{
			return 0;
		}
        }
    // function validate_email($email)
    //     { 
    //        $filter=filter_var($email,FILTER_VALIDATE_EMAIL);
    //        if($filter)
    //        {
    //            $con=mysqli_connect("localhost","T1082806","#infy123","os_T1082806");
    //            $query=mysqli_query($con,"select email from nuz_note where email='$email';");
    //            if($query->num_rows>0)
    //            {
    //                return 0;
    //            }
    //            else{
    //                return 1;
    //            }
    //        }
    //        else
    //        {
    //            return 0;
    //        }
    //     }
        function validate_email($email)
        { 
           $abc="/^\w+\.?\w+@\w+\.\w+$/i";
           $filter=preg_match($abc,$email);
           if($filter)
           {
               //$con=mysqli_connect("localhost","T1082806","#infy123","os_T1082806");
			   include('db_connect.php');
               $query=mysqli_query($con,"select email from nuz_note where email='$email';");
               if($query->num_rows>0)
               {
                   return 0;
               }
               else{
                   return 1;
               }
           }
           else
           {
               return 0;
           }
        }



        function validate_age($age)
        { 
            
            $range=array("min_range"=>0, "max_range"=>100);
            $options=array("options"=>$range);
            $filter=filter_var($age, FILTER_VALIDATE_INT,$options);

            if ($filter)
                {
                    return 1;
                }
            else
                {
                    return 0;
                    
                }
        }
        // function validate_age($age)
        // { 
            
        //     if ($age>=0 && $age<=100)
        //         {
        //             return 1;
        //         }
        //     else
        //         {
        //             return 0;
                    
        //         }
        // }
        function validate_username($username)
        { 

        
           $abc="/^\w+(\.?\w+)?$/i";
           $filter=preg_match($abc,$username);


           if($filter)
           {
               //$con=mysqli_connect("localhost","T1082806","#infy123","os_T1082806");
			   include('db_connect.php');
               $query=mysqli_query($con,"select username from nuz_note where username='$username';");
               if($query->num_rows>0)
               {
                   return 0;
               }
               else
               {
                   return 1;
               }
           }
           else
           {
            return 0;
           }
        }
		
	function validate_set($name,$phone_no,$email,$password,$age,$username)
	{
		$name1=$this->validate_name($name);
		$phone_no1=$this->validate_phone($phone_no);
		$email1=$this->validate_email($email);
		$password1=$this->validate_password($password);
		$age1=$this->validate_age($age);
		$username1=$this->validate_username($username);
		if ($name1==1 && $phone_no1==1 && $email1==1 && $password1==1 && $age1==1 && $username1==1)
		{
			//$this->name=$name;
			$this->__set("name",$name);
			$this->phone_no=$phone_no;
			$this->email=$email;
			$this->password=$password;
			$this->age=$age;
			$this->username=$username;
			return 1;
		}
		else
		{
			return 0;
		}
		
	}
	
	function sql_inject()
	{	
		include('db_connect.php');
		$sql="insert into nuz_note values('$this->name','$this->email',$this->phone_no,'$this->username','$this->password',$this->age);";
			if ($con->query($sql) === TRUE) 
			    {
					echo "New record created successfully";
				} 
			else 
				{
					echo "Error: " . $sql . "<br>" . $con->error;
				}
	}
    


}

// print_r($_REQUEST);
if(isset($_REQUEST['submit']))
{
    $name=$_REQUEST['name'];
    $phone_no=$_REQUEST['phone_no'];
    $email=$_REQUEST['email'];
    $password=$_REQUEST['password'];
    $age=$_REQUEST['age'];
    $username=$_REQUEST['username'];



$a=new nuznote($name,$phone_no,$email,$password,$age,$username);

if($a->validate_set($name,$phone_no,$email,$password,$age,$username))
{
		$a->sql_inject();
		header( "location: ../vidyanotes/login.php");
		
}
else
{
	echo "data not correct";
}


//$name1=$a->validate_name($name);
//$phone_no1=$a->validate_phone($phone_no);
//$email1=$a->validate_email($email);
//$password1=$a->validate_password($password);
//$age1=$a->validate_age($age);
//$username1=$a->validate_username($username);



//print($name1);
//print($phone_no1);
//print($email1);
//print($password1);
//print($age1);
//print($username1);

//print($a->__get("name"));

//$a->__set("name","Nuzha Anam MS");

//print($a->__get("name"));
}
?>
