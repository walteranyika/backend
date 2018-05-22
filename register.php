<?php
if (isset($_POST["phone"]))
{
    require "connect.php";
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


function sendSMS($phone,$code)
{
    require "AfricasTalkingGateway.php";
    $username   = "rwalter";
    $apikey     = "8fdd4e96feadd74003c989906032056be5c40dd24a5cbbd432c1145038c6330b";
    $recipients = "$phone";
    $message    = "Please use $code to verify your phone";
    $gateway    = new AfricasTalkingGateway($username, $apikey);
    try
    {
        // Thats it, hit send and we'll take care of the rest.
        $results = $gateway->sendMessage($recipients, $message);

        foreach($results as $result) {
            // status is either "Success" or "error message"
            echo " Number: " .$result->number;
            echo " Status: " .$result->status;
            echo " MessageId: " .$result->messageId;
            echo " Cost: "   .$result->cost."\n";
        }
    }
    catch ( AfricasTalkingGatewayException $e )
    {
        echo "Encountered an error while sending: ".$e->getMessage();
    }


}