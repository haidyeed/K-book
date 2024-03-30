<?php

namespace App\Services\SMSService;

use App\Services\SMSService\ISMSProvider;
use App\Services\SMSService\Strategies\FirstSMSProvider;
use App\Services\SMSService\Strategies\SecondSMSProvider;
use Exception;

Class SMSProviderContext
{
    private ISMSProvider $provider;
    private $providers = [];
    private $providerName;

    public function __construct($providerName)
    {
        $this->providers = [
            'first_provider' => new FirstSMSProvider(),
            'second_provider' => new SecondSMSProvider()
        ];

        $this->providerName = $providerName;
        $this->provider = $this->getProvider();
    }

    public function send($user){

        $response = $this->provider->send($user);
        return $response;

    }

    private function getProvider()
    {
        if(!isset($this->providers[$this->providerName]) || !$this->providers[$this->providerName])
            throw new Exception("Sorry No providers available for this name");
        return $this->providers[$this->providerName];
    }

}
