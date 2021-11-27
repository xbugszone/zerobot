<?php

namespace App\Brokers;

use ccxt\bitstamp as ccxtbitstamp;
use Xbugszone\Cryptotools\Brokers\Simulator as cryptoSimulator;

class Simulator extends cryptoSimulator
{
    public function __construct()
    {
        $exchange =  ccxtbitstamp::class;
        $apiSecret =env("BITSTAMP_API_SECRET");
        $apiKey = env("BITSTAMP_API_KEY");

        parent::__construct($exchange, $apiSecret, $apiKey);
    }
}
