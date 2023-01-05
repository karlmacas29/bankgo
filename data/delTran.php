<?php 
    include("config.php");

    $name = $_POST["name3"];

    $msg = "";

    $sql = "DELETE FROM {$name}";

    if($con->query($sql)=== TRUE){
        $msg = array("val"=> true , "msg" => "Delete Success!");
    }else{
        $msg = array("val" => false, "msg" => "ERROR!");
    }
    echo json_encode($msg);
    $con->close();
?>