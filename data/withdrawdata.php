<?php
    include("config.php");

    $id = $_POST["id"];
    $wit = $_POST["wit"];
    $name3 = $_POST["name3"];
    $card3 = $_POST["card3"];


    $msg = "";
    
    if(empty($wit) OR $wit == 0) {
        $msg = array("val" => false, "msg" => "Please Insert Value and Not to be 0");
        echo json_encode($msg);
    }else{

        $sql = "UPDATE balance_inq SET bal_balance = bal_balance - {$wit} WHERE client_id = {$id}";
    
        if($con->query($sql)===TRUE){
            $wit1 = "UPDATE withdrawals SET wit_amount = wit_amount + {$wit} WHERE client_id ={$id}";
            if($con->query($wit1)===TRUE){
                $sql5 = "INSERT INTO {$name3} ( `card_id`, `tran_message`, `date_time`) VALUES ('100',' You Withdraw ₱ {$wit} in Your ATM.', CURRENT_TIMESTAMP )";
                if($con->query($sql5) === TRUE){
                    $msg = array("val"=> true , "msg" => "Withdraw Success!");
                }else{
                    $msg = array("val" => false, "msg" => "ERROR");
                }              
            }else{
                $msg = array("val" => false, "msg" => "ERROR");
            }
        }else{
            $msg = array("val" => false, "msg" => "You Don't Have Enough Balance in Your ATM and It's ERROR");
        }
        echo json_encode($msg);
    }
    
    $con->close();
?>