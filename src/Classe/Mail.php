<?php


namespace App\Classe;


use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = 'dff54df436f1895905c0f0c6b28612f7';
    private $api_key_secret = '513d933ba9d85e030d41ef37d32ae741';

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret,true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "ariane.dal2001@gmail.com",
                        'Name' => "CRM"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 2989512,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content,
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }

}