<?php


if(isset($_REQUEST['statename']))
{
    $var = $_REQUEST['statename'];

    $query1="select cities from citydetails cd inner join statedetails sd on cd.stateid=sd.stateid where states='$var'";
    $con = mysqli_connect("localhost","T1082806","#infy123","os_T1082806");
    $result = mysqli_query($con,$query1);

    $citynames=array();
    $nr1=$result->num_rows;
    if($nr1>0)
    {
        for ($x = 0; $x < $nr1; $x+=1)
            {
                $row=$result->fetch_assoc();
                //print_r($row["states"]);
                array_push($citynames,$row["cities"]);
            }

    }
}

            echo "<td> City </td>";
            echo "<td><select  name='city' >";
            for ($x = 0; $x < $nr1; $x+=1)
                {
                    echo" <option value=" . "'" .$citynames[$x] ."'". ">".$citynames[$x]. "</option>";
                }
            echo"</select>";
            echo"</td>";

?>
