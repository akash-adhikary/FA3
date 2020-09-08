<?php

#function_1
function fetch_specialization()
{
        include("connection.php");
		$query="select specialization_name from specialization;";
		$result=mysqli_query($con,$query);
		$nr=$result->num_rows;
		$array=array();
		if($result->num_rows>0)
		{
			for($x=0; $x<$nr; $x+=1)
			{
			$row=$result->fetch_assoc();
			$arr=$row['specialization_name'];
			array_push($array,$arr);
		    
			
			}
		}
		$a=implode('&',$array);
		//echo($a);
        return $a;   

}
#function_2
function validate_login($doctor_name,$specialization)
{
   

        
           $abc="/^[A-Za-z\s]+$/i";
           $filter=preg_match($abc,$doctor_name);


           if($filter)
            //$con = mysqli_connect("localhost","T1082806","#infy123","os_T1082806");
			include('connection.php');
            $result = mysqli_query($con,"select *  from doctor_details where doctor_name='$doctor_name';");
            if ($result->num_rows > 0)
            {      
                $row = $result->fetch_assoc();
                // print_r($row);
                if($row['specialization_name'] == $specialization)
                {
                    return 1;
                }
                else
                {
                    return 3;
                }
               
            }
            else
            {
               return 2;
            }

}
#function_3
function get_session_doctor_name()
{
        session_start();
		$a=$_SESSION['DNAME'];
		return $a;
}
#function_4
function validate_patient_details($p_name,$p_age)
{

        $a=trim($p_name);
		$pattern="/^[A-Za-z]+$/i";
        $ab=preg_match($pattern,$a);
            if ($ab==1)
			{
				
			$range=array("min_range"=>0, "max_range"=>100);
            $options=array("options"=>$range);
            $filter=filter_var($p_age, FILTER_VALIDATE_INT,$options);

					if ($filter)
						{
							return 1;
						}
					else
						{
							return 3;
							
						}
			}
			else
			{
				return 2;
			}
			

}
#function_5
function validate_quantity_drug_correspondence($drugs,$quantity)
{
        $a=substr_count($drugs,',');
		$b=substr_count($quantity,',');
		if ($a==$b)
		{
			return 1;
		}
		else
		{
			return 2;
		}

}
#function_6
function validate_drug_availability($drugs,$quantity)
{
			include('connection.php');
			$drug = explode(',',$drugs);
			$quan = explode(',',$quantity);
			$siz=sizeof($drug);			
			
			
            //$con = mysqli_connect("localhost","T1082806","#infy123","os_T1082806");
			include('connection.php');
			for($x=0 ; $x < $siz; $x+=1)
			{
				
				
            $result = mysqli_query($con,"select *  from drug_details where drug_name='$drug[$x]';");
            if ($result->num_rows > 0)
            {    
				
                $row = $result->fetch_assoc();
                // print_r($row);
                if($row['quantity_available'] < $quan[$x])
                {
                    return 3;
                }
				
			}
            else
                {
                    return 2;
                }
               
          
            }
			return 1;
			}

			

           
		
			



#function_7
function generate_bill($name,$age,$drugs,$quantity)
{
	include("connection.php");
	$drug = explode(',',$drugs);
	$quan = explode(',',$quantity);
	$size=sizeof($drug);
	if(empty($name) || empty($age) || empty($drugs) || empty($quantity))
        {
            return 2;
        }
	else
	{
		$v1=validate_patient_details($name,$age);
		$v2=validate_quantity_drug_correspondence($drugs,$quantity);
		$v3=validate_drug_availability($drugs,$quantity);
		if($v1!=1)
		{
			return 3;
		}
		if($v2!=1)
		{
			return 4;
		}
		if ($v3!=1)
		{
			return 5;
		}
		$total_bill=0;
		for($i=0;$i<$size;$i+=1)
		{
		$query="select * from drug_details where drug_name='$drug[$i]';";
		$result=mysqli_query($con,$query);
		$nr=$result->num_rows;
		if($nr>0)
		{
			$row=$result->fetch_assoc();
			$price_per_unit=$row['price_per_unit'];
		    $total_bill=$total_bill+($quan[$i]*$price_per_unit);
		}
		}
			insert_patient_details($name,$age,$total_bill);
			update_stock_details($drugs,$quantity);
			return $total_bill;
	}
		

			
		
		
        

}
#function_8
function insert_patient_details($p_name,$p_age,$bill_amount)
{
		include('connection.php');
		session_start();
		//$doctor_name=$_SESSION['DNAME'];
		$doctor_name='Dr B Rajashekar';
		include('connection.php');
		$query="select * from doctor_details where doctor_name='$doctor_name';";
		$result=mysqli_query($con,$query);
		$nr=$result->num_rows;
		//print($nr);
		if($nr>0)
		{
			$row=$result->fetch_assoc();
			$doctor_id=$row['doctor_id'];
			$sql="insert into bill_details values(NULL,'$p_name','$p_age',$doctor_id,$bill_amount);";
			$con->query($sql);
		
        //if ($con->query($sql) === TRUE)
			/*{
            echo "New record created successfully";
            } 
		  else 
		  {
            echo "Error: " . $sql . "<br>" . $con->error;
          }*/
		  }
		

}
#function_9
function update_stock_details($drug,$quantity)
{		include('connection.php');
       $drug = explode(',',$drug);
	   $quan = explode(',',$quantity);
	   $size=sizeof($drug);
	   for($x=0;$x<$size;$x+=1)
	   {
		   $query="update drug_details set quantity_available=quantity_available-$quan[$x] where drug_name='$drug[$x]';";
		   $result=mysqli_query($con,$query);
		   $con->query($result);
	   }
}
#function_10
//print(fetch_specialization());
//print(validate_login('Dr B Rajashekar','General Physician'));
//print(get_session_doctor_name());
//print(validate_patient_details('Akash',23));
//print(validate_quantity_drug_correspondence('Amoxicillin,Doxycycline,Codeine,Ibuprofen,Gabapentin,Gabapentin,Naproxen,Metoprolol,Tramadol','10,2,3,4,5,6,7,6,8'));
//print(validate_drug_availability('Amoxicillin,Doxycycline','2,3'));
//print(generate_bill('Akash',23,'Amoxicillin,Doxycycline','2,3'));
//print(insert_patient_details('Akash',23,2000));
//print(update_stock_details('Amoxicillin,Doxycycline,Codeine,Ibuprofen,Gabapentin,Naproxen,Metoprolol,Tramadol','2,3,4,5,6,7,6,8'));


?>
