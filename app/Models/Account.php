<?php

namespace App\Models;

use Xbugszone\Cryptotools\Accounts\User;
use Xbugszone\Cryptotools\Interfaces\BrokerInterface;

class Account extends User
{
    public string $tradeCoin = "EUR";
    /**
     * Populate the Account with data from the exchange
     * @param BrokerInterface $broker
     */
    public function fetchData(BrokerInterface $broker): void {
        //dd(1);
        $balance["EUR"] = ['total' => 100, 'free' => 100, 'used' => 0];
        $this->balance = $balance;
        $this->markets = $broker->getMarkets();
        $this->openOrders = [];
    }

}
