<?php 
    include "config.php";

    @$idcard = $_POST["idcard"];
    @$fname = $_POST["fname"];
    @$lname = $_POST["lname"];
    @$gender = $_POST["gend"];
    @$bdate = $_POST["bdate"];
    @$address = $_POST["address"];

    $sql ="INSERT INTO `clients`( `card_id`, `client_firstN`, `client_lastN`, `client_gender`, `client_bdate`, `client_c_address`) VALUES ('{$idcard}','{$fname}','{$lname}','{$gender}','{$bdate}','{$address}')";

    if($con->query($sql)=== TRUE){
        $sql1 = "SELECT client_id FROM clients WHERE card_id = {$idcard}";
        $result = mysqli_query($con,$sql1);
        $row = mysqli_fetch_array($result);
        $id2 = $row["client_id"];

        $sql2 = "INSERT INTO `deposit`(`client_id`, `dept_time`, `dep_amount`, `rect_code`) VALUES ('{$id2}',CURRENT_TIMESTAMP,'0','{$id2}')";
        if($con->query($sql2)=== TRUE){
            $sql3 = "SELECT client_id AS cid FROM clients WHERE card_id = {$idcard}";
            $result1 = mysqli_query($con,$sql3);
            $row1 = mysqli_fetch_array($result1);
            $id3 = $row1["cid"];

            $sql4 = "INSERT INTO `balance_inq`( `bal_balance`, `client_id`) VALUES ('0','{$id3}')";
            if($con->query($sql4)=== TRUE){
                $sql5 = "SELECT client_id AS c_id FROM clients WHERE card_id = {$idcard}";
                $result2 = mysqli_query($con,$sql5);
                $row2 = mysqli_fetch_array($result2);
                $id4 = $row2["c_id"];

                $sql6 = "INSERT INTO `withdrawals`(`client_id`, `rect_code`, `wit_amount`) VALUES ('{$id4}','{$id4}','0')";
                if ($con->query($sql6) === TRUE) {
                    echo "<script> alert('Successfully Created!!'); location.href='../Login.php'; </script>";
                }
            }
        }
    
    }else{
        echo "Something Went Wrong :( <br>";
        echo "Details: ".$con->error;
    }

    $con->close();

?>