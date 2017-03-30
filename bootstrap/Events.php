<?php

class Events
{
    public static function attachEvents()
    {
        \PubSub::subscribe( 'first-time-job-post', function ($id, $data)
        {
            (new \App\Mails\FirstTimeJobPostEmailSend($id, $data))->send();
        });
    }
}