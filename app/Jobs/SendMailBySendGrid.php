<?php

namespace App\Jobs;

use App\Services\Service;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendMailBySendGrid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $template;

    /**
     * Create a new job instance.
     *
     * @param array $data
     * @param string $template
     */
    public function __construct(array $data, string $template)
    {
        $this->data = $data;
        $this->template = $template;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws GuzzleException
     * @throws Throwable
     */
    public function handle()
    {
        $profile   = Config::get('mail.sendgrid.profile');
        $transport = Config::get('mail.sendgrid.transport');
        $html      = \view('email.' . $this->template, $this->data)->with('data', $this->data)->render();

        if($transport){
            $endpoint = $transport['host'];
            $method = 'POST';
            $body = [
                'personalizations' => [
                    [
                        'to' => [
                            ['email' => $this->data['to']]
                        ],
                        'subject' => __($this->data['subject'])
                    ]
                ],
                'from' => ['email' => $profile['from'], 'name' => 'EloSun'],
                'content' => [
                    [
                        'type' => 'text/html',
                        'value' => $html
                    ]
                ]
            ];
            $options =[
                'headers' => [
                    'content-type' => 'application/json',
                    'authorization' => 'Bearer ' . $transport['password']
                ],
                'body' => json_encode($body)
            ];

            $response = Service::processRequest($method, $endpoint, $options);

            if ($response->getStatusCode() <= 200 && $response->getStatusCode() >= 220) {
                Log::alert("Erro ao enviar email de cadastro por pedido.");
            }
        }
    }
}
