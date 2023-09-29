<?php

namespace src\frontoffice\Cart\Domain;

interface ISessionManager
{
    public function getKeySessionData($KeyName): array;

    public function putDataInKeySession($KeyName, $data): void;

    public function pushDataInKeySession($KeyName, $data): void;

    public function deleteCart($KeyName): void;
}
