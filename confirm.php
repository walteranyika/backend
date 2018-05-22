<?php
if (isset($_POST["phone"]))
{
    require "connect.php";
    extract($_POST);
    $sql="select * from clients where phone='$phone' AND code='$code'";
    $result = mysqli_query($conn, $sql);// or die(mysqli_errno($conn));
    if(mysqli_num_rows($result)==1)
    {
      echo json_encode(array("status"=>"success"));
    }
    else
    {
        echo json_encode(array("status"=>"failed"));
    }
}


