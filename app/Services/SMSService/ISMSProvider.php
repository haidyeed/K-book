<?php

namespace App\Services\SMSService;

interface ISMSProvider {

    public function send($user);

    }

?>
