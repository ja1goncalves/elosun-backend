<?php


namespace App\Services;


use GuzzleHttp\Client;

class MovideskService
{
    /** @var Client $httpClient */
    private $httpClient;

    /**
     * MovideskService constructor.
     */
    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    private function getUrl()
    {
        return config('movidesk.url');
    }

    /**
     * @return array
     */
    private function getHeaders()
    {
        return [
            'Accept'    => 'application/json',
        ];
    }

    /**
     * @param $data
     * @return mixed
     */
    private function getParams($data)
    {
        return $data;
    }

    /**
     * @param $data
     * @return array
     */
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
