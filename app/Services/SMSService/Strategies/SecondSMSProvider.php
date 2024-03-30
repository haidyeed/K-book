<?php

namespace App\Services\SMSService\Strategies;
use App\Services\SMSService\ISMSProvider;
use Illuminate\Support\Facades\Http;

class SecondSMSProvider implements ISMSProvider {

    public function send($user)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post('https://run.mocky.io/v3/268d1ff4-f710-4aad-b455-a401966af719',
        [
            'UserPhone' => $user->phone,
            'Message' => 'Thank you for submitting the reading interval.',
        ]);

        $smsSended = json_decode($response->getBody(), true);
        
        //I used to return true as the url response is not always giving true as mentioned
        return true;
    
    }

}

?>
