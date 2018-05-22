<?php
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

        /*foreach($results as $result) {
            // status is either "Success" or "error message"
            echo " Number: " .$result->number;
            echo " Status: " .$result->status;
            echo " MessageId: " .$result->messageId;
            echo " Cost: "   .$result->cost."\n";
        }*/
    }
    catch ( AfricasTalkingGatewayException $e )
    {
        // echo "Encountered an error while sending: ".$e->getMessage();
    }


}

function sendCode($phone,$code,$names,$recipient)
{
    require "AfricasTalkingGateway.php";
    $username   = "rwalter";
    $apikey     = "8fdd4e96feadd74003c989906032056be5c40dd24a5cbbd432c1145038c6330b";
    $recipients = "$recipient";
    $message    = "Please use $code to validate the delivery of a package from $names $phone";
    $gateway    = new AfricasTalkingGateway($username, $apikey);
    try
    {
        // Thats it, hit send and we'll take care of the rest.
        $results = $gateway->sendMessage($recipients, $message);

        /*foreach($results as $result) {
            // status is either "Success" or "error message"
            echo " Number: " .$result->number;
            echo " Status: " .$result->status;
            echo " MessageId: " .$result->messageId;
            echo " Cost: "   .$result->cost."\n";
        }*/
    }
    catch ( AfricasTalkingGatewayException $e )
    {
        // echo "Encountered an error while sending: ".$e->getMessage();
    }


}