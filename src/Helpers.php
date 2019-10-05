<?php


namespace App\Test;
use phpseclib\Crypt\RSA;

class Helpers
{
    private $publik_key;
    private $private_key;
    protected $rsa;
    protected $signature;

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
    public $data;

    public function __construct()
    {
        $this->rsa = new RSA();
        $this->publik_key = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/keys/rsa_2048_pub.pem');
        $this->private_key = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/keys/rsa_2048_priv.pem');
    }

    public function loadData(array $json){
        $this->data = base64_decode($json['data']);
        $this->signature = urldecode($json['signature']);
    }

    public function getDecriptData(){
        $this->rsa->loadKey($this->private_key);
        $this->rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);
       return $this->rsa->decrypt($this->data);
    }

    public function verifySignature($requestSignature){
        $this->rsa->loadKey($this->publik_key);
        $this->rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);
        return $this->rsa->verify($requestSignature, $this->signature) ? true : false;
    }

}