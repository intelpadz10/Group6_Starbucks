<?php

require_once 'DBfunctions.php';


try {
    $dbStarbucks = new PDO('mysql:host=localhost;dbname=starbucks', 'root', '');
} catch(PDOException $e) {
    echo $e->getMessage();
}


$db=new DBfunctions($dbStarbucks);


if(isset($_GET['all'])){
    $result=$db->select()->from('consumable')->getAll();
    $result2=json_encode($result);
    echo $result2;
}

else if(isset($_GET['con_name'])=='Snacks'){
    $result=$db->select()->from('product')->where('ID_con',1)->getAll();
    $result2=json_encode($result);
    echo $result;
}

else if(isset($_GET['con_name'])=='Coffee'){
    $result=$db->select()->from('product')->where('ID_con',2)->getAll();
    $result2=json_encode($result);
    echo $result;
}

else if(isset($_GET['con_name'])=='Drinks'){
    $result=$db->select()->from('product')->where('ID_con',3)->getAll();
    $result2=json_encode($result);
    echo $result;
}

else if(isset($_GET['con_name'])=='Bakery'){
    $result=$db->select()->from('product')->where('ID_con',4)->getAll();
    $result2=json_encode($result);
    echo $result;
}




