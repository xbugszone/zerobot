<?php

namespace App\Strategies;

use Xbugszone\Cryptotools\Analysis\Analyser;
use Xbugszone\Cryptotools\Interfaces\BrokerInterface;

class followDrop
{
    public $account;
    public $broker;

    public function setAccount($account) {
        $this->account = $account;
    }
    public function setBroker(BrokerInterface $broker) {
        $this->broker = $broker;
    }
    public function run() {
        //get all markets
        $markets = $this->account->getAvailablePairs("/".$this->account->tradeCoin);
        foreach ($markets as $market) {
            $tc = $this->broker->getTickers($market,'4h', null, 1);
            $analyser = new Analyser();
            $analyser->setTicker($tc);
            $change = $analyser->getChange();
            echo $market."\n";
            echo round($change,2)."% \n";
            echo "\n";
            if($change < -4) {
                print_r($tc);
                //interesting lets take a better look
            }
        }
        return $markets;

    }
}
