<?php

namespace TestPhp\Common;

use Twilio\Rest\Client;

class TwilioService
{

    public static function sendMessage($phone, $data)
    {

        $sid = $_ENV["TWILIO_ACCOUNT_SID"];
        $token = $_ENV["TWILIO_AUTH_TOKEN"];
        $from = $_ENV["TWILIO_PHONE"];

        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                $phone, // to
                [
                    "body" => $data['message'],
                    "from" => $from
                ]
            );

        return ["sid" => $message->sid, "sent_at" => $message->date_sent];
    }
}
