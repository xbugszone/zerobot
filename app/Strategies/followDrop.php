<?php

namespace App\Strategies;

use Xbugszone\Cryptotools\Interfaces\BrokerInterface;
use Xbugszone\Cryptotools\Utils\Utils;

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
            $change = Utils::getChange($tc);
            echo $market."\n";
            echo round($change,2)."% \n";
            echo "\n";
            if($change < -4) {
                print_r($tc);
                //interesting lets take a better look
                Utils::check($tc, $this->broker->getTickers($market,'1m', null, 240));
                //buy all
                $ticker = $this->broker->getTicker($market);
                $this->account->createOrder(
                    $market,
                    'trade',
                    'sell',
                    $this->account->getBalance($this->account->tradeCoin),
                    $ticker['ask']
                );
            }
        }
        return $markets;

    }
}
