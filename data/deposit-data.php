<?php
    include("config.php");

    $id = $_POST["id"];
    $deposit = $_POST["deposit"];
    $name2 = $_POST["name3"];
    $card2 = $_POST["card3"];

    if(empty($deposit) OR $deposit == 0) {
        $msg = array("val" => false, "msg" => "Please Insert Value and Not to be 0");
        echo json_encode($msg);
    } else {

        $sql = "UPDATE balance_inq SET bal_balance = bal_balance + {$deposit} WHERE client_id = {$id}";

        $sql3 = "INSERT INTO {$name2} ( `card_id`, `tran_message`, `date_time`) VALUES ('{$card2}',' You Deposit ₱ {$deposit} in Your ATM.',CURRENT_TIMESTAMP )";


        $msg = "";
        if ($con->query($sql) === TRUE and $con->query($sql3) === TRUE) {
            $dep = "UPDATE deposit SET dep_amount = dep_amount + {$deposit} , dept_time = CURRENT_TIMESTAMP WHERE client_id = {$id}";
            if($con->query($dep) === TRUE){
                $msg = array("val" => true, "msg" => "Deposit Success!");
            }else{
                $msg = array("val" => false, "msg" => "ERROR :{$con->error}");
            }
        } else {
            $msg = array("val" => false, "msg" => "ERROR :{$con->error}");
        }
        echo json_encode($msg);
    }
    $con->close();
?>