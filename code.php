<?php
if (isset($_POST["sender_phone"]))
{
    include "connect.php";
    include "functions.php";
    extract($_POST);
    $date = date("Y-m-d");
    $code = rand(1000, 9999);
    $sql="INSERT INTO `codes`(`receipient_phone`, `sender_phone`, `drivers_phone`, `code`, `date_received`)
                      VALUES ( '$recipient_phone','$sender_phone','$driver_phone','$code','$date')";
    $result=mysqli_query($sql);
    if ($result){
        sendCode($sender_phone,$code,$sender_names,$recipient_phone);
        echo json_encode(array("status"=>"Success"));
    }else{
        echo json_encode(array("status"=>"Failed"));
    }

}else
{
    echo json_encode(array("status"=>"Failed to send"));
}