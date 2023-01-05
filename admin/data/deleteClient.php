<?php 
include "config.php";

$id = $_POST['id3'];
$name = $_POST['nm'];

$sql9 = "SELECT bal_balance FROM balance_inq WHERE client_id = {$id}";
        $result = mysqli_query($con,$sql9);
        $row = mysqli_fetch_array($result);
        $bal1 = $row["bal_balance"];

    $msg = "";
    if($bal1 == 0){
        $sqlC = "DROP TABLE {$name}";
        if($con->query($sqlC) === TRUE){
            $sql = "DELETE FROM clients WHERE client_id = {$id}";
            if ($con->query($sql) === TRUE) {
                $sql2 = "DELETE FROM deposit WHERE client_id = {$id} ";
                if ($con->query($sql2) === TRUE) {
                    $sql4 = "DELETE FROM balance_inq WHERE client_id = {$id}";
                    if ($con->query($sql4) === TRUE) {
                        $sql6 = "DELETE FROM withdrawals WHERE client_id = {$id}";
                        if ($con->query($sql6) === TRUE) {
                            $msg = array("val" => true, "msg" => "Delete Success!");
                        }
                    }
                }

            } 
        }else{
            $msg = array("val" => false, "msg" => "ERROR!!");
            }
    }else{
        $msg = array("val" => false, "msg" => "This Account Has More Balance Left!");
    }
    echo json_encode($msg);
$con->close();
?>