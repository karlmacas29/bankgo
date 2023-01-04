<?php
    include("config.php");

    $id = $_POST["id"];
    $deposit = $_POST["deposit"];

    $dep = "UPDATE deposit SET dep_amount = dep_amount + {$deposit} , dept_time = CURRENT_TIMESTAMP WHERE client_id = {$id}";

    $sql = "UPDATE balance_inq SET bal_balance = bal_balance + {$deposit} WHERE client_id = {$id}";
    
    $msg = "";
    if($con->query($dep)===TRUE AND $con->query($sql)===TRUE){
        $msg = array("val"=> true , "msg" => "Deposit Success!");
    }else{
        $msg = array("val" => false, "msg" => "ERROR :{$con->error}");
    }
    echo json_encode($msg);
    

    $con->close();
?>