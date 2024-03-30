<?php

namespace App\Services\SMSService\Strategies;
use App\Services\SMSService\ISMSProvider;
use Illuminate\Support\Facades\Http;

class FirstSMSProvider implements ISMSProvider {

    public function send($user)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post('https://run.mocky.io/v3/8eb88272-d769-417c-8c5c-159bb023ec0a',
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
