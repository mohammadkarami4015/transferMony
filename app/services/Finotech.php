<?php

namespace App\services;

use App\interfaces\Transfer;
use Illuminate\Support\Facades\Http;

class Finotech implements Transfer
{
    private $base_url;
    private $url;
    private $headers;
    private $clientId;
    private $trackId;
    private $body;
    private $token;

    public function __construct()
    {
        $this->clientId = "clientId";
        $this->trackId = "trackId";
        $this->base_url = config('finotech.base_url');
        $this->token = "token";
        $this->headers = [
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $this->token
        ];
        $this->url = $this->base_url . '/oak/v2/clients/' . $this->clientId . '/transferTo?trackId=' . $this->trackId;
    }

    public function send($data)
    {
        /** The transfer request is made here */
        //Http::withHeaders($this->headers)->post($this->url)->body($data);


        /** we make two fake response:successResponse and failedResponse  */
        $failedResponse = [
            "response" => null,
            "status" => "FAILED",
            "error" => [
                "code" => "SERVICE_CALL_ERROR",
                "message" => "Minimum amount is 10000 Rials."
            ]
        ];
        $successResponse = [
            "result" => [
                "refCode" => "123456"
            ],
            "status" => "DONE",
        ];

        return $successResponse;
    }
}
