<?php

namespace src\frontoffice\Cart\Infrastructure\Persistence\Session;

use src\frontoffice\Cart\Domain\ICartSessionManager;

class CartSessionCookieManager implements ICartSessionManager
{
    private $sessionKeyData;

    public function getKeySessionData($KeyName): array
    {
        
        if(is_null($this->sessionKeyData = session($KeyName)))
        {
            $this->sessionKeyData = [];
        }
        return $this->sessionKeyData;
    }

    public function putDataInKeySession($KeyName, $data): void
    {
        session()->put($KeyName, $data);
    }

    public function pushDataInKeySession($KeyName, $sessionKeyData): void
    {
        session()->push($KeyName, $sessionKeyData);
    }

    public function deleteCart($KeyName): void
    {
        session()->forget($KeyName);
    }
}
