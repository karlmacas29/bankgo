<?php 
    include "config.php";

    //id
    $idnum = $_POST["id"];
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $sex = $_POST["sex"];
    $bdate = $_POST["bdate"];
    $address = $_POST["addr"];

    $sql1 = "SELECT client_firstN FROM clients WHERE client_id = {$idnum}";
            $result = mysqli_query($con, $sql1);
            $row = mysqli_fetch_array($result);
            $nm2 = $row["client_firstN"];
            
    $msg = "";
    $sql2 = "RENAME TABLE {$nm2} TO {$firstname}";

    if ($con->query($sql2) === TRUE) {
        $sqlCode = "UPDATE clients SET client_firstN = '{$firstname}' , client_lastN = '{$lastname}', client_gender = '{$sex}', client_bdate = '{$bdate}', client_c_address = '{$address}' WHERE client_id = '{$idnum}'";
        if ($con->query($sqlCode) === TRUE) {
            $msg = array("val" => true, "msg" => "Update Success!");
        } else {
            $msg = array("val" => false, "msg" => "Update Error :{$con->error}");
        }
        
    }else{
        $msg = array("val" => false, "msg" => "Update Error Table :{$con->error}");
    }
    echo json_encode($msg);
    $con->close();
?>
