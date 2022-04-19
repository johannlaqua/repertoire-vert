<?php

namespace App\Service;

class CryptService {

    private $encryptMethod = 'AES-256-CBC';
    private $secretKey = 'This is my secret key';
    private $secretIv = 'This is my secret iv';

    public function encrypt($string){
        return $this->crypt('encrypt', $string);
    }

    public function decrypt($string){
        return $this->crypt('decrypt', $string);
    }

    private function crypt($action, $string) {
        $key =  hash('sha256', $this->secretKey);
        $iv = substr(hash('sha256', $this->secretIv), 0, 16);
        if ($action === 'encrypt') {
            return base64_encode(
                openssl_encrypt(
                    $string, 
                    $this->encryptMethod, 
                    $key, 
                    0, 
                    $iv
                )
            );
        } else {
            return openssl_decrypt(
                base64_decode($string), 
                $this->encryptMethod, 
                $key, 
                0, 
                $iv
            );
        }
    }
}