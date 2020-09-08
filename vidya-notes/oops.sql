<?php

class Employee
{
    private $id;
    public $name;
    private $email;
    private $phone_no;
    private $age;
    static $num_emp=1;

    function __construct()
    {
        self::$num_emp+=1;
    }


    function get_id(){
        return $this->id;
    }

    function set_id($id)
    {
        $this->id=$id;
    }

    function get_email()
    {
        return $this->email;
    }

    function set_email($e_mail)
    {
        $this->email=$e_mail;
    }


    function get_phone_no()
    {
        return $this->phone_no;
    }

    function set_phone_no($phone_no)
    {
        $this->phone_no=$phone_no;
    }

    function val_email($email)
    {
       
        $pattern = "/^[A-Za-z]+@[A-Za-z]+.[A-Za-z]+$/i";
        $res = preg_match($pattern, $email);
        return $res;
        // if ($res == 1)
        // {
        //     echo"correct";
        //     return 1;
        // }
        // else
        // {
        //     echo"incorrect";
        //     return 0;
        // }
    }

    function expand_name($email)
    {
        $domainname = explode('@',$email);
        $fullname=$domainname[0];
        $name = explode('.',$fullname);
        $firstname=$name[0];
        $secondname=$name[1];
        print($secondname);
        return $firstname;
    }


}


$a = new Employee();
$b = new Employee();

print(Employee::$num_emp);

// $a->set_email("nuzha.anamms@gmail.com");

// print($a->name);
// print($a->get_id());
// print($a->get_email());
// echo " ";
// print( $a->expand_name("nuzha.anamms@gmail.com"));


// $b=ctype_upper ( "NUZHA" );
// print($b);

// print($a->val_email("nuzhaanamms@gmail.com"));


?>
