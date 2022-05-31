<?php

namespace Adw\Auth;

use Adw\Auth\VerifyModel;

use Adw\Auth\InvalidTokenException;

class VerifyService{

    public $verifyModel;
    public function __construct() {
        $this->verifyModel = new VerifyModel;
    }

    public function show(String $tokenId): VerifyModel{
        $tokenId = $this->verifyModel->find($tokenId);
        if (is_null($tokenId)) {
            throw new InvalidTokenException("Tidak ada User Token dengan ID {$tokenId}");
        }
        return $tokenId;
    }
}
