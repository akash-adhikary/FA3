<?php
class drug
{
	private $drug_id;
	public $drug_name;
	private $drug_price;
	public $quantity_available;
	static $drug_counter=100;
function __construct($dname,$dprice,$quantity_avail)
{
	$this->drug_name=$dname;
	$this->drug_price=$dprice;
	$this->quantity_available=$quantity_avail;
	self::$drug_counter+=1;
	$this->drug_id='D'.self::$drug_counter;
	
}
function get_drug_id()
{
	return $this->drug_id;
}
function get_drug_price()
{
	return $this->drug_price;
}
function fetch_drug_code()
{
	
		$name=$this->drug_name;
        $arr = explode(' ',$name);
		$size=sizeof($arr);
		//print_r($name);
		//print_r($arr);
		//print_r($size);
	if($size==1)
		{
			$arr1=substr($name,0,3);
		}
		else
		{
			$arr1='';
			for($i=0;$i<$size;$i++)
			{
				$arr1=$arr1.$arr[$i][0];
			}
		}
	$upper=strtoupper($arr1);
	return $upper;


}
function fetch_bill_amount($quantity_required)
{
	$a=$this->quantity_available;
	if($a>=$quantity_required)
	{
		$drug_price=$this->get_drug_price();
		$bill_amount=$quantity_required*$drug_price;
		return $bill_amount;
	}
	else
	{
		return 1;
	}
}
}

	
?>
