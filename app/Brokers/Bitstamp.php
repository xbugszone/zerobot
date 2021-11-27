<?php

namespace App\Brokers;

use Xbugszone\Cryptotools\Brokers\CCTXBroker;
use ccxt\bitstamp as ccxtbitstamp;

class Bitstamp extends CCTXBroker
{
    public function __construct()
    {
        $exchange =  ccxtbitstamp::class;
        $apiSecret =env("BITSTAMP_API_SECRET");
        $apiKey = env("BITSTAMP_API_KEY");

        parent::__construct($exchange, $apiSecret, $apiKey);
    }
}
