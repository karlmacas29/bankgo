<?php
    include("config.php");

    $id = $_POST["id"];
    $wit = $_POST["wit"];

    $dep = "UPDATE withdrawals SET wit_amount = wit_amount + {$wit} WHERE client_id ={$id}";

    $sql = "UPDATE balance_inq SET bal_balance = bal_balance - {$wit} WHERE client_id = {$id}";
    
    $msg = "";
    if($con->query($dep)===TRUE AND $con->query($sql)===TRUE){
        $msg = array("val"=> true , "msg" => "Withdraw Success!");
    }else{
        $msg = array("val" => false, "msg" => "ERROR :{$con->error}");
    }
    echo json_encode($msg);
    

    $con->close();
?>