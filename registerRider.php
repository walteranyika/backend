<?php
if (isset($_POST["phone"]))
{
    require "connect.php";
    include "functions.php";
    extract($_POST);
    $code= rand(1000,9999);
    $sql="INSERT INTO `riders`(`names`, `email`, `phone`, `code`) VALUES ('$names','$email','$phone','$code')";
    $result = mysqli_query($conn, $sql);// or die(mysqli_errno($conn));
    if($result)
    {
      echo json_encode(array("status"=>"success"));
      sendSMS($phone,$code);
    }
    else
    {

        $sql="update riders set status='unverified', code='$code' WHERE phone='$phone'";
        mysqli_query($conn, $sql);// or die(mysqli_errno($conn));
        echo json_encode(array("status"=>"success"));
        sendSMS($phone,$code);
    }
}else{
    echo json_encode(array("error"=>"No data sent"));
}
