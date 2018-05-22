<?php
if (isset($_POST["phone"]))
{
    require "connect.php";
    include "functions.php";
    extract($_POST);
    $code= rand(1000,9999);
    $sql="insert into clients(names, phone, code) values ('$names','$phone','$code')";
    $result = mysqli_query($conn, $sql);// or die(mysqli_errno($conn));
    if($result)
    {
      echo json_encode(array("status"=>"success"));
      sendSMS($phone,$code);
    }
    else
    {

        $sql="update clients set status='unverified', code='$code' WHERE phone='$phone'";
        mysqli_query($conn, $sql);// or die(mysqli_errno($conn));
        echo json_encode(array("status"=>"success"));
        sendSMS($phone,$code);
    }
}


