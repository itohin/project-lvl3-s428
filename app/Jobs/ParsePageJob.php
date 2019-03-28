<?php

namespace App\Jobs;

use GuzzleHttp\Client;

class ParsePageJob extends Job
{
    protected $domain;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($domain)
    {
        $this->domain = $domain;
    }


    public function handle()
    {
        $data = $this->getDomainData($this->domain->name);
        $this->domain->update($data);
    }

    public function getDomainData($domain)
    {
        $client = new Client();
        $response = $client->request('GET', $domain);

        $code = $response->getStatusCode();
        $type = $response->getHeader('content-type')[0];
        $body = $response->getBody()->getContents();

        $contentLength = ($response->getHeader('content-length')) ?
            $response->getHeader('content-length')[0] :
            $contentLength = strlen($body);

        $data = [
            'name' => $domain,
            'code' => $code,
            'type' => $type,
            'body' => $body,
            'length' => $contentLength
        ];

        return $data;
    }
}
