<?php
require "aws.phar";
use Aws\Sns\SnsClient;

define("KEY", );
define("SECRET", );
define("REGION", );
define("APPARN", );


$push_message = "An message sent from PHP xxxxxyyyyyyy";
echo "AWS SNS Test\n";
$sns = SnsClient::factory(array(
    'key'    => KEY,
    'secret' => SECRET,
    'region' => REGION //( like us-west-2)
));

$android_AppArn = APPARN;
$android_model = 
    $sns->listEndpointsByPlatformApplication(
        array('PlatformApplicationArn' => $android_AppArn)
);
foreach ($android_model['Endpoints'] as $endpoint)
        {
            $endpointArn = $endpoint['EndpointArn'];

            try
            {
                $sns->publish(array(
                    'Message' => $push_message,
                    'TargetArn' => $endpointArn
                ));

                echo "Success: ".$endpointArn."\n";
            }
            catch (Exception $e)
            {
                echo "Failed: ".$endpointArn."\nError: ".$e->getMessage()."\n";
            }
        }
?>
