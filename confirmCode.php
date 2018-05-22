<?php
if (isset($_POST["phone"]))
{
    //COMPLETE THIS
    include "connect.php";
    extract($_POST);
    $date = date("Y-m-d");

    $sql="select * from codes where drivers_phone='$phone' AND code='$code' AND date_received='$date'";
    $result = mysqli_query($conn, $sql);// or die(mysqli_errno($conn));
    if(mysqli_num_rows($result)==1)
    {
        $sql="update codes set confirmed_status='verified' WHERE drivers_phone='$phone' AND code='$code'";
        mysqli_query($conn,$sql);
        echo json_encode(array("status"=>"success"));
    }
    else
    {
        echo json_encode(array("status"=>"failed"));
    }

}else
{
    echo json_encode(array("status"=>"Failed to send"));
}