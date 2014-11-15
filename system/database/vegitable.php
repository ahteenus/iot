<?php

// base class with member properties and methods
class my_class {

    public  $my_value = array();
    
    function __construct ($host,$user,$password,$value) {
        $mysqlcon1 = mysql_connect($host,$user,$password);
  if (!$mysqlcon1) {
    return false;//die('Could not connect: '.mysql_error());
    echo "h";
  }
        $this->my_value[] = $mysqlcon1;
        echo $this->my_value[0];
        
  echo $mysqlcon1;
    }

    function set_value ($value) {
        if (!is_array($value)) {
            throw new Exception("Illegal argument");
        }

        $this->my_value = $value;
        echo $this->my_value[0];
    }

    function add_value($value) {
        $this->my_value = $value;
        echo $this->my_value[0];
    }
}

$a = new my_class ("localhost","user_info","mLR7ZV7HnDsPQ4ts",'a');
$a->my_value[] = 'b';
$a->add_value('c');
$a->set_value(array('d'));
?>