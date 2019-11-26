<?php

namespace App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
 * Class Service
 * @package App\Services
 */
class Service
{
    /**
     * @param bool $object
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public static function getUser($object = false)
    {
        if ($object) {
            return Auth::user();
        } else {
            $user = Auth::user();
            return $user->email;
        }
    }

    /**
     * @return mixed
     */
    public static function logout()
    {
        $user = self::getUser(true);
        $accessToken = DB::table('oauth_access_tokens')
            ->where('user_id', '=', $user->id)
            ->latest()->get();

        return DB::table('oauth_access_tokens')
            ->where('id', '=', $accessToken[0]->id)
            ->delete();

    }

    /**
     * @param bool $id
     * @return mixed
     */
    public static function authorizationUser($id = false)
    {
        $user = Auth::user();
        if ($id) {
            return $user->id;
        }
        return $user->email;
    }

    /**
     * @return mixed
     */
    public static function typeUserLogged()
    {
        $user = self::getUser(true);
        return $user->type;
    }

    /**
     * @param $cep
     * @param bool $response
     * @return array
     * @throws \Exception
     */
    public static function searchCep($cep,$response = false)
    {
        $client = new Client();
        $cep = preg_replace('/[.-\/]+/','', $cep);
        $url = 'https://viacep.com.br/ws/'.$cep.'/json/';
        $res = $client->get($url, []);
        $data = json_decode($res->getBody());
        if(empty($data)){
            if ($response==false) {
                throw new \Exception('Serviço não está disponível no momento!');
            }else{
                throw new \Exception("CEP Inválido!");
            }
        }
        if(isset($data->erro) && $data->erro){
            throw new \Exception("CEP não encontrado!");
        }
        return [
            'postal_code'   => $cep,
            'street'        => $data->logradouro,
            'district'      => $data->bairro,
            'city'          => $data->localidade,
            'state'         => $data->uf,
            'street_view'   => 'maps.google.co.in/maps?q='.$cep,
        ];
    }

    /**
     * @param $method
     * @param $endpoint
     * @param $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function processRequest($method , $endpoint, $options)
    {
        try {
            $response = self::httpClient()->request($method, $endpoint, $options);
            return $response;
        } catch (ClientException $e) {
            $message = json_decode($e->getResponse()->getBody(), true);
            return print_r($message, $e->getResponse()->getStatusCode());
        }
    }

    /**
     * @return Client
     */
    public static function httpClient()
    {
        return new Client();
    }
}
