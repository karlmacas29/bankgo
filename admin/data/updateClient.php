<?php 
    include "config.php";

    //id
    $idnum = $_POST["id"];
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $sex = $_POST["sex"];
    $bdate = $_POST["bdate"];
    $address = $_POST["addr"];

    $sqlCode = "UPDATE clients SET client_firstN = '{$firstname}' , client_lastN = '{$lastname}', client_gender = '{$sex}', client_bdate = '{$bdate}', client_c_address = '{$address}' WHERE client_id = '{$idnum}'";

    $msg = "";
    if($con->query($sqlCode)===TRUE){
        $msg = array("val"=> true , "msg" => "Update Success!");
    }else{
        $msg = array("val" => false, "msg" => "Update Error :{$con->error}");
    }
    echo json_encode($msg);
    $con->close();
?>