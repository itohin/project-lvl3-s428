<?php

namespace App\Jobs;

use DiDom\Document;
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

        $document = new Document($body);

        $header = $document->find('h1');
        $data['header'] = (count($header) > 0) ? $header[0]->text() : null;

        $keywords = $document->find('meta[name=keywords]');
        $data['keywords'] = (count($keywords) > 0) ? $keywords[0]->attr('content') : null;

        $description = $document->find('meta[name=description]');
        $data['description'] = (count($description) > 0) ? $description[0]->attr('content') : null;

        return $data;
    }
}
