<?php


namespace App\Services;


use App\Entities\Client;

class MovideskService
{
    /** @var Client $httpClient */
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    private function getUrl()
    {
        return config('movidesk.url');
    }

    private function getHeaders()
    {
        return [
            'Accept'    => 'application/json',
        ];
    }

    private function getParams($data)
    {
        return $data;
    }

    public function sendToMovidesk($data)
    {
        try {

            $response = $this->httpClient->post($this->getUrl(), [
                'headers'     => $this->getHeaders(),
                'form_params' => $this->getParams($data),
            ]);

        } catch (\Exception $e) {
            \Log::alert('Erro ao criar ticket no movidesk');
            \Log::alert($e->getMessage());
            \Log::alert($e->getLine());
        }

        return [
            'erro'    => false,
            'message' => ''
        ];
    }
}
